<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
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
}
