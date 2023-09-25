<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'sdt' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'password' => 'required'
            ]);
 
            $credentials = request(['sdt', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Sai tên đăng nhập hoặc mật khẩu'
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            $user = User::where('sdt', $request->sdt)->first();
 
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Sai mật khẩu');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'access_token' => $tokenResult,
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Sai số điện thoại hoặc mật khẩu',
                'error' => $error,
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}