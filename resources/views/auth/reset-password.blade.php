<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Stagiaire MESRS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

 
    <!-- Favicon-->
  <link rel="icon" href="/Acceuil/images/emblème2.jpg" type="image/x-icon" />
  <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/Authentification/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/Authentification/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/Authentification/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/Authentification/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/Authentification/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/Authentification/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/Authentification/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/Authentification/css/style.css" rel="stylesheet">
  <link href="/Authentification/css/authentication.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 col-14 mx-auto">


              <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

              <div class="card mb-3">
                <div class="d-flex justify-content-center">
                    <a href="index.html" class="d-flex align-items-center w-auto">
                        <img src="/Authentification/img/sceauBenin.png" style="width: 300px; height: 150px;" alt="" class="mx-auto d-block">
                      <span class="d-none d-lg-block"></span>
                    </a>
                  </div><!-- End Logo -->

                <div class="card-body">
                  <div class=" ">
                    <h5 class="card-title text-center text-success pb-0 fs-5 fw-bold">Rénitialiser</h5>
                    <p class="text-center small"></p>
                  </div>

                    <div class="col-12 pt-3 mb-2" >
                        <label for="yourEmail" class="form-label"> Email</label>
                        <input type="email" name="email" class="form-control" value="{{old('email', $request->email)}}" id="yourEmail" required autofocus autocomplete="username" >
                        @error('email')
                            <div class="d-block text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 mb-2">
                        <label for="yourPassword" class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control"  required>
                        @error('password')
                            <div class="d-block text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                        @error('password_confirmation')
                            <div class="d-block text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <br>
                    <div class="col-12">
                        <button class="btn btn-success w-100" type="submit">Rénitialiser</button>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->

              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/Authentification/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/Authentification/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/Authentification/vendor/chart.js/chart.umd.js"></script>
  <script src="/Authentification/vendor/echarts/echarts.min.js"></script>
  <script src="/Authentification/vendor/quill/quill.min.js"></script>
  <script src="/Authentification/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/Authentification/vendor/tinymce/tinymce.min.js"></script>
  <script src="/Authentification/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/Authentification/js/main.js"></script>

</body>

</html>
