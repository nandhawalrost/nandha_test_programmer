<html>
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<title>{{ config('app.name', 'Laravel') }}</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<body>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark mb-3"> <!-- mb-3 untuk spasi antara navbar dengan content-->
  <div class="container-fluid">
    <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Purchase Order
            </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/nav/purchase_order">Buat PO</a></li>
              <li><a class="dropdown-item" href="/nav/list_purchase_order">List PO</a></li>
          </ul>

          <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Setelan
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Akun: {{ Auth::user()->name }}</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}">Keluar</a></li>
          </ul>
        </li>
        </li>
      </ul>
      <!--form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Fitur atau Petunjuk" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Cari</button>
      </form-->
    </div>
  </div>
</nav>