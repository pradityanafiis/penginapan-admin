<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GassKos | Register</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('img/GassKosLogo.png') }}">

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/b8fa203308.js" crossorigin="anonymous"></script>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
  <img src="{{ asset('img/GassKosLogo.png') }}" class="brand-image img-circle elevation-5" style="opacity: .8" width="128px" height="128px">
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group mb-3">
          <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="Nama lengkap" value="{{ old('name') }}" required autofocus>
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group mb-3">
          <input type="email" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required>

          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group mb-3">
          <input type="password" name="password" class="form-control form-control-sm @error('password') is-invalid @enderror" placeholder="Password" required>

          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group mb-3">
          <input type="password" name="password_confirmation" class="form-control form-control-sm" placeholder="Retype password" required>
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-sm btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-1 mb-0 text-center">Sudah punya akun? <a href="{{ route('login') }}" class="text-center">Login</a></p>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/adminlte.min.js') }}"></script>
</body>
</html>