<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class PrintOutController extends Controller
{
    private $id_user;
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->id_user = Auth::user()->id;

            return $next($request);
        });
    }

    public function cetak_po($id)
    {
        $data_t_po = DB::table('t_po')
        ->where('id', '=', $id)
        ->where('id_user','=',$this->id_user)
        ->first();

        $data_t_po_detail = DB::table('t_po_detail')
        ->where('id_po','=',$id)
        ->get();
        
        //total qty detail po
        $sum_qty_detail_po = DB::table('t_po_detail')
        ->where('id_po','=',$id)
        ->get()
        ->sum('qty');

        //sub total harga satuan detail po
        $sum_sub_total_detail_po = DB::table('t_po_detail')
        ->where('id_po','=',$id)
        ->get()
        ->sum('sub_total');

        return view('nav.print_out.cetak_po', 
        compact('data_t_po','data_t_po_detail','sum_qty_detail_po','sum_sub_total_detail_po'));
    }
}
