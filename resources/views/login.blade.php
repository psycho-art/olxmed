<!DOCTYPE html>
<html>
	<head>
		<title>{{ 'Login - Admin' }}</title>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ URL::asset('backend/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ URL::asset('backend/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ URL::asset('backend/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ URL::asset('backend/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins -->
        <link rel="stylesheet" href="{{ URL::asset('backend/css/skin-blue.min.css') }}">
        <!-- custom styleseet -->
        <link rel="stylesheet" href="{{ URL::asset('backend/css/styles.css') }}">
	</head>
	<body class="login-page">

		<div class="login-box">
		<div class="login-logo">
			<a href="#">{{ $homeSeo->title }}<b></b></a>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">Sign in</p>

			<form role="form" action="{{ route('adminLogin') }}" method="post">
				@csrf

			<div class="form-group has-feedback">
				<input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

			</div>
			<div class="form-group has-feedback">
			<input type="password" name="password" id="password" class="form-control" placeholder="Password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
			</div>
			<div class="row">
				<div class="col-xs-8">
				<div style="margin-left: 1.4em;" class="checkbox icheck">
					<label>
					<input name="remember" type="checkbox"> Remember Me
					</label>
				</div>
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
				<button name="loginadmin" type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div>
				<!-- /.col -->
			</div>
			</form>
			<!-- /.social-auth-links -->


		</div>
		<!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->

        <script src="{{ URL::asset('backend/js/jquery-3.1.1.min.js') }}"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{{ URL::asset('backend/js/bootstrap.min.js') }}"></script>
        <!-- Slimscroll -->
        <script src="{{  URL::asset('backend/js/jquery.slimscroll.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ URL::asset('backend/js/app.min.js') }}"></script>
	</body>
</html>