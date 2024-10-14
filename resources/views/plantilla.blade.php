<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://icon-icons.com/icons2/947/ICO/512/dogpaw_icon-icons.com_73812.ico">
    <title>Tienda de mascotas</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Tienda de Mascotas</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/tipos">Tipos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/mascotas">Mascotas</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="container-fluid">
        @yield('contenido')
      </div>
</body>
<script type='text/javascript' src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</html>