<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class SetupController extends Controller
{
    public function checkDatabase()
    {
        try {
            $dbconnect = DB::connection()->getPDO();
            $dbname = DB::connection()->getDatabaseName();
            return $dbname;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function createDatabase()
    {
        try {
            Artisan::call('migrate --no-interaction');
            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function createAdminUser(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $date = date("dmY", strtotime($request->ngaysinh));
            $user = new User($request->all());
            $user->password = Hash::make($date);
            $user->save();
            $user->syncPermissions(Permission::all());
            DB::commit();
            return response()->json($user, Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }
    }
}