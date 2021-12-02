<!DOCTYPE html>
<html>
    
<head>
	<title>My Awesome Login Page</title>
     <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('icon/font-awesome/css/font-awesome.min.css') }}">
	<script type="text/javascript" src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap/js/bootstrap.min.js') }}"></script>
	
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">

            {{--<ul>
                @each('includes.user_list', $users, 'user')
            </ul>--}}

            {{--<ul>
            @foreach($users  as $user)
                <li>
                    {{ $user->name }}
                </li>
            @endforeach
            </ul>--}}
           

            @include('includes.errors')

			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="https://cdn.freebiesupply.com/logos/large/2x/pinterest-circle-logo-png-transparent.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					 <form action="{{ route('authenticate') }}" method="post">
                         {{ csrf_field() }}
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control input_user" value="" placeholder="username">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" value="" placeholder="password">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Remember me</label>
							</div>
						</div>
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="button" class="btn login_btn">Login</button>
				   </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Don't have an account? <a href="#" class="ml-2">Sign Up</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="#">Forgot your password?</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
