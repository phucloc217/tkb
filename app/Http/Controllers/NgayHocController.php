<?php

namespace App\Http\Controllers;

use App\Http\Requests\NgayHocRequest;
use App\Models\MonhocLop;
use App\Models\MonhocNgayhoc;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class NgayHocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NgayHocRequest $request)
    {
        $idgv = MonhocLop::join('users', 'monhoc_lop.idgv', 'users.id')->where('monhoc_lop.id', '=', $request->id_monhoc)->select('users.id')->first();
        $check = MonhocNgayhoc::join('monhoc_lop', 'monhoc_ngayhoc.id_monhoc', 'monhoc_lop.id')->where('idgv', '=', $idgv->id)->where('start', '=', date("Y-m-d H:i:s", strtotime($request->start)))->get();
        if (!$check->isEmpty())
            return response()->json(['message' => "Giảng viên này đã có tiết vào buổi này tại lớp ". $check[0]->malop], Response::HTTP_INTERNAL_SERVER_ERROR);
        $ngayhoc = new MonhocNgayhoc();
        $ngayhoc->id_monhoc = $request->id_monhoc;
        date($request->start);
        $ngayhoc->start = date("Y-m-d H:i:s", strtotime($request->start));
        $ngayhoc->end = date("Y-m-d H:i:s", strtotime($request->end));
        return $ngayhoc->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return MonhocNgayhoc::leftJoin('monhoc_lop', 'monhoc_ngayhoc.id_monhoc', 'monhoc_lop.id')->leftJoin('users', 'monhoc_lop.idgv', 'users.id')->where('id_monhoc', '=', $id)->select('monhoc_lop.tenmh as title', 'monhoc_ngayhoc.*', 'users.name as description')->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}