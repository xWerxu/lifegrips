<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lifegrips') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
          <a class="navbar-brand">{{ config('app.name', 'Lifegrips') }}</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Wróć do sklepu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Wyloguj') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
          </div>
        </div>
      </nav>
      
      <div class="offcanvas offcanvas-start bg-dark text-white sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-body p-0">
          <nav class="navbar-dark">
              <ul class="navbar-nav">
                  <li>
                      <div class="text-muted small px-3 fw-bold">
                          Panel
                      </div>
                  </li>
                  <li>
                      <a href="#" class="nav-link px-3 active">
                        <span class="me-2"><i class="bi bi-info-circle"></i></span>
                        <span>Informacje ogólne</span>
                      </a>
                  </li>
                  <li class="my-4">
                      <hr class="dropdown-divider">
                  </li>
                  <li>
                      <div class="text-muted small px-3 fw-bold">
                          Sklep
                      </div>
                  </li>
                  <li>
                      <a href="{{ route('admin.category.index') }}" class="nav-link px-3 active">
                          <span class="me-2"><i class="bi bi-tags"></i></span>
                          <span>Kategorie</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.product.index') }}" class="nav-link px-3 active">
                        <span class="me-2"><i class="bi bi-disc"></i></span>
                        <span>Produkty</span>
                      </a>
                  </li>
                  <li>
                    <a href="{{ route('admin.shipment.index') }}" class="nav-link px-3 active">
                      <span class="me-2"><i class="bi bi-truck"></i></span>
                      <span>Dostawy</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('admin.payment.index') }}" class="nav-link px-3 active">
                      <span class="me-2"><i class="bi bi-credit-card"></i></span>
                      <span>Płatności</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('admin.coupon.index') }}" class="nav-link px-3 active">
                      <span class="me-2"><i class="bi bi-cash-coin"></i></span>
                      <span>Kody rabatowe</span>
                    </a>
                  </li>
              </ul>
          </nav>
        </div>
      </div>

      <main class="main-admin mt-3 p-3">
        @yield('content')
    </main>
</body>