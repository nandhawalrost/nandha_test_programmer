@include('header.index')

<div class="container-sm">

<script>
</script>
<!--end success alert-->

<form class="form" action="/nav/list_purchase_order/store_purchase_order/filter_tanggal" method="GET">
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Tanggal PO</label>
        <div class="col-sm-6">
        <input name = "tanggal_po" value="" type="date" class="form-control" id="">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-6">
        <input value="Cari Tanggal" type="submit" class="btn btn-primary btn-lg btn-block" id="">
        </div>
    </div>
</form>

<div class="box">
  <div class="box-header">
    <div class="box-body table-responsive">
      <table class = "table table-bordered table-hover table-sm" border="0" cellpadding="" cellspacing="">
        <thead class="thead-light">
          <th>ID</th>
          <th>KD PO</th>
          <th>Tanggal PO</th>
          <th>Nama Supplier/Vendor</th>
          <th>Cara Bayar</th>
          <th></th>
        </thead>
        <tbody>
          @foreach($filter_tanggal as $filter)
          <tr>
            <td>{{$filter->id}}</td>
            <td>{{$filter->kode_po}}</td>
            <td>{{$filter->tanggal_po}}</td>
            <td>{{$filter->nama_supplier_atau_vendor}}</td>
            <td>{{$filter->cara_bayar}}</td>
            <td>
              <a href="/nav/list_purchase_order/{{$filter->id}}/lihat_detail_po">Lihat Detail</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      
    </div>
  </div>
</div>
</div>


</br>
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