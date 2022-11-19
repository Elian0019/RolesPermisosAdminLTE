<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; //Extencion para importar imagen
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
//use Yajra\DataTables\DataTables;

class UsuarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {if(Auth::user()->hasPermissionTo('usuario')){
        return view('usuarios.index');
    }else{
        return "No tiene permiso";
    }

    }

    public function DatosServerSideActivo(Request $request){
        if ($request->ajax()) {
             $user=User::select('users.*')->with('roles')->where('users.estado','=',1);
             //$user=$user->where('estado',1);
            // $user=User::all()->where('estado',1);
             return DataTables::of($user)
                // anadir nueva columna botones
                 ->addColumn('actions', function($user){
                    // $url= route('rol.permisos',$roles->id);
                    // $url2= route('rol.destroy', $roles->id);
                     $btn= '<div class="btn-group btn-group-sm">'
                     .'<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Editar" onclick="Modificar('.$user->id.')" ><i class="far fa-edit"></i></a>'
                     .'<a class="btn btn-dark" rel="tooltip" data-placement="top" title="Eliminar" onclick="Eliminar('.$user->id.')"><i class="far fa-trash-alt"></i></a>
                     </div>';
                   return  $btn;
                 })
                //
                ->addColumn('foto', function($user){
                    $imagen='imagenes/usuarios/'.$user->id.'.jpg';
                     if (!file_exists($imagen)) {
                      $imagen = "imagenes/usuarios/150x150.png";
                     }
                    $url=asset($imagen.'?'.time());
                   return  '<img width="50" height="30" src="'.$url.'"/>';
                })
                ->addColumn('rol_uso' , function($user){
                    if (isset($user->roles['0']->name)){
                    return $user->roles['0']->name;
                    }else{
                       return 'no tiene rol';
                    }
                })
                 ->rawColumns(['actions','foto','rol_uso']) // incorporar columnas
                 ->make(true); // convertir a codigo
         }
    }

    public function DatosServerSideInactivo(Request $request){
        if ($request->ajax()) {
            $user=User::select('users.*')->with('roles')->where('users.estado','=',0);
           // $user=$user->where('estado',0);
            // $user=User::all()->where('estado',0);
             return DataTables::of($user)
                // anadir nueva columna botones
                 ->addColumn('actions', function($user){
                     //$url= route('rol.permisos',$roles->id);
                     $btn= '<div class="btn-group btn-group-sm">'
                     .'<a class="btn btn-secondary" rel="tooltip" data-placement="top" title="Restaurar" onclick="Restaurar('.$user->id.')"><i class="fas fa-arrow-alt-circle-up"></i></a>
                     </div>';
                   return  $btn;
                 })
                //
                ->addColumn('foto', function($user){
                    $imagen='imagenes/usuarios/'.$user->id.'.jpg';
                     if (!file_exists($imagen)) {
                      $imagen = "imagenes/usuarios/150x150.png";
                     }
                    $url=asset($imagen.'?'.time());
                   return  '<img width="50" height="30" src="'.$url.'"/>';
                })
                ->addColumn('rol_uso' , function($user){
                    if (isset($user->roles['0']->name)){
                    return $user->roles['0']->name;
                    }else{
                       return 'no tiene rol';
                    }
                })
                 ->rawColumns(['actions','foto','rol_uso']) // incorporar columnas
                 ->make(true); // convertir a codigo
        }
    }


    public function perfil()
    {
        return view('usuarios/perfil');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer|min:2',
            'telefono' => 'required|digits_between: 1,9',
            'apellidos' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'img_perfil' => 'image|mimes:jpg,jpeg',
            'password' => 'required|string|min:2|confirmed',
            'email' => 'required|string|email|max:255|unique:users',
            'id_rol2' => 'required',
        ]);

        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all()
            return $data;
        }

        $usuario=User::create([
            'name'=> $request->nombre,
            'email' => $request->email,
            'apellidos'=> $request->apellidos,
            'edad'=> $request->edad,
            'direccion'=> $request->direccion,
            'telefono'=> $request->telefono,
            'password' => Hash::make($request->password),
        ])->assignRole($request->id_rol2);
        if ($request->hasFile("img_perfil")) {//existe un campo de tipo file?
            $imagen = $request->file("img_perfil"); //almacenar imagen en variable
            $nombreimagen=Str::slug($usuario->id).".".$imagen->guessExtension();//insertar parametro del nombre de imagen
            $ruta = public_path("imagenes/usuarios/");//guardar en esa ruta
            $imagen->move($ruta,$nombreimagen); //mover la imagen es esa ruta y con ese nombre

        }
        return $request;
    }

    public function update_perfil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer|min:2',
            'telefono' => 'required|digits_between: 1,9',
            'apellidos' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'img_perfil' => 'image|mimes:jpg,jpeg'
        ]);

        if($validator->fails())
        {
            $data=['error'=>'1','mensaje'=>$validator->errors()->all()];  // all()
            return $data;
        }

        $id=Auth::user()->id; // extraemos el id del user logeado
        $user=User::findOrFail($id);
        $user->name=$request->nombre;
        $user->apellidos=$request->apellidos;
        $user->edad=$request->edad;
        $user->telefono=$request->telefono;
        $user->direccion=$request->direccion;
        $user->update();

        //script para subir editar una imagen
        if ($request->hasFile("img_perfil")) {
            $image_path = public_path("imagenes/usuarios/{$id}.jpg");
            if (File::exists($image_path)) {
                File::delete($image_path);  //eliminar imagen existente
            }

            $imagen = $request->file("img_perfil");
            $nombreimagen =  $id.".jpg";
            $ruta = public_path("imagenes/usuarios/");
            $imagen->move($ruta,$nombreimagen);
        }
        return $request;
    }

    public function update_password(Request $request)
    {
        $id=Auth::user()->id; // extraemos el id del user logeado
        $user=User::findOrFail($id);
         if (Hash::check($request->contraseña,$user->password)){
            if($request->nueva_contraseña == $request->confirmar_nueva_contraseña){
                if (Hash::check($request->nueva_contraseña,$user->password)){
                    $data=['error'=>'1','mensaje'=>'contraseña nueva es la misma'];
                    return $data;
                }else{
                    $user->password=Hash::make($request->nueva_contraseña);
                    $user->update();
                    $data=['error'=>'0','mensaje'=>''];
                    return $data;
                }
            }else{
                $data=['error'=>'1','mensaje'=>'son diferentes contraseñas ingresadas'];
                return $data;
            }
         }else{
            $data=['error'=>'1','mensaje'=>'su contraseña actual no esta correcta'];
            return $data;
         }
    }
    public function update(Request $request,$id)
    {
        $user=User::findOrFail($id);
        $user->removeRole($request->id_rol_antiguo);
        $user->assignRole($request->id_rol_nuevo);
        return $request;
    }

    public function buscarPoUsuario($id){
        if ($id==-1){ //  cuando requiera los roles para crear un usuario
            $role = Role::all();
            $res['roles']=$role;
            echo json_encode($res);
        }else{
        $user=User::findOrFail($id);
        $id_rol_user = User::with('roles')->where('id',$id)->first();
        $id_rol_user = $id_rol_user->roles['0']->id;
        $role = Role::all();
        $res['datos']=$user;
        $res['roles']=$role;
        $res['id_rol_user']=$id_rol_user;
        echo json_encode($res);
        }
    }

    public function restore($id)
    {
        $user = User::findOrFail($id);
        $user->estado = 1;
        $user->update();
    }

    public function destroy($id)
    {
      $user = User::findOrFail($id);
      $user->estado = 0;
      $user->update();
    }
}
