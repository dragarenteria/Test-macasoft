new Vue({
    el:'#usuario',
    data:{
        usuario:{
            avatar:null,
            nombre1:null,
            nombre2:null,
            apellido1:null,
            apellido2:null,
            email:null,
            identificacion:null,
            rol:'Seleccione un rol'
        },
        tabla:null,
        usuarioEditar:{},
        usuarioEliminar:null,
        roles:null
        
    },
    mounted(){
        this.datatable()
        this.getRole()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    },
    methods:{
        getRole(){
            self = this
            $.ajax({
                type: "GET",
                url: "roles.view",
                success: function (response) {
                    self.roles = response
                }
            });
        },
        validaImage(e){    
                
            let image = e.target.files[0];
            let tipo =  image.type.split("/")[0]
            if (tipo == 'image') {

                let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {

                    // this.path = e.target.result;
                    this.usuario.avatar = e.target.result;
                    this.usuarioEditar.avatar = e.target.result

                } 
            }else{
                swal({
                    title: "",
                    text: `El tipo de archivo "${image.type}" no es permitido`,
                    icon: "error",
                    // buttons: [false, false],
                  })
            }   
        },
        guardarUser(){
            let self = this
            if (this.usuario.rol != 'Seleccione un rol') {
                $.ajax({
                    type: "POST",
                    url: "/users",
                    data: this.usuario,
                    success: function (data) {
                        if (data.resp) {
                            swal({
                                title: "Usuario guardado exitosamente",
                                text: `La contraseña por defecto es la Identificacion`,
                                icon: "success",
                              })
                              self.tabla.ajax.reload();
                                $('#crearusuario').modal('hide')
                                self.usuario={
                                    avatar:null,
                                    nombre1:null,
                                    nombre2:null,
                                    apellido1:null,
                                    apellido2:null,
                                    email:null,
                                    contrasena:null,
                                    rol:'Seleccione un rol'
                                }
                        }else{
                            swal({
                                title: "",
                                text: `Intente nuevamente`,
                                icon: "error",
                              })
                              
                        }
                    }
                })
                .fail(data => { 
                    if (data.responseJSON.errors.identificacion) {
                        swal({
                            text:'La identificacion ya existe.',
                            icon:'error',
                        });
                    }                   
                   else if (data.responseJSON.errors.email) {
                        swal({
                            text:'El correo electrónico ya existe.',
                            icon:'error',
                        });
                    }
                })
            }else{
                swal({
                    title: "",
                    text: "Debe seleccionar un rol",
                    icon: "error",
                    // buttons: [false, false],
                  })
            }
            
        },
        editarUser(){
            let self = this
            // console.log(self.usuarioEditar)
                $.ajax({
                    type: "PUT",
                    url:  `/users/${self.usuarioEditar.id}`,
                    data: this.usuarioEditar,
                    success: function (data) {
                        console.log(data);
                        
                        if (data.resp) {
                            swal({
                                title: "",
                                text: `Usuario editado exitosamente`,
                                icon: "success",
                              })
                              self.tabla.ajax.reload();
                                $('#editarUsuario').modal('hide')
                                self.usuario={
                                    avatar:null,
                                    nombre1:null,
                                    nombre2:null,
                                    apellido1:null,
                                    apellido2:null,
                                    email:null,
                                    contrasena:null,
                                    rol:'Seleccione un rol'
                                }
                        }else{
                            swal({
                                title: "",
                                text: `Intente nuevamente`,
                                icon: "error",
                              })
                              
                        }
                    }
                })
                .fail(data => { 
                    if (data.responseJSON.errors.identificacion) {
                        swal({
                            text:'La identificacion ya existe.',
                            icon:'error',
                        });
                    }                   
                   else if (data.responseJSON.errors.email) {
                        swal({
                            text:'El correo electrónico ya existe.',
                            icon:'error',
                        });
                    }
                })
                
        },
        eliminarUsuario(){
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
                            url: `users/${self.usuarioEliminar}`,
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
                                    swal("Parece que estamos presentando fallas, intenta nuevamente.", {
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
        datatable(){
            let self = this
          self.tabla =  $('#table_usuario').DataTable({
                'ajax': {
                    'method': 'GET',
                    'url': 'users',
                },
                columns: [{
                        defaultContent: '1'
                    },
                    {
                        data: 'avatar','render' : function(data, type, row) {
                            if (data == null) {
                            return ` <img src="img/avatar.gif"   alt="usuario"style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;border-radius:50em;">`

                            }else{
                                return ` <img src="${data}"   alt="usuario"style="max-width:50px;max-height:50px;min-width:50px;min-height:50px;border-radius:50em;">`

                            }
                        }
                    },
                    {
                        data:  'identificacion'
                    },
                    {
                        data: 'full_name'
                    },
                    {
                        data:  'email'
                    },
                    {
                        data:  'roles_relacion[0].name'
                    },
                    {
                        defaultContent: `<div class="btn-group"><button data-toggle="modal" data-target="#editarUsuario" class="editar btn btn-primary"><i class="fa fa-edit fa-lg"></i></button>    <button class="eliminar btn btn-danger"><i class="fa fa-trash fa-lg"></i></button></div>`
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
            $('#table_usuario tbody').on('click', 'button.editar', function (d) {
                var data = self.tabla.row($(this).parents('tr')).data();
                // Enviamos los datos al mentodo preparado para gestionar esta data
                self.usuarioEditar = {
                    id:data.id,
                    avatar:data.avatar,
                    nombre1:data.nombre1,
                    nombre2:data.nombre2,
                    apellido1:data.apellido1,
                    apellido2:data.apellido2,
                    email:data.email,
                    identificacion:data.identificacion,
                    rol:data.roles_relacion[0].name}
            });
            $('#table_usuario tbody').on('click', 'button.eliminar', function (d) {
                var data = self.tabla.row($(this).parents('tr')).data();
                // Enviamos los datos al mentodo preparado para gestionar esta data
                self.usuarioEliminar=data.id

                self.eliminarUsuario()
            });
        }
    }
})