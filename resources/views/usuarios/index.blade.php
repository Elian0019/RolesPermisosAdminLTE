@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Usuarios</h1>
@stop
@section('content')
    <div class="container-fluid">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active"  href="#Usuario" onclick="recarga()" data-toggle="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Usuarios</a></li>
                <li class="nav-item"><a class="nav-link" id="save_usuario" onclick="limpiarFormulario()" href="#UsuarioAgregar" data-toggle="tab"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a></li>
                @can('usuario.eliminados')
                <li class="nav-item"><a class="nav-link"    href="#UsuariosEliminados" onclick="recarga()" data-toggle="tab"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Eliminados</a></li>
                @endcan

               </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="Usuario">
                    <table id="example1" class="table table-responsive-xl table-bordered table-sm table-hover table-striped" style="width:100%" >
                        <thead>
                            <tr>
                              <th class="text-center">Foto</th>
                              <th width="4%"> id </th>
                              <th>Nombre</th>
                              <th>Apellidos</th>
                              <th>Email</th>
                              <th>Telefono</th>
                              <th>Edad</th>
                              <th>Direccion</th>
                              <th>Rol</th>
                              <th width="5%">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="UsuariosEliminados">
                    <table id="example2" class="table table-responsive-xl table-bordered table-sm table-hover table-striped" style="width:100%" >
                        <thead>
                            <tr>
                              <th class="text-center">Foto</th>
                              <th width="4%"> id </th>
                              <th>Nombre</th>
                              <th>Apellidos</th>
                              <th>Email</th>
                              <th>Telefono</th>
                              <th>Edad</th>
                              <th>Direccion</th>
                              <th>Rol</th>
                              <th width="5%">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="UsuarioAgregar">
                    <form id="miform" method="POST" enctype="multipart/form-data"  action="{{route('usuario.store')}}" autocomplete="off" class="needs-validation" novalidate>

                        @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="nombre">Nombre</label>
                                          <input class="form-control" id="nombre" name="nombre" type="text" placeholder="ingrese un nombre " pattern=".*\S+.*" autofocus required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="email">Email</label>
                                          <input class="form-control" id="email" name="email" type="email" pattern=".*\S+.*" placeholder="ingrese su email " required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="apellidos">Apellidos</label>
                                          <input class="form-control" id="apellidos" name="apellidos" type="text" placeholder="ingrese sus apellidos" pattern=".*\S+.*" autofocus required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="direccion">Direccion</label>
                                          <input class="form-control" id="direccion" name="direccion" type="text" pattern=".*\S+.*" placeholder="ingrese su direccion " required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="edad">Edad</label>
                                          <input class="form-control" id="edad" name="edad" type="number" placeholder="ingrese su edad" pattern=".*\S+.*" autofocus required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="telefono">Telefono</label>
                                          <input class="form-control" id="telefono" name="telefono" type="number" pattern=".*\S+.*" placeholder="ingrese su telefono " required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="password">Contraseña</label>
                                          <input class="form-control"  name="password" type="password" pattern=".*\S+.*" placeholder="ingrese una password " required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="rpassword">Confirmar Contraseña</label>
                                          <input class="form-control"  name="password_confirmation" type="password" pattern=".*\S+.*" placeholder="Confirme su password " required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <input type="hidden" value="" id="id_rol_aux2" name="id_rol_aux2" >
                                      <div class="form-group">
                                          <label>Rol</label>
                                          <select class="form-control"  id="id_rol2" name="id_rol2"  required>
                                          <option disabled value="">Seleccionar rol</option>
                                          </select>
                                          <div class="invalid-feedback">Seleccione un rol.</div>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                        <label for="customFile">Previsualizar imagen</label>
                                            <div class="row col-sm-6">
                                                <img id="blah" class="img-fluid" src="{{asset('imagenes/usuarios/150x150.png')}}" alt="Photo" style="max-height: 160px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" >
                                  <div class="col-sm-6">
                                    <div class="custom-file">
                                        <input style="cursor: pointer;" type="file" id="img_perfil" name="img_perfil" class="custom-file-input" accept="image/jpeg,jpg" >
                                        <div class="invalid-feedback">Seleccione una imagen porfavor.</div>
                                        @error('img_perfil')
                                        <small class="text-danger"> {{$message}}</small>
                                        @enderror
                                        <label class="custom-file-label align-middle" for="img_perfil" data-browse="Buscar">Seleccione una foto</label>
                                    </div>
                                  </div>
                                </div>
                                <br>
                                <div class="d-flex justify-content-end">
                                    <div>
                                      <button type="submit" class= "btn btn-success btn-sm">Guardar</button>
                                    </div>
                                </div>
                      </form>
                </div>
              </div>
            </div>
          </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header border-bottom-0">
            <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="FormEdicion">
            @csrf
            <div class="modal-body">
              <input type="hidden" class="form-control" id="id_edit" value="0">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="nombreM">Nombre</label>
                    <input type="text" class="form-control" name="nombreM" id="nombreM" placeholder="Escriba el nombre" disabled>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="emailM">Email</label>
                    <input type="text" class="form-control" name="emailM" id="emailM" placeholder="No puede editar" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="apellidosM">Apellidos</label>
                    <input type="text" class="form-control" name="apellidosM" id="apellidosM" placeholder="No puede editar" disabled>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="direccionM">Direccion</label>
                    <input type="text" class="form-control" name="direccionM" id="direccionM" placeholder="No puede editar" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="edadM">Edad</label>
                    <input type="text" class="form-control" name="edadM" id="edadM" placeholder="No puede editar" disabled>
                  </div>
                </div>
                <div class="col-sm-6">
                  <input type="hidden" value="" id="id_rol_aux" name="id_rol_aux" >
                  <div class="form-group">
                      <label for="id_rol">Rol</label>
                      <select class="form-control"  id="id_rol" name="id_rol" required>
                        <option disabled value="">Seleccionar rol</option>
                      </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer border-top-0 d-flex justify-content-center">
                  <button type="submit" class="btn btn-success">Guardar</button>
              </div>
          </form>
        </div>
      </div>
    </div>





@stop

@section('css')
   {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('plugins.Datatables', true)
@section('plugins.Toastr', true)
@section('js')

<script>

  Activo('#example1'); // con que index va iniciar
  Inactivo('#example2');
  ////////
  function Activo(tabla){
    $(document).ready(function() {
        $(tabla).DataTable({
          processing: true,
          serverSide: true,
          responsive: true,
          autoWidth: false,
          destroy: true,
          ajax: "{{route('usuario.DatosServerSideActivo')}}",
          dataType: 'json',
          type: "POST",
          columns: [
            {
              data: 'foto',
             // name: 'foto',
              searchable: false,
              orderable: false,
            },
            {
              data: 'id',
             // name: 'id',
              searchable: false,
              orderable: false,
            },
            {
              data: 'name',
             // name: 'name',
            },
            {
              data: 'apellidos',
             // name: 'apellidos',
            },
            {
              data: 'email',
             // name: 'email',
            },
            {
              data: 'telefono',
             // name: 'telefono',
              searchable: false,
              orderable: false,
            },
            {
              data: 'edad',
             // name: 'edad',
            },
            {
              data: 'direccion',
             // name: 'direccion',
              searchable: false,
              orderable: false,
            },
            {
              data: 'rol_uso',
             // name: 'rol_uso',
            },
            {
              data: 'actions',
             // name: 'actions',
              searchable: false,
              orderable: false,
            }
        ],
      })
    })
  }
  /////////
  function Inactivo(tabla){
    $(document).ready(function() {
        $(tabla).DataTable({
          processing: true,
          serverSide: true,
          responsive: true,
          autoWidth: false,
          destroy: true,
          ajax: "{{route('usuario.DatosServerSideInactivo')}}",
          dataType: 'json',
          type: "POST",
          columns: [
            {
              data: 'foto',
             // name: 'foto',
              searchable: false,
              orderable: false,
            },
            {
              data: 'id',
             // name: 'id',
              searchable: false,
              orderable: false,
            },
            {
              data: 'name',
             // name: 'name',
            },
            {
              data: 'apellidos',
             // name: 'apellidos',
            },
            {
              data: 'email',
             // name: 'email',
            },
            {
              data: 'telefono',
             // name: 'telefono',
              searchable: false,
              orderable: false,
            },
            {
              data: 'edad',
             // name: 'edad',
            },
            {
              data: 'direccion',
             // name: 'direccion',
              searchable: false,
              orderable: false,
            },
            {
              data: 'rol_uso',
             // name: 'rol_uso',
            },
            {
              data: 'actions',
             // name: 'actions',
              searchable: false,
              orderable: false,
            }
        ],
      })
    })
  }
  /////////
  function recarga(){
    $('#example1').DataTable().ajax.reload();
    $('#example2').DataTable().ajax.reload();
  }
//////////////////////////////////////////////////////////////////

  $('#save_usuario').click(function(){  // CARGAR LOS ROLES DISPONIBLES PAL USUARIO
    $.ajax({
        url:"{{asset('')}}"+"usuario/buscar/"+-1, dataType:'json',
        success: function(resultado){
          ////////////colocar el array al selectd ////////////////////
          $('#id_rol2').empty(); // limpiar antes de sobreescribir
          $('#id_rol2').append($('<option  />', {
                 text: 'seleccione un rol',
                 disabled: true,
                 selected:true,
          }));
          resultado.roles.forEach(function(elemento, indice, array) {
                 $('#id_rol2').append($('<option  />', {
                 text: elemento.name,
                 value: elemento.id,
                 }));

          });
        }
    });
  });


  //guardar
  $('#miform').submit(function(e){
      e.preventDefault();
      var link="{{route('usuario.store')}}";
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($('#miform')[0]),
          success:function(response){
            if (response.error==1){
                toastr.error(response.mensaje, 'Actualizar Registro', {timeOut:7000})
               }else{
                  toastr.success('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000})
                  recarga();
                  limpiarFormulario();
               }
          }
      })

  });

  function Modificar(id){
    $.ajax({
        url:"{{asset('')}}"+"usuario/buscar/"+id, dataType:'json',
        success: function(resultado){
          $("#id_edit").val(resultado.datos.id); // ID del usuario
          $("#id_rol_aux").val(resultado.id_rol_user); // id rol actual
          $("#nombreM").val(resultado.datos.name);
          $("#apellidosM").val(resultado.datos.apellidos);
          $("#edadM").val(resultado.datos.edad);
          $("#emailM").val(resultado.datos.email);
          $("#direccionM").val(resultado.datos.direccion);
          ////////////colocar el array al selectd ////////////////////
          $('#id_rol').empty(); // limpiar antes de sobreescribir
          resultado.roles.forEach(function(elemento, indice, array) {
             if (elemento.id==resultado.id_rol_user){ //seleccionar con selected
                 $('#id_rol').append($('<option  />', {
                 text: elemento.name,
                 value: elemento.id,
                 selected: true, //
                 }));
             }else{
               $('#id_rol').append($('<option  />', {
               text: elemento.name,
               value: elemento.id,
               }));
             }
          });
          ///////////////////////////////////////////////////////////
          $('#ModalEditar').modal('show'); // abrir el modal
        }
    });
  };
  //ACTUALIZAR UN REGISTRO
  $('#FormEdicion').submit(function(e){
      e.preventDefault();
      var id_rol_nuevo = $("#id_rol").val();
      var id_rol_antiguo = $("#id_rol_aux").val();
      var id = $("#id_edit").val(); // id usuario
      var _token2 = $("input[name=_token]").val();
      var link="{{asset('')}}"+"usuario/update/"+id;
      $.ajax({
          url: link,
          type: "POST",
          cache: false,
          async: false,
          data:{
              id_rol_nuevo:id_rol_nuevo,
              id_rol_antiguo:id_rol_antiguo,
              _token:_token2
          },
          success:function(response){
              if(response){
                  toastr.info('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000})
              }
          }
      })
    $('#ModalEditar').modal('hide'); // salir modal
    recarga();
  });
  //

  function Eliminar(id){ // modal
    $("#id_delete").val(id);
    $('#ModalEliminar').modal('show');
  };

  // ELIMINAR UN REGISTRO
  $('#Delete').click(function(){
    var id = $("#id_delete").val();
    var link="{{asset('')}}"+"usuario/destroy/"+id;
      $.ajax({
          url: link,
          type: "GET",
          cache: false,
          async: false,
          success:function(resultado){
            toastr.error('El registro fue eliminado correctamente.', 'Eliminar Registro', {timeOut:3000})
          }
      })
    $('#ModalEliminar').modal('hide'); // salir modal
    recarga();
  });
  //

  function Restaurar(id){ // modal
      $("#id_restore").val(id);
      $('#ModalRestaurar').modal('show');
  }
  // ELIMINAR UN REGISTRO
  $('#Restore').click(function(){
    var id = $("#id_restore").val();
    var link="{{asset('')}}"+"usuario/restore/"+id;
      $.ajax({
          url: link,
          type: "GET",
          cache: false,
          async: false,
          success:function(resultado){
            toastr.info('El registro fue restaurado correctamente.', 'Restaurar Registro', {timeOut:3000})
          }
      })
    $('#ModalRestaurar').modal('hide'); // salir modal
    recarga();
  });
  //
  </script>


<script type="text/javascript">
    function readImage (input) {
        if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        }
    }
    $("#img_perfil").change(function () {
        readImage(this);
    });
</script>





@stop
