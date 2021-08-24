<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	
 
    <link rel="icon" href="{{asset('images/favicon.png')}}">	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">	
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/all.min.css')}}">	
    <!-- Custom scroll CSS -->
    <link rel="stylesheet" href="{{asset('plugins/mcustomscroll/jquery.mCustomScrollbar.css')}}">
    <!-- App styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
	<body class="account-page">
		<!-- Main Wrapper -->
		<div class="main-wrapper">			
			<!-- Page Content -->
			<div class="content align-items-center">
				<div class="container-fluid">					
					<div class="row">
						<div class="col-md-8 offset-md-2">							
							<!-- Login Tab Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-12 col-lg-6 login-right">
										<div class="login-header">
											<!-- <h3>Login <br><span>Access to our Chat</span></h3> -->
											<a href="index.html">
			                                    <img src="{{asset('images/logo.png')}}" alt="" class="header_image">
			                                </a>
										</div>
										<form action="{{ route('user.login') }}" method="GET">
                                            @csrf
                                            <div class="form-group">
                                                <label>E-Mail</label>
                                                <input class="form-control form-control-lg group_formcontrol" name="email" id="email" type="email" placeholder="Geben sie ihre E-Mail Adresse ein">
                                                @error('username')
                                                    <div class="color"><span class="text-danger"> {{ $message }}</span> </div>
                                                @enderror()
                                                @if($message = Session::get('erroremail'))
                                                    <div class="color"><span class="text-danger"> {{ $message }}</span> </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="new-chat-topic">Passwort</label>
                                                <input class="form-control form-control-lg group_formcontrol" name="password" id="password" type="password" placeholder="gib dein Passwort ein">
                                                @error('password')
                                                    <div class="color" > <span class="text-danger"> {{ $message }}</span> </div>
                                                @enderror()
                                                @if($message = Session::get('errorpass'))
                                                    <div class="color"><span class="text-danger"> {{ $message }}</span> </div>
                                                @endif
                                            </div>
                                            <div class="pt-1">
			                                	<div class="text-center">
			                                     	<button class="btn newgroup_create btn-block d-block w-100" type="submit">Einloggen</button>
			                                    </div>
			                                </div>
										</form>
										<div class="text-center dont-have">Sie haben kein Konto? <a href="/register">Registrieren</a></div>
									</div>
								</div>
							</div>
							<!-- /Login Tab Content -->
						</div>
					</div>
				</div>
			</div>		
			<!-- /Page Content -->
		</div>
		<!-- /Main Wrapper -->	  
	<!-- jQuery -->
    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>	
	<!-- Bootstrap Core JS -->
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>	
	<!-- Custom Scroll JS -->
    <script src="{{asset('js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('plugins/mcustomscroll/jquery.mCustomScrollbar.js')}}"></script>	
	<!-- Custom JS -->
    <script src="{{asset('js/script.js')}}"></script>	
</body>
</html>