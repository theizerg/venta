<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsTableSeeder extends Seeder
{
   private $permissions , $gerente_permissions ,$user_permissions;


    public function __construct()
    {
        /*
        set the default permissions
        */
        $this->permissions =  [
                                /* Usuarios */
                                'VerUsuario',
                                'RegistrarUsuario',
                                'EditarUsuario',
                                'EliminarUsuario',
                                
                                
                                /* Asignar permisos */
                                'AsignarPermisos',                              
                               
                               
                                'VerPermisos',
                                'CrearPermisos',
                                'EditarPermisos',
                                'EliminarPermisos',
                                
                                /* Logins */
                                'VerLogins',
                                'VerLogSistema',


                                /* Roles */
                                'VerRole',
                                'RegistrarRole',
                                'EditarRole',
                                'EliminarRole',

                                /*Productos */
                                'VerProducto',
                                'RegistraProducto',
                                'EditaProducto',
                                'EliminaProducto',

                                /*Clientes */
                                'VerCliente',
                                'RegistrarCliente',
                                'EditaCliente',
                                'EliminaCliente',

                                /*Proveedors */
                                'VerProveedor',
                                'RegistrarProveedor',
                                'EditaProveedor',
                                'EliminaProveedor',

                                /*Empleados */
                                'VerEmpleados',
                                'RegistrarEmpleados',
                                'EditaEmpleados',
                                'EliminarEmpleados',

                                /*Caja */
                                'AperturarCaja',
                                'CerrarCaja',

                                /*Ventas */
                                'VerVentas',
                                'RegistrarVentas',
                                'EditaVentas',
                                'EliminarVentas',

                                /*Gastos */
                                'VerGastos',
                                'RegistrarGastos',
                                'EditaGastos',
                                'EliminarGastos',

                                /*Ganancias */
                                'VerGanancias',

                                /*Surcursales */
                                'VerSucursales',
                                'RegistrarSucursales',
                                'EditaSucursales',
                                'EliminarSucursales',

                               
                                


                              ];


        /*
        set the permissions for the user role, by default
        role admin we will assign all the permissions
        */
        $this->gerente_permissions = [
                                    /*Productos */
                                    'VerProducto',
                                    'RegistraProducto',
                                    'EditaProducto',
                                    'EliminaProducto',

                                    /*Clientes */
                                    'VerCliente',
                                    'RegistrarCliente',
                                    'EditaCliente',
                                    'EliminaCliente',

                                    /*Proveedors */
                                    'VerProveedor',
                                    'RegistrarProveedor',
                                    'EditaProveedor',
                                    'EliminaProveedor',

                                    /*Empleados */
                                    'VerEmpleados',
                                    'RegistrarEmpleados',
                                    'EditaEmpleados',
                                    'EliminarEmpleados',

                                    /*Caja */
                                    'AperturarCaja',
                                    'CerrarCaja',

                                    /*Ventas */
                                    'VerVentas',
                                    'RegistrarVentas',
                                    'EditaVentas',
                                    'EliminarVentas',

                                    /*Gastos */
                                    'VerGastos',
                                    'RegistrarGastos',
                                    'EditaGastos',
                                    'EliminarGastos',

                                    /*Ganancias */
                                    'VerGanancias',

                                    /*Surcursales */
                                    'VerSucursales',
                                    'RegistrarSucursales',
                                    'EditaSucursales',
                                    'EliminarSucursales',


                                

                                    ];
         $this->user_permissions = [
                                    'VerProducto',
                                    

                                    /*Clientes */
                                     'VerCliente',
                                     'RegistrarCliente',
                                     'EditaCliente',
                                     'EliminaCliente',

                                     /*Proveedors */
                                     'VerProveedor',
                                     'RegistrarProveedor',
                                     'EditaProveedor',
                                     'EliminaProveedor',

                                     /*Caja */
                                     'AperturarCaja',
                                    

                                     /*Ventas */
                                     'VerVentas',
                                     'RegistrarVentas',
                                     'EditaVentas',
                                     'EliminarVentas',

                                    ];



    }




    public function run()
      {
          // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        foreach ($this->permissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

        // create the admin role and set all default permissions
        $role = Role::create(['name' => 'Super Administrador']);
        $role->givePermissionTo($this->permissions);

        // create the user role and set all user permissions
        $role = Role::create(['name' => 'Gerente']);
        $role->givePermissionTo($this->gerente_permissions);

        // create the user role and set all user permissions
        $role = Role::create(['name' => 'Vendedor']);
        $role->givePermissionTo($this->user_permissions);

    }
}
