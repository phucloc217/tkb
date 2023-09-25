<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Permission::select('name')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        $userPermissions = $user->getAllPermissions();
        $Permissions = [];
        foreach ($userPermissions as $item) {
            array_push($Permissions, $item->name);
        }
        return $Permissions;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $status = $user->syncPermissions($request->permissions);
        return $user->getAllPermissions();
        if ($status)
            return response()->json("Cập nhật thành công",Response::HTTP_OK);
        return response()->json("Cập nhật không thành công",Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
