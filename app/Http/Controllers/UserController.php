<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Nette\Utils\DateTime;

use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!$request->user()->can('view teacher'))
        return response()->json(['message' => 'Bạn không có quyền xem danh sách giảng viên'], Response::HTTP_UNAUTHORIZED);
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        if(!$request->user()->can('add teacher'))
            return response()->json(['message' => 'Bạn không có quyền thêm giảng viên'], Response::HTTP_UNAUTHORIZED);
        if ($request->get('anh')) {
            $image = $request->get('anh');
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('image'))->save(public_path('images/') . $name);
        }

        DB::beginTransaction();
        try {
            $date = date("dmY", strtotime($request->ngaysinh));
            $user = new User($request->all());
            $user->password = Hash::make($date);
            $user->save();
            DB::commit();
            return response()->json($user, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return $user;
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        if(!$request->user()->can('update teacher'))
        return response()->json(['message' => 'Bạn không có quyền sửa thông tin giảng viên'], Response::HTTP_UNAUTHORIZED);
        $user = User::find($id);
        $input = $request->all();
        $user->fill($input);
        return $user->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,Request $request)
    {
        if(!$request->user()->can('delete teacher'))
        return response()->json(['message' => 'Bạn không có quyền xóa giảng viên'], Response::HTTP_UNAUTHORIZED);
        $user = User::where('id', '=', $id)->first;
        if (!$user->isEmpty())
            return $user->delete();
        return response()->json(['message' => 'Không tìm thấy giảng viên'], Response::HTTP_NOT_FOUND);
    }
}