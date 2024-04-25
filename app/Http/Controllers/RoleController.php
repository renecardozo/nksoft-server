<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        try {
            $roles = Role::orderBy('id', 'desc')->get();
            return response()->json($roles);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error al obtener roles',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
    public function getPermissions()
    {
        try {
            $permissions = Permission::all('id', 'name');
            return response()->json($permissions);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error al obtener permisos',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function createRole(Request $request)
    {
        $validatedData = $request->validate([
            'roleName' => 'required|string',
            'permissions' => 'required|array',
        ]);

        try {
            $role = Role::create(['name' => $validatedData['roleName'], 'state' => true]);
            $role->syncPermissions($validatedData['permissions']);
            $this->writerRoute($validatedData['roleName'], $validatedData['permissions']);
            return response()->json(['success' => true, 'message' => 'Rol creado exitosamente', 'role' => $role], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al crear rol: ' . $e->getMessage()], 500);
        }
    }
    public function editRole(Request $request, $id)
    {
        $validatedData = $request->validate([
            'roleName' => 'required|string',
            'permissions' => 'required|array',
        ]);

        try {
            $role = Role::findOrFail($id);
            $role->update(['name' => $validatedData['roleName']]);
            $role->syncPermissions($validatedData['permissions']);
            return response()->json(['success' => true, 'message' => 'Rol actualizado exitosamente', 'role' => $role], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al actualizar rol: ' . $e->getMessage()], 500);
        }
    }


    public function createPermission($permission)
    {
        try {
            $savePermission = Permission::create(['name' => $permission]);
            return $savePermission;
        } catch (\Exception $e) {
            throw new \Exception('Failed to create permission: ' . $e->getMessage());
        }
    }
    public function updateStateRole($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->state = !$role->state;
            $role->save();
            return response()->json(['message' => 'Role state updated successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'No se pudo actualizar el estado del rol', 'error' => $e->getMessage()], 500);
        }
    }
    public function getRole($id)
    {

        $role = Role::with('permissions')->find($id);
        if (!$role) {
            return null;
        }
        $data = [
            'roleName' => $role->name,
            'permissions' => $role->permissions->pluck('name'),
        ];

        return $data;
    }
    public function getRoles()
    {

        $roles = Role::with('permissions')->get();
        if (!$roles) {
            return null;
        }
        $rolesWithPermissions = [];

        foreach ($roles as $role) {
            $permissions = $role->permissions->pluck('name')->toArray();
            $rolesWithPermissions[] = [
                'roleName' => $role->name,
                'permissions' => $permissions
            ];
        }

        return $rolesWithPermissions;
    }
    public function writerRoute($roleName, $permissions)
    {
        $filePath = base_path('routes/api.php');
    
        // Definimos el middleware una vez fuera del bucle
        $middlewareContent = "Route::middleware(['role:$roleName'])->group(function(){\n";
    
        // Recorremos los permisos y generamos una ruta para cada uno
        foreach ($permissions as $permission) {
            $route=$this->getRoute($permission);
            $routeContent = "   Route::{$route['method']}('{$route['url']}', 'App\\Http\\Controllers\\{$route['controller']}@{$route['function']}');\n";
            $middlewareContent .= $routeContent;
        }
    
        // Cerramos el grupo del middleware al final
        $middlewareContent .= "});\n";
    
        // Agregamos el contenido al archivo api.php
        File::append($filePath, $middlewareContent);
    }
    public function getRoute($permission){

        $pathNames = [
            [
                'id' => 1,
                'permission' => 'crear-feriados',
                'controller' => 'FeriadoController',
                'url' => 'feriados',
                'method' => 'post',
                'function' => 'createFeriados'
            ],
            [
                'id' => 2,
                'permission' => 'editar-feriados',
                'controller' => 'FeriadoController',
                'url' => 'feriados/{id}',
                'method' => 'put',
                'function' => 'editFeriados'
            ],
            [
                'id' => 3,
                'permission' => 'eliminar-feriados',
                'controller' => 'FeriadoController',
                'url' => 'feriados/{id}',
                'method' => 'delete',
                'function' => 'deleteFeriados'
            ],
            [
                'id' => 4,
                'permission' => 'crear-calendario',
                'controller' => 'CalendarioController',
                'url' => 'calendario',
                'method' => 'post',
                'function' => 'createCalendario'
            ],
            [
                'id' => 5,
                'permission' => 'editar-calendario',
                'controller' => 'CalendarioController',
                'url' => 'calendario/{id}',
                'method' => 'put',
                'function' => 'editCalendario'
            ],
            [
                'id' => 6,
                'permission' => 'eliminar-calendario',
                'controller' => 'CalendarioController',
                'url' => 'calendario/{id}',
                'method' => 'delete',
                'function' => 'deleteCalendario'
            ],
            [
                'id' => 7,
                'permission' => 'crear-usuarios',
                'controller' => 'UserController',
                'url' => 'usuarios',
                'method' => 'post',
                'function' => 'createUsuarios'
            ],
            [
                'id' => 8,
                'permission' => 'editar-usuarios',
                'controller' => 'UserController',
                'url' => 'usuarios/{id}',
                'method' => 'put',
                'function' => 'editUsuarios'
            ],
            [
                'id' => 9,
                'permission' => 'eliminar-usuarios',
                'controller' => 'UserController',
                'url' => 'usuarios/{id}',
                'method' => 'delete',
                'function' => 'deleteUsuarios'
            ],
            [
                'id' => 10,
                'permission' => 'crear-roles',
                'controller' => 'RolController',
                'url' => 'roles',
                'method' => 'post',
                'function' => 'createRoles'
            ],
            [
                'id' => 11,
                'permission' => 'editar-roles',
                'controller' => 'RolController',
                'url' => 'roles/{id}',
                'method' => 'put',
                'function' => 'editRoles'
            ],
            [
                'id' => 12,
                'permission' => 'eliminar-roles',
                'controller' => 'RolController',
                'url' => 'roles/{id}',
                'method' => 'delete',
                'function' => 'deleteRoles'
            ],
            [
                'id' => 13,
                'permission' => 'crear-materias',
                'controller' => 'MateriaController',
                'url' => 'materias',
                'method' => 'post',
                'function' => 'createMaterias'
            ],
            [
                'id' => 14,
                'permission' => 'editar-materias',
                'controller' => 'MateriaController',
                'url' => 'materias/{id}',
                'method' => 'put',
                'function' => 'editMaterias'
            ],
            [
                'id' => 15,
                'permission' => 'eliminar-materias',
                'controller' => 'MateriaController',
                'url' => 'materias/{id}',
                'method' => 'delete',
                'function' => 'deleteMaterias'
            ],
        ];
        foreach ($pathNames as $path){
            if($path['permission'] == $permission){
                return $path;
            }
        }
        return null;
        
    }
}
