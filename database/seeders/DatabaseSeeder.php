<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;//necesario
use Spatie\Permission\Models\Permission;//necesario
use Illuminate\Support\Facades\Hash;//necesario
use App\Models\User;//necesario

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //creacion de roles y permisos
        $role1=Role::create(['name'=>'Administrador','descripcion'=>'persona con el control total del sistema']);
        $role2=Role::create(['name'=>'Cliente','descripcion'=>'persona que consta con los servicios basicos']);
        $role3=Role::create(['name'=>'Repartidor','descripcion'=>'persona encargada de movimiento']);
        $role4=Role::create(['name'=>'Recepcionesta','descripcion'=>'persona con el control del sistema basicos']);

        //administracion usuarios
        Permission::create(['name'=> 'usuario', 'subname'=> 'usuario principal','tipo'=>2])->syncRoles([$role1,$role4]);
        Permission::create(['name'=> 'usuario.editar', 'subname'=> 'editar','tipo'=>2])->syncRoles([$role1]);
        Permission::create(['name'=> 'usuario.eliminar', 'subname'=> 'eliminar','tipo'=>2])->syncRoles([$role1]);
        Permission::create(['name'=> 'usuario.agregar', 'subname'=> 'agregar','tipo'=>2])->syncRoles([$role1]);
        Permission::create(['name'=> 'usuario.eliminados', 'subname'=> 'eliminados','tipo'=>2])->syncRoles([$role1,$role4]);
        Permission::create(['name'=> 'usuario.restore', 'subname'=> 'restaurar','tipo'=>2])->syncRoles([$role1]);
        //administracion roles
        Permission::create(['name'=> 'rol', 'subname'=> 'rol principal','tipo'=>3])->syncRoles([$role1,$role4]);
        Permission::create(['name'=> 'rol.editar', 'subname'=> 'editar','tipo'=>3])->syncRoles([$role1]);
        Permission::create(['name'=> 'rol.eliminar', 'subname'=> 'eliminar','tipo'=>3])->syncRoles([$role1]);
        Permission::create(['name'=> 'rol.agregar', 'subname'=> 'agregar','tipo'=>3])->syncRoles([$role1]);
        Permission::create(['name'=> 'rol.eliminados', 'subname'=> 'eliminados','tipo'=>3])->syncRoles([$role1,$role4]);
        Permission::create(['name'=> 'rol.restore', 'subname'=> 'restaurar','tipo'=>3])->syncRoles([$role4]);
        //administracion inventario
        Permission::create(['name'=> 'inventario', 'subname'=> 'inventario principal','tipo'=>4])->syncRoles([$role1]);
        Permission::create(['name'=> 'inventario.editar', 'subname'=> 'editar','tipo'=>4])->syncRoles([$role1]);
        Permission::create(['name'=> 'inventario.eliminar', 'subname'=> 'eliminar','tipo'=>4])->syncRoles([$role1]);
        Permission::create(['name'=> 'inventario.agregar', 'subname'=> 'agregar','tipo'=>4])->syncRoles([$role4]);
        Permission::create(['name'=> 'inventario.eliminados', 'subname'=> 'eliminados','tipo'=>4])->syncRoles([$role1,$role4]);
        Permission::create(['name'=> 'inventario.restore', 'subname'=> 'restaurar','tipo'=>4])->syncRoles([$role4]);
        //administracion reportes
        Permission::create(['name'=> 'reporte.general', 'subname'=> 'reporte general','tipo'=>5])->syncRoles([$role1,$role4]);
        Permission::create(['name'=> 'reporte.mensual', 'subname'=> 'reporte mensual','tipo'=>5])->syncRoles([$role1]);

        //Productos
        Permission::create(['name'=> 'producto', 'subname'=> 'producto principal','tipo'=>6])->syncRoles([$role1,$role4]);
        Permission::create(['name'=> 'producto.almacen', 'subname'=> 'producto almacen','tipo'=>6])->syncRoles([$role1,$role4]);
        Permission::create(['name'=> 'producto.categoria', 'subname'=> 'producto categoria','tipo'=>6])->syncRoles([$role1,$role4]);


         User::create([
             'name' => 'admin',
             'email' => 'admin@gmail.com',
             'apellidos'=>'carvajal',
             'edad'=>'21',
             'direccion'=>'montero',
             'telefono'=>'71619345',
             'password' => Hash::make('123'),
         ])->assignRole('Administrador');

         User::create([
             'name' => 'lucas',
             'email' => 'lucas@gmail.com',
             'apellidos'=>'carvajal barrios',
             'edad'=>'21',
             'direccion'=>'san jose',
             'telefono'=>'71619343',
             'password' => Hash::make('123'),
         ])->assignRole('Cliente');

         User::create([
             'name' => 'Elian',
             'email' => 'elian@gmail.com',
             'apellidos'=>'alvares choque',
             'edad'=>'21',
             'direccion'=>'santa cruz',
             'telefono'=>'71619343',
             'password' => Hash::make('123'),
         ])->assignRole('Repartidor');

         User::create([
             'name' => 'Paniagua',
             'email' => 'paniagua@gmail.com',
             'apellidos'=>'arana',
             'edad'=>'21',
             'direccion'=>'minero',
             'telefono'=>'71619343',
             'password' => Hash::make('123'),
         ])->assignRole('Recepcionesta');

         User::create([
             'name' => 'Enrique',
             'email' => 'enrique@gmail.com',
             'apellidos'=>'condori quispe',
             'edad'=>'21',
             'direccion'=>'montero',
             'telefono'=>'71619343',
             'password' => Hash::make('123'),
         ])->assignRole('Repartidor');

         User::factory(2000)->create();

    }
}
