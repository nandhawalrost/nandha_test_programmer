@include('header.invoice')

<div class="container-sm">
<script>window.print();</script>
<table  class = "table table-borderless table-sm">
    <thead class="">
        <th width="150"></th>
        <th width="1"></th>
        <th></th>
    </thead>
    <tbody>
        <tr>
            <td>ID PO</td>
            <td>:</td>
            <td>{{$data_t_po->id}}</td>
        </tr>
        <tr>
            <td>KD PO</td>
            <td>:</td>
            <td>{{$data_t_po->kode_po}}</td>
        </tr>
        <tr>
            <td>TANGGAL PO</td>
            <td>:</td>
            <td>{{$data_t_po->tanggal_po}}</td>
        </tr>
        <tr>
            <td>NAMA SUPPLIER/VENDOR</td>
            <td>:</td>
            <td>{{$data_t_po->nama_supplier_atau_vendor}}</td>
        </tr>
        <tr>
            <td>CARA BAYAR</td>
            <td>:</td>
            <td>{{$data_t_po->cara_bayar}}</td>
        </tr>
    </tbody>
</table>
</div>

<div class="container-sm">

<table class = "table table-borderless table-sm" border="0" cellpadding="" cellspacing="">
        <thead class="">
          <th width="50">ID Item</th>
          <th width="50">Nama Barang</th>
          <th width="50">Merk Barang</th>
          <th width="50">Satuan Barang</th>
          <th width="50">qty</th>
          <th width="50">Harga Satuan</th>
        </thead>
        <tbody>
          @foreach($data_t_po_detail as $t_po_detail)
          <tr>
            <td>{{$t_po_detail->id_item}}</td>
            <td>{{$t_po_detail->nama_barang}}</td>
            <td>{{$t_po_detail->merk_barang}}</td>
            <td>{{$t_po_detail->satuan_barang}}</td>
            <td>{{$t_po_detail->qty}}</td>
            <td>{{$t_po_detail->harga_satuan}}</td>
          </tr>
          @endforeach
          
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Qty:</td>
            <td><b>{{$sum_qty_detail_po}}</b></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total:</td>
            <td><b>Rp. {{$sum_sub_total_detail_po}}</b></td>
          </tr>
        </tbody>
      </table>
</div>


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