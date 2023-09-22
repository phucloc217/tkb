<?php

namespace App\Http\Controllers;

use App\Http\Requests\LopHocRequest;
use App\Models\Lophoc;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isEmpty;

class LopHocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!$request->user()->can('view class'))
            return response()->json(['message' => 'Bạn không có quyền xem danh sách lớp'], Response::HTTP_UNAUTHORIZED);
        return Lophoc::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LopHocRequest $request)
    {
        if (!$request->user()->can('add class'))
            return response()->json(['message' => 'Bạn không có quyền thêm lớp mới'], Response::HTTP_UNAUTHORIZED);
        $lop = Lophoc::where('id', '=', $request->id)->get();
        if ($lop->isEmpty())
            return Lophoc::create($request->all());
        return response()->json(['message' => 'Lớp này đã tồn tại'], Response::HTTP_INTERNAL_SERVER_ERROR);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Lophoc::where('id', '=', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        if (!$request->user()->can('delete class'))
            return response()->json(['message' => 'Bạn không có quyền xóa lớp học'], Response::HTTP_UNAUTHORIZED);
        $lophoc = Lophoc::find($id);
        if ($lophoc != null)
            return $lophoc->delete();
        return response()->json(['message' => 'Không tìm thấy lớp học này'], Response::HTTP_NOT_FOUND);
    }
}