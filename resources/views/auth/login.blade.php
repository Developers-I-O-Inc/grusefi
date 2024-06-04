<!DOCTYPE html>
<html lang="en">
	<head><base href="../../../">
		<title>Grusefi | Iniciar Sesión</title>
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_body" class="bg-body">

		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-image: url({{asset('img/login.jpg')}}); background-size: cover;">
					<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
						<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
							<a href="../../demo6/dist/index.html" class="py-9 mb-5">
								<img alt="Logo" src="{{asset('img/logo.png')}}" class="h-60px" />
							</a>
							<h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #0f914c;">Bienvenido a Grusefi</h1>
							<p class="fw-bold fs-2" style="color: #986923;">Administración de Plantillas
						</div>
					</div>
				</div>
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<div class="w-lg-500px p-10 p-lg-15 mx-auto rounded shadow-lg">
                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ session('status') }}
                                </div>
                            @endif
							<form class="form w-100" method="POST" action="{{ route('login') }}">
                                @csrf
								<div class="text-center mb-10">
									<h1 class="text-dark mb-3">Iniciar Sesión</h1>
								</div>
								<div class="fv-row mb-10">
									<label class="form-label fs-6 fw-bolder text-dark">Email</label>
									<input class="form-control form-control-lg form-control-solid" type="email" name="email" :value="old('email')" autocomplete="off" />
								</div>
								<div class="fv-row mb-10">
									<div class="d-flex flex-stack mb-2">
										<label class="form-label fw-bolder text-dark fs-6 mb-0">Contraseña</label>
										<a href="../../demo6/dist/authentication/flows/aside/password-reset.html" class="link-primary fs-6 fw-bolder">Olvidaste la contraseña?</a>
									</div>
									<input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
								</div>
                                <div class="flex items-center justify-end mt-4">
                                </div>
								<div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
										<span class="indicator-label">Continue</span>
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
								</div>
							</form>
						</div>
					</div>
					<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
						<div class="d-flex flex-center fw-bold fs-6">
							<a href="https://keenthemes.com" class="text-muted text-hover-primary px-2" target="_blank">Acerca de</a>
							<a href="https://keenthemes.com/support" class="text-muted text-hover-primary px-2" target="_blank">Soporte</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>var hostUrl = "assets/";</script>
		<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
	</body>
</html>
