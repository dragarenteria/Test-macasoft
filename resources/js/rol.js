new Vue({
    el:'#rol_main',
    data:{
        tabla:null,
        rol:null,
        id_rol:{}
    },
    mounted(){
        this.tableRoles()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    },
    methods:{
        guardarRol(){
            let self = this
                $.ajax({
                    type: "POST",
                    url: "/roles",
                    data: {rol:this.rol} ,
                    success: function (data) {
                        console.log(data);
                        
                        if (data.resp) {
                            swal({
                                title: "",
                                text: `Rol guardado exitosamente`,
                                icon: "success",
                              })
                              self.tabla.ajax.reload();
                                $('#crearRol').modal('hide')
                                self.rol = ''
                        }else{
                            swal({
                                title: "",
                                text: `Intente nuevamente`,
                                icon: "error",
                              })
                              
                        }
                    }
                })
                
        },
        eliminarRol(){
            let self = this;
            swal({
                    title: "Esta seguro de eliminar ?",
                    text: "Al eliminar este usuario no lo podrá recuperar nuevamente.",
                    icon: "warning",
                    buttons: [true, "Continuar"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Eliminar el docente
                        $.ajax({
                            type: "DELETE",
                            url: `roles/${self.id_rol.id}`,
                            success: function (response) {
                                console.log(response);
                                
                                if (response.resp) {
                                    self.tabla.ajax.reload();
                                    swal({
                                        text:'Se ha eliminado correctamente el usuario',
                                        icon: "success",
                                        buttons: [null, "Perfecto!"],
                                    });
                                } else {
                                    swal("No puede eliminar este rol porque está asignado a su usuario", {
                                        icon: "error",
                                    });
                                }

                            }
                        });

                    } else {
                        swal("Haz cancelado la acción.");
                    }
                });
  
        },
        tableRoles(){
            let self = this
          self.tabla =  $('#table_rol').DataTable({
                'ajax': {
                    'method': 'GET',
                    'url': 'roles',
                },
                columns: [{
                        defaultContent: '1'
                    },
                    {
                        data:  'name'
                    },
                    {
                        defaultContent: `<div class="btn-group"> <button class="eliminar btn btn-danger"><i class="fa fa-trash fa-lg"></i></button></div>`
                    },
                ],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": ">",
                        "previous": "<"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
            self.tabla.on('order.dt search.dt', function () {
                self.tabla.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
           
            $('#table_rol tbody').on('click', 'button.eliminar', function (d) {
                var data = self.tabla.row($(this).parents('tr')).data();
                // Enviamos los datos al mentodo preparado para gestionar esta data
                self.id_rol=data

                self.eliminarRol()
            });
        }
    }
})