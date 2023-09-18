<?php

namespace App\Http\Controllers;

use App\Http\Requests\MonHocRequest;
use App\Models\MonhocLop;
use Illuminate\Http\Request;

class MonHocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MonhocLop::leftJoin('users','monhoc_lop.idgv','users.id')->select('monhoc_lop.*','users.name')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MonHocRequest $request)
    {
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
        return MonhocLop::leftJoin('users','monhoc_lop.idgv','users.id')->where('malop',"=",$id)->select('monhoc_lop.*','users.name')->get();
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
        $monhoc = MonhocLop::find($id);
        return $monhoc->delete();
    }
}
