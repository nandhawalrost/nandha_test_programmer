@include('header.index')
@if($data_t_po->isEmpty())

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@else

@foreach($data_t_po as $t_po)
<form class="form" action="/nav/list_purchase_order/{{$t_po->id}}/lihat_detail_po/store_purchase_order" method="POST">

  {{csrf_field()}}    

<div class="container-sm">
<h3><b>ID PO: {{$t_po->id}}</b></h3>
<h3><b>KD PO: {{$t_po->kode_po}}</b></h3>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Tanggal PO</label>
        <div class="col-sm-6">
        <input name = "tanggal_po" value="{{$t_po->tanggal_po}}" type="date" class="form-control" id="">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Nama Supplier/Vendor</label>
        <div class="col-sm-6">
        <input name = "nama_supplier_atau_vendor" value="{{$t_po->nama_supplier_atau_vendor}}" type="text" class="form-control" id="" placeholder="Nama Vendor/Supplier">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Cara Bayar</label>
        <div class="col-sm-6">
                <select name = "cara_bayar">
                    <option value="transfer" @if($t_po->cara_bayar== 'transfer') selected @endif>transfer</option>
                    <option value="cash" @if($t_po->cara_bayar== 'cash') selected @endif>cash</option>
                </select>
        </div>
    </div>
</div>
@endforeach


<div class="container-sm">

<script>
</script>
<!--end success alert-->

<div class="box">
  <div class="box-header">
    <div class="box-body table-responsive">
      <table class = "table table-bordered table-hover table-sm" border="0" cellpadding="" cellspacing="">
        <thead class="thead-light">
          <th>ID Item</th>
          <th>Nama Barang</th>
          <th>Merk Barang</th>
          <th>Satuan Barang</th>
          <th>Qty</th>
          <th>Harga Satuan</th>
          <th>Sub Total</th>
          <th></th>
          <th></th>
        </thead>

        <thead class="thead-light">
            <th>
                <input type="text" name="id_item"  class="form-control" autocomplete="off" />
                    
                </input>
            </th>
            <th>
                    <input type="text" name="nama_barang"  class="form-control" autocomplete="off" />
                        
                    </input>
            </th>
            <th>
                    <input type="text" name="merk_barang"  class="form-control" autocomplete="off" />
                        
                    </input>
            </th>
            <th>
                    <div class="col-sm-6">
                        <select name = "satuan_barang">
                            <option value="pcs" @if($t_po->cara_bayar== 'pcs') selected @endif>pcs</option>
                            <option value="unit" @if($t_po->cara_bayar== 'unit') selected @endif>unit</option>
                            <option value="bungkus" @if($t_po->cara_bayar== 'bungkus') selected @endif>bungkus</option>
                        </select>
                    </div>
            </th>
            <th>
                    <input name = "qty" type="number"  autocomplete="off" class="form-control" id="">
            </th>
            <th>
                    <input name = "harga_satuan" type="number"  autocomplete="off" class="form-control" id="">
            </th>
            <th>
                    
            </th>
            <th>
                    
            </th>
            <th>
                    
            </th>
        </thead>
        <tbody>
          @foreach($data_t_po_detail as $t_po_detail)
          <tr>
            <td>{{$t_po_detail->id_item}}</td>
            <td>{{$t_po_detail->nama_barang}}</td>
            <td>{{$t_po_detail->merk_barang}}</td>
            <td>{{$t_po_detail->satuan_barang}}</td>
            <td align="right">{{$t_po_detail->qty}}</td>
            <td align="right">{{$t_po_detail->harga_satuan}}</td>
            <td align="right">{{$t_po_detail->harga_satuan*$t_po_detail->qty}}</td>
            <td>
              <a href="/nav/list_purchase_order/{{$t_po_detail->id}}/lihat_detail_po/destroy_detail">Hapus</a>
            </td>
            <td>
              <a href="/nav/list_purchase_order/{{$t_po_detail->id}}/lihat_detail_po/edit_detail">Edit</a>
            </td>
          </tr>
          @endforeach
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total:</td>
            <td></td>
            <td>Total:</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td align="right"><b>{{$sum_qty_detail_po}}</b></td>
            <td align="right"></td>
            <td align="right"><b>{{$sum_sub_total_detail_po}}</b></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      
    </div>
  </div>
</div>
</div>

<div class="container-sm">

@if($data_t_po->isEmpty())
<!-- tidak ada sub total -->
@else
<!--success alert-->
@if(session('input_succeed'))
  <div class = "alert alert-success alert-dismissible fade show" role="alert">
  Sent!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if(session('destroy_succeed'))
  <div class = "alert alert-success alert-dismissible fade show" role="alert">
  Deleted!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

    <div class="form-group row">
        <div class="col-sm-12">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Input</button>
        </div>
    </div>
</div>

@endif

</form>

<div class="container-sm">
    <div class="form-group row">
        <div class="col-sm-12">
        <form action = "/nav/print_out/{{$t_po->id}}/cetak_po" method="GET">
        {{csrf_field()}} 
        <button type="submit" class="btn btn-dark btn-lg btn-block">Cetak</button>
        </form>
        </div>
    </div>
</div>

<div class="container-sm">
    <div class="form-group row">
        <div class="col-sm-12">
        <form action = "/nav/list_purchase_order/{{$t_po->id}}/lihat_detail_po/destroy_po" method="GET">
        {{csrf_field()}} 
        <button type="submit" class="btn btn-danger btn-lg btn-block">Hapus PO</button>
        </form>
        </div>
    </div>
</div>

</br>
<div class="container-sm mb-3">
<a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg btn-block">Kembali</a>
</div>

@endif

<!-- javascript untuk bootstrap harus aktif -->
<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
    
</body>
</html>