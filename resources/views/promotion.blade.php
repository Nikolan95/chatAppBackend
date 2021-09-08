<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <link href="../metrica/css/dropify.min.css" rel="stylesheet">

    <!-- App css -->
    <link href="../metrica/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../metrica/css/jquery-ui.min.css" rel="stylesheet">
    <link href="../metrica/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="../metrica/css/metisMenu.min.css" rel="stylesheet" type="text/css"/>
    <link href="../metrica/css/app.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <x-app-layout>
        <div class="vertical-center" style="margin-top: 4%">
            <div class="wrapper">
                <div class="title-text">
                    <div class="title login">
                        Neue Aktion als Text
                    </div>
                    <div class="title signup">
                        Neue Aktion als Bild oder PDF
                    </div>
                </div>
                <div class="form-container">
                    <div class="slide-controls">
                        <input type="radio" name="slide" id="login" checked>
                        <input type="radio" name="slide" id="signup">
                        <label for="login" class="slide login">Text</label>
                        <label for="signup" class="slide signup">Bild / PDF</label>
                        <div class="slider-tab"></div>
                    </div>
                    <div class="form-inner">
                        <form action="#" class="login">
                            <div class="form-group" style="margin-top: 2%">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
                            </div>
                            <div class="vertical-center">
                                <div style="margin-top: 2%">
                                    <button type="button" class="btn-grad">Aktion Starten</button>
                                </div>
                            </div>
                        </form>
                        <form action="#" class="signup">
                            <div class="vertical-center" style="margin-top: 10%">
                                <div style="width: 50%">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">File Upload 1</h4>
                                            <p class="text-muted mb-3">Your so fresh input file — Default version</p>
                                            <input type="file" id="input-file-now" class="dropify"/>
                                        </div><!--end card-body-->
                                    </div>
                                </div>
                            </div>
                            <div class="vertical-center">
                                <div style="margin-top: 10%">
                                    <button type="button" class="btn-grad">Aktion Starten</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const loginText = document.querySelector(".title-text .login");
            const loginForm = document.querySelector("form.login");
            const loginBtn = document.querySelector("label.login");
            const signupBtn = document.querySelector("label.signup");
            const signupLink = document.querySelector("form .signup-link a");
            signupBtn.onclick = (() => {
                loginForm.style.marginLeft = "-50%";
                loginText.style.marginLeft = "-50%";
            });
            loginBtn.onclick = (() => {
                loginForm.style.marginLeft = "0%";
                loginText.style.marginLeft = "0%";
            });
            signupLink.onclick = (() => {
                signupBtn.click();
                return false;
            });

        </script>
        <script src="../metrica/js/dropify.min.js"></script>
        <script src="../metrica/js/jquery.form-upload.init.js"></script>
    </x-app-layout>
</body>
</html>
