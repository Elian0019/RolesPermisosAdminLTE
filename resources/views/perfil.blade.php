@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Perfil</h1>
   
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
      @php
         $imagen = "imagenes/usuarios/".Auth::user()->id.".jpg";
        if (!file_exists($imagen)) {
          $imagen = "imagenes/usuarios/150x150.png";
        }
      @endphp
      <div class="col-md">
          <div class="form-group">
              <label for="customFile">Foto de Perfil</label>
              <div class="row col">
                  <img id="blah" class="img-fluid" src="{{asset($imagen.'?'.time())}}" alt="Photo" style="max-height: 250px;">
              </div>
          </div>
              
       </div>
      <!-- left column -->
      <div class="col-md-4">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Datos Personales</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form enctype="multipart/form-data" id="miform" method="POST"  role="form">
            @csrf
            <div class="card-body">
              <div class="custom-file">
                <input style="cursor: pointer;" type="file" id="img_perfil" name="img_perfil" class="custom-file-input" accept="image/jpeg,jpg">
                <div class="invalid-feedback">Seleccione una imagen porfavor.</div>
                @error('img_perfil')
                <small class="text-danger"> {{$message}}</small>
                @enderror
                <label class="custom-file-label align-middle" for="img_producto" data-browse="Buscar">Cambiar Perfil</label>
              </div>
              <br>
              <br>
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{Auth::user()->name}}" placeholder="escriba su nombre" required>
              </div>
              <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{Auth::user()->apellidos}}" placeholder="escriba su apellido" required>
              </div>
              <div class="form-group">
                <label for="edad">Edad</label>
                <input type="number" class="form-control" id="edad" name="edad" value="{{Auth::user()->edad}}" placeholder="escriba su edad" required>
              </div>
              <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="number" class="form-control" id="telefono" name="telefono" value="{{Auth::user()->telefono}}" placeholder="escriba su telefono" required>
              </div>
              <div class="form-group">
                <label for="direccion">Direccion</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="{{Auth::user()->direccion}}" placeholder="escriba su direccion" required>
              </div>
              <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" value="{{Auth::user()->email}}" disabled placeholder="escriba su correo" required>
              </div>
              <div class="form-group">
                <label for="rol">Rol</label>
                <input type="text" class="form-control" id="rol" name="rol" value="{{Auth::user()->roles[0]->name}}" disabled placeholder="escriba su correo" required>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-success">Actualizar Datos</button>
            </div>
          </form>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Cambiar Contraseña</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="miform2"  method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="contraseña">contraseña actual</label>
                <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="escriba su contraseña" required>
              </div>
              <div class="form-group">
                <label for="nueva_contraseña">Nueva Contraseña</label>
                <input type="password" class="form-control" name="nueva_contraseña" id="nueva_contraseña" placeholder="escriba su nueva contraseña" >
              </div>
              <div class="form-group">
                <label for="confirmar_nueva_contraseña">Confirmar Nueva Contraseña</label>
                <input type="password" class="form-control" name="confirmar_nueva_contraseña" id="confirmar_nueva_contraseña" placeholder="confirme su nueva contraseña" required>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-success">Actualizar Contraseña</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
  @stop

  @section('css')
     
  @stop
  
  @section('plugins.Toastr', true)
  @section('js')

  <script>
    //actualizar datos personales
  $('#miform').submit(function(e){
      e.preventDefault();
      var link="{{route('usuario.update_perfil')}}";
      $.ajax({
          url: link,
          type: "POST",
          //method: "POST",
          enctype: 'multipart/form-data', // para capturar file imagenes
          processData: false,
          contentType: false,
         // cache: false,
         // async: false,
          data: new FormData($('#miform')[0]),  //sirbe para capturar todo el request del formulario con id="miform"
         // data: new FormData($('#miform')),
          success:function(response){
            if (response.error==1){
                toastr.error(response.mensaje, 'Actualizar Registro', {timeOut:4000})
               }else{
                  toastr.success('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000})   
               }
          }
      })
  });
  // actualizar contrasenia
  $('#miform2').submit(function(e){
      e.preventDefault();
      var link="{{route('usuario.update_password')}}";
      $.ajax({
          url: link,
          type: "POST",
          processData: false,
          contentType: false,
          cache: false,
          async: false,
         // new FormData($('#miform')[0])  sirbe para capturar todo el request del formulario con id="miform"
          data: new FormData($('#miform2')[0]),
          success:function(response){
              if(response.error==1){
                  toastr.error(response.mensaje, 'Actualizar Registro', {timeOut:3000})    
              }else{
                toastr.success('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000})  
              }
          }
      })
  });
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