<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>



  <style>
    .bg-image-vertical {
      position: relative;
      overflow: hidden;
      background-repeat: no-repeat;
      background-position: right center;
      background-size: auto 100%;
    }

    @media (min-width: 1025px) {
      .h-custom-2 {
        height: 100%;
      }
    }
  </style>
</head>

<body>

  <section class="vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 text-black">

          <div class="px-5 ms-xl-4">
            <!--<i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>-->
            <span class="h1 fw-bold mb-0">Welcome to</span></br>
            <span class="h1 fw-bold mb-0">LoraFish</span>
          </div>

          <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

            <form action="" method="POST" style="width: 23rem;">

              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

              <div class="form-outline mb-4">
                <input type="email" id="form2Example18" class="form-control form-control-lg" />
                <label class="form-label" for="form2Example18">Email address</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="form2Example28" class="form-control form-control-lg" />
                <label class="form-label" for="form2Example28">Password</label>
              </div>

              <div class="form-outline mb-4">
                <div class="row">

                  <div class="col-5">
                    <label class="form-label" for="form2Example18">Login as a?</label>
                  </div>
                  <div class="col-5">
                    <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" style="width: 155px; background-color: red" , type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Category
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Public</a></li>
                        <li><a class="dropdown-item" href="#">Management</a></li>
                        <li><a class="dropdown-item" href="#">Maintenance</a></li>
                        <li><a class="dropdown-item" href="#">Purchaser</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="pt-1 mb-4">
                <button class="btn btn-info btn-lg btn-block" type="button">Login</button>
              </div>

              <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
              <p>Don't have an account? <a href="#!" class="link-info">Register here</a></p>

            </form>

          </div>

        </div>


        <div class="col-sm-6 px-0 d-none d-sm-block" style="background-color: blue;">

          <div class="d-flex align-items-center justify-content-center"  style="height: 100%; background-color: white;">
            <div>
              <img src="../assets/images/backgrounds/imagelogin1.png" alt="" style="width: 70%; position: center;">
            </div>
          </div>

          <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img3.webp"
          alt="Login image" class="w-100 vh-100" style="width: 10px; object-fit: cover; object-position: left;">-->
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>