@include('header.index')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="form" action="/nav/list_purchase_order/{{$data_t_po_detail->id}}/lihat_detail_po/update_detail" method="POST">

  {{csrf_field()}} 

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
                <input value = "{{$data_t_po_detail->id_item}}" type="text" name="id_item"  class="form-control" autocomplete="off"/>
                    
                </input>
            </th>
            <th>
                    <input value = "{{$data_t_po_detail->nama_barang}}" type="text" name="nama_barang"  class="form-control" autocomplete="off" />
                        
                    </input>
            </th>
            <th>
                    <input value = "{{$data_t_po_detail->merk_barang}}" type="text" name="merk_barang"  class="form-control" autocomplete="off" />
                        
                    </input>
            </th>
            <th>
                    <div class="col-sm-6">
                        <select name = "satuan_barang">
                            <option value="pcs" @if($data_t_po_detail->satuan_barang == 'pcs') selected @endif>pcs</option>
                            <option value="unit" @if($data_t_po_detail->satuan_barang == 'unit') selected @endif>unit</option>
                            <option value="bungkus" @if($data_t_po_detail->satuan_barang == 'bungkus') selected @endif>bungkus</option>
                        </select>
                    </div>
            </th>
            <th>
                    <input value = "{{$data_t_po_detail->qty}}" name = "qty" type="number"  autocomplete="off" class="form-control" id="">
            </th>
            <th>
                    <input value = "{{$data_t_po_detail->harga_satuan}}" name = "harga_satuan" type="number"  autocomplete="off" class="form-control" id="">
            </th>
            <th>
                    
            </th>
            <th>
                    
            </th>
            <th>
                    
            </th>
        </thead>
      </table>
      
    </div>
  </div>
</div>
</div>

<div class="container-sm">

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

</form>

</br>
<div class="container-sm mb-3">
<a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg btn-block">Kembali</a>
</div>

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