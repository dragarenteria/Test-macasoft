<form class="modal fade" id="crearusuario" tabindex="-1" role="dialog"
@submit.prevent="guardarUser()" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row ">
                    <div class="col-md-12  text-center">
                        <img v-if="usuario.avatar != null " :src="usuario.avatar"   alt="usuario"style="max-width:150px;max-height:150px;min-width:150px;min-height:150px;border-radius:50em;">
                      <label class="btn btn-block btn-primary mb-3 mt-3">Elija una imagen
                      <input type="file" @change='validaImage' name="" id="avatar" style="display:none">
                      </label>
                    </div>
                    <div class="form-group col-md-12">
                            <label for="identificacion">Identificacion</label>
                            <input type="number" required class="form-control" v-model="usuario.identificacion" id="identificacion" placeholder="">
                          </div>
                    <div class="form-group col-md-6">
                        <label for="nombre1">Primer nombre</label>
                        <input type="text" required class="form-control" v-model="usuario.nombre1" id="nombre1" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nombre2">Segundo nombre</label>
                        <input type="text" class="form-control" v-model="usuario.nombre2" id="nombre2">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="apellido1">Primer apellido</label>
                      <input type="text" required class="form-control" v-model="usuario.apellido1" id="apellido1" placeholder="">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="apellido2">Segundo apellido</label>
                      <input type="text" class="form-control" v-model="usuario.apellido2" id="apellido2">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" required class="form-control" v-model="usuario.email" id="email" aria-describedby="emailHelp" placeholder="">
                  </div>
                  
                  <div class="form-group col-md-6">
                      <label for="rol">Rol</label>
                      <select class="form-control" v-model="usuario.rol" id="rol">
                        <option disabled selected>Seleccione un rol</option>
                        <option v-for="roles in roles">@{{roles.name}}</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
  </form>
