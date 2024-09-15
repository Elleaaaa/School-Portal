<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN</title>
  
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">

    <!-- FONTAWSOME -->
    <script src="https://kit.fontawesome.com/a6e8b7ba95.js" crossorigin="anonymous"></script>
    
</head>
<body>
<div class="limiter">
		<div class="container-login100" style="background-image: url('img/backgroundgrad.jpg');">
			<div class="wrap-login100">
				<form method="POST" action="{{ url('/login1') }}" class="login100-form validate-form">
					@csrf
					<span class="login100-form-logo">
						<img src="{{ asset('img/liceologo-sm.png') }}" alt="">
					</span>
					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate="Enter email">
						<input class="input100" type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
						<span class="focus-input100" data-placeholder="&#xf007;"></span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100" data-placeholder="&#xf023;"></span>
					</div>
					@if ($errors->has('email'))
						<div class="text-danger">{{ $errors->first('email') }}</div>
					@endif

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>