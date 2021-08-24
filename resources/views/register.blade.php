<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dreams Chat - Html Template</title>
	
    <!-- Favicon -->
    <link rel="icon" href="{{asset('images/favicon.png')}}">	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">	
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
                                        <br><br><br><br>
										<div class="login-header">
											<!-- <h3>Login <br><span>Access to our Chat</span></h3> -->
											<a href="index.html">
			                                    <img src="{{asset('images/logo.png')}}" alt="" class="header_image">
			                                </a>
										</div>
										<form action="{{ route('user.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Vorname</label>
                                                <input class="form-control form-control-lg group_formcontrol" name="name" id="name" type="text" placeholder="Geben Sie Ihren Vornamen ein">
                                                @error('name')
                                                    <div class="color"><span class="text-danger"> {{ $message }}</span> </div>
                                                @enderror()
                                            </div>
                                            <div class="form-group">
                                                <label>Nachername</label>
                                                <input class="form-control form-control-lg group_formcontrol" name="surname" id="surname" type="text" placeholder="Geben Sie Ihren Nachnamen ein">
                                                @error('surname')
                                                    <div class="color"><span class="text-danger"> {{ $message }}</span> </div>
                                                @enderror()
                                            </div>
                                            <div class="form-group">
                                                <label>Unternehmen</label>
                                                <input class="form-control form-control-lg group_formcontrol" name="company" id="company" type="text" placeholder="Geben Sie Ihr Unternehmen ein">
                                                @error('company')
                                                    <div class="color"><span class="text-danger"> {{ $message }}</span> </div>
                                                @enderror()
                                            </div>
                                            <div class="form-group">
                                                <label>Straße & Nr</label>
                                                <input class="form-control form-control-lg group_formcontrol" name="street" id="street" type="text" placeholder="Geben Sie Ihre Straße und Hausnummer ein">
                                                @error('street')
                                                    <div class="color"><span class="text-danger"> {{ $message }}</span> </div>
                                                @enderror()
                                            </div>
                                            <div class="form-group">
                                                <label>PLZ, Ort</label>
                                                <input class="form-control form-control-lg group_formcontrol" name="city" id="city" type="text" placeholder="Geben Sie Ihre PLZ / Stadt ein">
                                                @error('city')
                                                    <div class="color"><span class="text-danger"> {{ $message }}</span> </div>
                                                @enderror()
                                            </div>
                                            <div class="form-group">
                                                <label>Telefon</label>
                                                <input class="form-control form-control-lg group_formcontrol" name="telefon" id="telefon" type="text" placeholder="Geben Sie Ihr Telefon ein">
                                                @error('telefon')
                                                    <div class="color"><span class="text-danger"> {{ $message }}</span> </div>
                                                @enderror()
                                            </div>
                                            <div class="form-group">
                                                <label>E-Mail</label>
                                                <input class="form-control form-control-lg group_formcontrol" name="email" id="email" type="email" placeholder="Geben sie ihre E-Mail Adresse ein">
                                                @error('email')
                                                    <div class="color"><span class="text-danger"> {{ $message }}</span> </div>
                                                @enderror()
                                            </div>
                                            <div class="form-group">
                                                <label for="new-chat-topic">Passwort</label>
                                                <input class="form-control form-control-lg group_formcontrol" name="password" id="password" type="password" placeholder="gib dein Passwort ein">
                                                @error('password')
                                                    <div class="color"><span class="text-danger"> {{ $message }}</span> </div>
                                                @enderror()
                                            </div>
                                            <div class="form-group">
                                                <label for="new-chat-topic">Bestätige das Passwort</label>
                                                <input class="form-control form-control-lg group_formcontrol" name="confirm_password" id="confirm_password" type="password" placeholder="Bestätigen Sie Ihr Passwort">
                                                @error('confirm_password')
                                                    <div class="color"><span class="text-danger"> {{ $message }}</span> </div>
                                                @enderror()
                                            </div>
                                            <div class="pt-1">
			                                	<div class="text-center">
			                                     	<button class="btn newgroup_create btn-block d-block w-100" type="submit">Registrieren</button>
			                                    </div>
			                                </div>
										</form>
										<div class="text-center dont-have">Sie haben bereits ein Konto? <a href="/login">Einloggen</a></div>
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