<?php

namespace App\Http\Controllers;

use App\Models\MonhocNgayhoc;
use App\Models\Phonghoc;
use Illuminate\Http\Request;

class PhongHocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Phonghoc::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Phonghoc::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $phonghoc = Phonghoc::find($id);
        return $phonghoc;
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
        $phonghoc = Phonghoc::find($id);
        return $phonghoc->delete();
    }
    public function getPhongHocByDate($start) {
       
        $arrPhongHoc =[];
        $tmp = MonhocNgayhoc::where('start','=',$start)->select('maphong')->get();
        $tmp_arr=[];
        foreach($tmp as $k=>$v)
        {
            array_push($tmp_arr,$v->maphong);
        }
        $arrPhongHoc = Phonghoc::whereNotIn('id',$tmp_arr)->get();
        return $arrPhongHoc;
    }
}
