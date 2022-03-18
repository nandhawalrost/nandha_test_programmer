<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class PurchaseOrderController extends Controller
{
    private $id_user;
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->id_user = Auth::user()->id;

            return $next($request);
        });
    }

    public function purchase_order()
    {
        $cek_isi_t_po = DB::table('t_po')
        ->where('id_user','=', $this->id_user)
        ->get();

        //if id_t_po_terakhir isempty then id_t_po_terakhir = 0, else  select id terakhir
        if($cek_isi_t_po->isEmpty())
        {
            $id_t_po_terakhir = 0;
        }elseif(!$cek_isi_t_po->isEmpty())
        {
            $id_t_po_terakhir = DB::table('t_po')
            ->where('id_user','=', $this->id_user)
            ->orderByDesc('id')
            ->first()
            ->id;
        }

        //tampil table berdasar id user yang login

        //tabel t_po
        $data_t_po = DB::table('t_po')
        ->where('id','=',$id_t_po_terakhir)
        ->where('id_user','=', $this->id_user)
        ->get();

        //tabel t_po_detail
        $data_t_po_detail = DB::table('t_po_detail')
        ->where('id_po','=',$id_t_po_terakhir)
        ->get();
        
        //total qty detail po
        $sum_qty_detail_po = DB::table('t_po_detail')
        ->where('id_po','=',$id_t_po_terakhir)
        ->get()
        ->sum('qty');

        //sub total harga satuan detail po
        $sum_sub_total_detail_po = DB::table('t_po_detail')
        ->where('id_po','=',$id_t_po_terakhir)
        ->get()
        ->sum('sub_total');

        return view('nav.purchase_order.index', 
        compact('data_t_po','data_t_po_detail','sum_qty_detail_po','sum_sub_total_detail_po'));
    }

    public function store_purchase_order(Request $request)
    {
        //deklarasi variabel untuk if($cek_isi_t_po->isEmpty()
        $cek_isi_t_po = DB::table('t_po')
        ->where('id_user','=', $this->id_user)
        ->get();

        //if t_po isempty then id_t_po_terakhir = 0 else select $id_t_po_terakhir terakhir
        if($cek_isi_t_po->isEmpty())
        {
            $id_t_po_terakhir = 0;
        }elseif(!$cek_isi_t_po->isEmpty())
        {
            $id_t_po_terakhir = DB::table('t_po')
            ->where('id_user','=', $this->id_user)
            ->orderByDesc('id')
            ->first()
            ->id;
        }

        //REQUEST VARIABEL UNTUK INPUT PO
        $kode_po = 'PO-1'.$id_t_po_terakhir;
        $tanggal_po = $request->tanggal_po;
        $nama_supplier_atau_vendor = $request->nama_supplier_atau_vendor;
        $cara_bayar = $request->cara_bayar;
        $total_kembali = $request->total_kembali;
        $keterangan = $request->keterangan;

        //REQUEST VARIABEL UNTUK INPUT PO DETAIL
        $id_item = $request->id_item;
        $id_po = $id_t_po_terakhir;
        $nama_barang = $request->nama_barang;
        $merk_barang = $request->merk_barang;
        $satuan_barang = $request->satuan_barang;
        $qty = $request->qty;
        $harga_satuan = $request->harga_satuan;
        $sub_total = $request->harga_satuan*$request->qty;

        $carbon_now = \Carbon\Carbon::now()->setTimezone('Asia/Bangkok');

         //IF ADA INPUT RINCIAN YANG KOSONG
         if(empty($nama_barang)||empty($qty))
         {   
             //update t_po terakhir
            $update_t_po = DB::table('t_po')
            ->where('id',$id_t_po_terakhir)->update([
                'kode_po'=>$kode_po,
                'tanggal_po'=>$tanggal_po,
                'nama_supplier_atau_vendor'=>$nama_supplier_atau_vendor,
                'cara_bayar'=>$cara_bayar,
                'id_user'=>$this->id_user,
                'updated_at'=>$carbon_now
            ]);

            return redirect('/nav/purchase_order')->with('input_succeed','Sent!');
            

        /*
        ELSE IF NAMA BARANG TIDAK KOSONG ATAU QTY TIDAK KOSONG!
        if not empty nama_barang OR not empty qty then insert t_po_detail, update t_po terakhir
        */
        //INPUT T_PO_DETAIL
        }elseif(!empty($nama_barang)||!empty($qty))
        {
            //insert rincian dengan id_transaksi terakhir
            DB::table('t_po_detail')->insert([
                'id_item'=>$id_item,
                'id_po'=>$id_t_po_terakhir,
                'nama_barang'=>$nama_barang,
                'merk_barang'=>$merk_barang,
                'satuan_barang'=>$satuan_barang,
                'qty'=>$qty,
                'harga_satuan'=>$harga_satuan,
                'sub_total'=>$sub_total,
                "created_at" =>  $carbon_now # new \Datetime() | get timezone from php timezone list
            ]);

            //update t_po terakhir
            $update_t_po = DB::table('t_po')
            ->where('id',$id_t_po_terakhir)->update([
                'kode_po'=>$kode_po,
                'tanggal_po'=>$tanggal_po,
                'nama_supplier_atau_vendor'=>$nama_supplier_atau_vendor,
                'cara_bayar'=>$cara_bayar,
                'id_user'=>$this->id_user,
                'updated_at'=>$carbon_now
            ]);

            return redirect('/nav/purchase_order')->with('input_succeed','Sent!');
        }
    }

    public function destroy_detail($id)
    {
        //select t_po by user id
        $id_t_po_terakhir = DB::table('t_po')
        ->where('id_user','=',$this->id_user)
        ->orderByDesc('id')
        ->first()
        ->id;

        //destroy
        DB::table('t_po_detail')
        ->where('id', '=', $id)
        ->where('id_po','=', $id_t_po_terakhir)
        ->delete();

        return redirect('/nav/purchase_order')
        ->with('destroy_succeed','Deleted!');
    }

    public function edit_detail($id)
    {
        //select t_po by user id
        $id_t_po_terakhir = DB::table('t_po')
        ->where('id_user','=',$this->id_user)
        ->orderByDesc('id')
        ->first()
        ->id;

        $data_t_po_detail = DB::table('t_po_detail')
        ->where('id', $id)
        ->where('id_po','=', $id_t_po_terakhir)
        ->first(); //or find()

        return view('nav.purchase_order.edit_detail',['data_t_po_detail' => $data_t_po_detail]);
    }

    public function update_detail(Request $request, $id)
    {
        //select t_po by user id
        $id_t_po_terakhir = DB::table('t_po')
        ->where('id_user','=',$this->id_user)
        ->orderByDesc('id')
        ->first()
        ->id;

        //REQUEST VARIABEL UNTUK INPUT PO DETAIL
        $id_item = $request->id_item;
        $id_po = $id_t_po_terakhir;
        $nama_barang = $request->nama_barang;
        $merk_barang = $request->merk_barang;
        $satuan_barang = $request->satuan_barang;
        $qty = $request->qty;
        $harga_satuan = $request->harga_satuan;
        $sub_total = $request->harga_satuan*$request->qty;

        $carbon_now = \Carbon\Carbon::now()->setTimezone('Asia/Bangkok');

        $update_t_po_detail = DB::table('t_po_detail')
        ->where('id', $request->id)->update([
            'id_item'=>$id_item,
            'id_po'=>$id_po,
            'nama_barang'=>$nama_barang,
            'merk_barang'=>$merk_barang,
            'satuan_barang'=>$satuan_barang,
            'qty'=>$qty,
            'harga_satuan'=>$harga_satuan,
            'sub_total'=>$sub_total,
            "updated_at" =>  $carbon_now
        ]);

        return redirect('/nav/purchase_order')->with('input_succeed','Sent!');
    }

    public function buat_purchase_order_baru(Request $request)
    {
        //select t_po by user id
        $id_t_po_terakhir = DB::table('t_po')
        ->where('id_user','=',$this->id_user)
        ->orderByDesc('id')
        ->first()
        ->id;

        $kode_po = 'PO-1'.$id_t_po_terakhir+1;
        $tanggal_po = $request->tanggal_po;

        DB::table('t_po')->insert([
            'kode_po'=>$kode_po,
            'id_user'=>$this->id_user
        ]);

        return redirect('/nav/purchase_order');
    }

    public function destroy_po($id)
    {
        dd($id);
        
    }
}
