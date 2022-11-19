@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Permisos</h1> 
@stop
@section('content')
<div class="container-fluid">
    
  <form action="{{route('rol.update_permiso',$id)}}" method="POST">
        @csrf
        <div class="d-flex justify-content-end">
            <div class="form-group">
                <button class="btn btn-info btn-sm"><i class="fas fa-plus"></i>&nbsp;&nbsp;Guardar</button>
                <a class="btn btn-danger btn-sm" href="{{route('rol.index')}}"><i class="far fa-trash-alt"></i>&nbsp;Regresar</a>
            </div>
        </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
        <div class="col">
          <!-- ADMINISTRACION -->
          <div class="card-body">  
            <div class="card card-outline card-primary">
                <div class="card-header text-sm text-center">Usuarios</div>
                <div class="card-body">
                  @foreach ($permisos as $permiso)
                    @if ($permiso->tipo==2)
                    @php($sw='')
                    @foreach ($role as $rol)
                          @if ($rol->id==$permiso->id)
                             @php($sw='checked')
                          @endif
                    @endforeach
                        <div class="custom-control custom-switch">
                              <input class="custom-control-input" type="checkbox" id="{{$permiso->id}}"  {{$sw}}  value ="{{$permiso->id}}" name= "permisos[]"/>
                              <label class="custom-control-label font-weight-normal" for="{{$permiso->id}}" >{{$permiso->subname}}</label>
                        </div>
                    @endif
                  @endforeach
                </div>
            </div>
          </div>
          <!-- -->
        </div>
        <div class="col">
          <!-- Roles -->
          <div class="card-body">  
            <div class="card card-outline card-primary">
                <div class="card-header text-sm text-center">Roles</div>
                <div class="card-body">
                  @foreach ($permisos as $permiso)
                    @if ($permiso->tipo==3)
                    @php($sw='')
                    @foreach ($role as $rol)
                          @if ($rol->id==$permiso->id)
                             @php($sw='checked')
                          @endif
                    @endforeach
                      <div class="custom-control custom-switch">
                        <input class="custom-control-input" type="checkbox" id="{{$permiso->id}}"  {{$sw}}  value ="{{$permiso->id}}" name= "permisos[]"/>
                        <label class="custom-control-label font-weight-normal" for="{{$permiso->id}}" >{{$permiso->subname}}</label>
                      </div>
                    @endif
                  @endforeach
                </div>
            </div>
          </div>
          <!-- -->
        </div>
        <div class="col">
          <!-- INVENTARIO -->
          <div class="card-body">  
            <div class="card card-outline card-primary">
                <div class="card-header text-sm text-center">Inventario</div>
                <div class="card-body">
                  @foreach ($permisos as $permiso)
                    @if ($permiso->tipo==4)
                    @php($sw='')
                    @foreach ($role as $rol)
                          @if ($rol->id==$permiso->id)
                             @php($sw='checked')
                          @endif
                    @endforeach
                       <div class="custom-control custom-switch">
                         <input class="custom-control-input" type="checkbox" id="{{$permiso->id}}"  {{$sw}}  value ="{{$permiso->id}}" name= "permisos[]"/>
                         <label class="custom-control-label font-weight-normal" for="{{$permiso->id}}" >{{$permiso->subname}}</label>
                       </div>
                    @endif
                  @endforeach
                </div>
            </div>
          </div>
          <!-- -->
        </div> 
        <div class="col">
        <!-- REPORTES -->
        <div class="card-body">  
            <div class="card card-outline card-primary">
                <div class="card-header text-sm text-center">Reportes</div>
                <div class="card-body">
                  @foreach ($permisos as $permiso)
                    @if ($permiso->tipo==5)
                    @php($sw='')
                    @foreach ($role as $rol)
                          @if ($rol->id==$permiso->id)
                             @php($sw='checked')
                          @endif
                    @endforeach
                       <div class="custom-control custom-switch">  
                         <input class="custom-control-input" type="checkbox" id="{{$permiso->id}}"  {{$sw}}  value ="{{$permiso->id}}" name= "permisos[]"/>
                         <label class="custom-control-label font-weight-normal" for="{{$permiso->id}}" >{{$permiso->subname}}</label>
                       </div>
                    @endif
                  @endforeach
                </div>
            </div>
          </div>
          <!-- -->
    </div>
 </form>
</div>
@stop
@section('plugins.Datatables', true)
@section('plugins.Toastr', true)
@section('css')
   {{--<link rel="stylesheet" href="/css/admin_custom.css">--}} 
@stop
@section('plugins.Sweetalert2', true)

@section('js')       
@stop