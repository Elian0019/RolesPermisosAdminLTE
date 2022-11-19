@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Roles</h1>
@stop

@section('content')
    <div class="container-fluid">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" onclick="recarga()"  href="#Roles"  data-toggle="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Roles</a></li>
                <li class="nav-item"><a class="nav-link"  onclick="limpiarFormulario()" href="#RolesAgregar" data-toggle="tab"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</a></li>
                <li class="nav-item"><a class="nav-link"  onclick="recarga()"  href="#RolesEliminados" data-toggle="tab"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Eliminados</a></li>             
              </ul>
            </div> 
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="Roles">     
                    <table id="example1" class="table table-responsive-xl table-bordered table-sm table-hover table-striped" style="width: 100%;" >
                        <thead>
                            <tr>  
                              <th width="4%"> id </th>
                              <th>Nombre</th>
                              <th>Descripcion</th>
                              <th width="5%">Acción</th>
                            </tr>
                        </thead>  
                    </table>
                </div>
                <div class="tab-pane" id="RolesEliminados">
                    <table id="example2"  class="table table-responsive-xl table-bordered table-sm table-hover table-striped" style="width: 100%;" >
                        <thead>
                            <tr> 
                              <th width="4%"> id </th>
                              <th>Nombre</th>
                              <th>Descripcion</th>
                              <th width="5%">Acción</th>     
                            </tr>
                        </thead> 
                    </table>  
                </div>
                <div class="tab-pane" id="RolesAgregar">
                    <form id="miform" method="POST" enctype="multipart/form-data"  action="{{route('rol.store')}}" autocomplete="off" class="needs-validation" novalidate>
                        @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="nombre">Nombre</label> 
                                          <input class="form-control" id="nombre" name="nombre" type="text" value="{{old('nombre')}}"placeholder="ingrese un nombre " pattern=".*\S+.*" autofocus required />
                                          <div class="invalid-feedback">Introduzca Nombre.</div>
                                          @error('nombre')
                                          <small class="text-danger"> {{$message}}</small>
                                          @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="email">Descripcion</label> 
                                          <input class="form-control" id="descripcion" name="descripcion" type="text" pattern=".*\S+.*" placeholder="ingrese una descripcion" value="{{old('descripcion')}}" required />
                                          <div class="invalid-feedback">Por favor, coloque una descripcion.</div>
                                          @error('descripcion')
                                          <small class="text-danger"> {{$message}}</small>
                                          @enderror
                                        </div>
                                    </div>
                                </div>
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
            <h5 class="modal-title" id="exampleModalLabel">Editar Rol</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="FormEdicion">
            @csrf
            <div class="modal-body">
              <input type="hidden" class="form-control" id="id_edit" value="1">
              <div class="form-group">
                <label for="nombreM">Nombre</label>
                <input type="text" class="form-control" name="nombreM" id="nombreM" placeholder="Escriba el nombre">
              </div>
              <div class="form-group">
                <label for="descripcionM">Descripcion</label>
                <input type="text" class="form-control" name="descripcionM" id="descripcionM" placeholder="Escriba una descripcion">
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
          ajax: "{{route('rol.DatosServerSideActivo')}}",
          dataType: 'json',
          type: "POST",
          columns: [
              {
                data: 'id',
               // name: 'id',
              },
              {
                data: 'name',
               // name: 'name',
              },
              {
                data: 'descripcion',
               // name: 'descripcion',
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
          ajax: "{{route('rol.DatosServerSideInactivo')}}",
          dataType: 'json',
          type: "POST",
          columns: [
              {
                data: 'id',
                //name: 'id',
              },
              {
                data: 'name',
                //name: 'name',
              },
              {
                data: 'descripcion',
                //name: 'descripcion',
              },
              {
                data: 'actions',
                //name: 'actions',
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

  function Permisos(id){
    $.ajax({
        url:"{{asset('')}}"+"rol/buscar/"+id, dataType:'json',
        success: function(resultado){
          $("#id_edit").val(resultado.id);
          $("#nombreM").val(resultado.name);
          $("#descripcionM").val(resultado.descripcion);
          $('#ModalPermisos').modal('show'); // abrir el modal
        }
    });   
  }

  //guardar 
  $('#miform').submit(function(e){
      e.preventDefault();
      var nombre = $("#nombre").val();
      var descripcion = $("#descripcion").val();
      var _token2 = $("input[name=_token]").val();
      var link="{{route('rol.store')}}";
      $.ajax({
          url: link,
          type: "POST",
          cache: false,
          async: false,
          data:{
              nombre:nombre,
              descripcion:descripcion,
              _token:_token2
          },
          success:function(response){
            if (response.error==1){
                toastr.error(response.mensaje, 'Actualizar Registro', {timeOut:7000})
               }else{
                  toastr.success('El registro fue actualizado correctamente.', 'Actualizar Registro', {timeOut:3000}) 
                  limpiarFormulario();  
                  recarga();
               }
          }
      })
    
    
  });

  function Modificar(id){
    $.ajax({
        url:"{{asset('')}}"+"rol/buscar/"+id, dataType:'json',
        success: function(resultado){
          $("#id_edit").val(resultado.id);
          $("#nombreM").val(resultado.name);
          $("#descripcionM").val(resultado.descripcion);
          $('#ModalEditar').modal('show'); // abrir el modal
        }
    });         
  }
  //ACTUALIZAR UN REGISTRO
  $('#FormEdicion').submit(function(e){
      e.preventDefault();
      var nombre = $("#nombreM").val();
      var descripcion = $("#descripcionM").val();
      var id = $("#id_edit").val();
      var _token2 = $("input[name=_token]").val();
      var link="{{asset('')}}"+"rol/update/"+id;
      $.ajax({
          url: link,
          type: "POST",
          cache: false,
          async: false,
          data:{
              id:id,
              nombre:nombre,
              descripcion:descripcion,
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
  }
  // ELIMINAR UN REGISTRO
  $('#Delete').click(function(){
    var id = $("#id_delete").val();
    var link="{{asset('')}}"+"rol/destroy/"+id;
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
    var link="{{asset('')}}"+"rol/restore/"+id;
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



@stop