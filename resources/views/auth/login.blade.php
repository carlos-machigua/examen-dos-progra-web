<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar Sesión</title>

    <link href="{{ asset('sb-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('sb-admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <img src="{{ asset('sb-admin/img/disfarma.png') }}" class="img-fluid mb-3" style="max-width: 180px;">
                            <h1 class="h4 text-gray-900 mb-4">¡Bienvenido!</h1>
                        </div>

                        
                        @csrf

                        <!-- Correo institucional @disfarma.hn -->
                        <div class="form-group">
                            <input type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                placeholder="usuario@disfarma.hn"
                                required autofocus>
                            @error('email')
                                <div class="invalid-feedback pl-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group">
                            <input type="password"
                                name="password"
                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                placeholder="Contraseña"
                                required>
                            @error('password')
                                <div class="invalid-feedback pl-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Casilla Recordar mi sesión -->
                        <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">Recordar mi sesión</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Ingresar
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('sb-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sb-admin/js/sb-admin-2.min.js') }}"></script>
</body>
</html>