<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class PurchaseOrderListController extends Controller
{
    private $id_user;
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->id_user = Auth::user()->id;

            return $next($request);
        });
    }

    public function purchase_order_list()
    {
        //tabel t_po
        $data_t_po = DB::table('t_po')
        ->where('id_user','=', $this->id_user)
        ->paginate(10);

        return view('nav.list_purchase_order.index', 
        compact('data_t_po'));
    }

    public function filter_tanggal(Request $request)
    {
        $tanggal_po = $request->get('tanggal_po');
        
        $filter_tanggal = DB::table('t_po')
        ->where('tanggal_po', '=', $tanggal_po )
        ->where('id_user', $this->id_user)
        ->paginate(10);

        $filter_tanggal->appends($request->all());
        
        return view('nav.list_purchase_order.filter_tanggal', compact('filter_tanggal'));
    }

    public function lihat_detail_po($id)
    {
        //tabel t_po
        $data_t_po = DB::table('t_po')
        ->where('id','=',$id)
        ->where('id_user','=', $this->id_user)
        ->get();

        $data_t_po_detail = DB::table('t_po_detail')
        ->where('id_po','=', $id)
        ->get(); //or find()

        //return view('nav.list_purchase_order.lihat_detail_po', ['data_t_po_detail' => $data_t_po_detail]);

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

        return view('nav.list_purchase_order.lihat_detail_po', 
        compact('data_t_po','data_t_po_detail','sum_qty_detail_po','sum_sub_total_detail_po'));
    }

    public function store_purchase_order(Request $request, $id)
    {
        //REQUEST VARIABEL UNTUK INPUT PO
        $kode_po = 'PO-1'.$id;
        $tanggal_po = $request->tanggal_po;
        $nama_supplier_atau_vendor = $request->nama_supplier_atau_vendor;
        $cara_bayar = $request->cara_bayar;
        $total_kembali = $request->total_kembali;
        $keterangan = $request->keterangan;

        //REQUEST VARIABEL UNTUK INPUT PO DETAIL
        $id_item = $request->id_item;
        $id_po = $id;
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
            ->where('id',$id)->update([
                'kode_po'=>$kode_po,
                'tanggal_po'=>$tanggal_po,
                'nama_supplier_atau_vendor'=>$nama_supplier_atau_vendor,
                'cara_bayar'=>$cara_bayar,
                'id_user'=>$this->id_user,
                'updated_at'=>$carbon_now
            ]);

            return redirect('/nav/list_purchase_order/'.$id.'/lihat_detail_po')->with('input_succeed','Sent!');
            

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
                'id_po'=>$id,
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
            ->where('id',$id)->update([
                'kode_po'=>$kode_po,
                'tanggal_po'=>$tanggal_po,
                'nama_supplier_atau_vendor'=>$nama_supplier_atau_vendor,
                'cara_bayar'=>$cara_bayar,
                'id_user'=>$this->id_user,
                'updated_at'=>$carbon_now
            ]);

            return redirect('/nav/list_purchase_order/'.$id.'/lihat_detail_po')->with('input_succeed','Sent!');
        }
    }

    public function destroy_detail($id)
    {
        //destroy
        DB::table('t_po_detail')
        ->where('id', '=', $id)
        ->delete();

        return redirect()->back()->with('destroy_succeed','Deleted!');
    }

    public function edit_detail($id)
    {
        $data_t_po_detail = DB::table('t_po_detail')
        ->where('id', $id)
        ->first(); //or find()

        return view('nav.list_purchase_order.edit_detail',['data_t_po_detail' => $data_t_po_detail]);
    }

    public function update_detail(Request $request, $id)
    {
        //REQUEST VARIABEL UNTUK INPUT PO DETAIL
        $id_item = $request->id_item;
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
            'nama_barang'=>$nama_barang,
            'merk_barang'=>$merk_barang,
            'satuan_barang'=>$satuan_barang,
            'qty'=>$qty,
            'harga_satuan'=>$harga_satuan,
            'sub_total'=>$sub_total,
            "updated_at" =>  $carbon_now
        ]);

        $id_po_t_po = DB::table('t_po_detail')
        ->where('id','=',$id)
        ->pluck('id_po');

        $id_t_po = DB::table('t_po')
        ->where('id','=', $id_po_t_po)
        ->orderByDesc('id')
        ->first()
        ->id;

        return redirect('/nav/list_purchase_order/'.$id_t_po.'/lihat_detail_po')->with('input_succeed','Sent!');
    }

    public function destroy_po($id)
    {
        //destroy po
        DB::table('t_po')
        ->where('id','=', $id)
        ->delete();

        //destroy detail
        DB::table('t_po_detail')
        ->where('id_po','=', $id)
        ->delete();

        return redirect('/nav/list_purchase_order')
        ->with('destroy_succeed','Deleted!');
    }
}
