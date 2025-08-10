<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class TinController extends Controller
{
    public function index()
    {
        $tin = DB::table('categories')->get();
        return view('home', ['tin'=>$tin]);
    }

    public function chitiet($id)
    {
        $tin = DB::table('categories')->where('id', $id)->first();
        return view('chitiet', ['tin'=>$tin]);
    }

    public function tintrongloai($idLT)
    {
        $tin = DB::table('categories')->where('idLT', $idLT)->get();
        return view('tintrongloai', ['tin'=>$tin]);
    }
}
