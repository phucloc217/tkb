<?php

namespace App\Http\Controllers;

use App\Http\Requests\MonHocRequest;
use App\Models\MonhocLop;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MonHocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!$request->user()->can('view subject'))
            return response()->json(['message' => 'Bạn không có quyền xem danh sách môn học'], Response::HTTP_UNAUTHORIZED);
        return MonhocLop::leftJoin('users', 'monhoc_lop.idgv', 'users.id')->select('monhoc_lop.*', 'users.name')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MonHocRequest $request)
    {
        if (!$request->user()->can('add subject'))
            return response()->json(['message' => 'Bạn không có quyền thêm môn học'], Response::HTTP_UNAUTHORIZED);
        $monhoc = new MonhocLop();
        $monhoc->tenmh = $request->tenmh;
        $monhoc->sotiet = $request->sotiet;
        $monhoc->conlai = $request->sotiet;
        $monhoc->malop = $request->malop;
        $monhoc->idgv = $request->idgv;
        return $monhoc->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return MonhocLop::leftJoin('users', 'monhoc_lop.idgv', 'users.id')->where('malop', "=", $id)->select('monhoc_lop.*', 'users.name')->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        if (!$request->user()->can('delete subject'))
            return response()->json(['message' => 'Bạn không có quyền xóa môn học'], Response::HTTP_UNAUTHORIZED);
        $monhoc = MonhocLop::find($id);
        return $monhoc->delete();
    }
}