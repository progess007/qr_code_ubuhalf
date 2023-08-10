<?php 

include './php/db.php';

$sql = "SELECT * FROM mauth";
$sql = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($sql);

$check_member = mysqli_num_rows($sql);
$check_cal = 120 - $check_member;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img2/icon.png">
  <link rel="icon" type="image/png" href="./assets/img2/icon.png">
  <title>
    โครงการคนละครึ่ง คนละใบ คนละใจ By UBU Green Club
  </title>
  <!--     Fonts and icons     -->
  <link 
   rel="stylesheet"
   type="text/css"
   href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" 
  />

  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/material-dashboard.css" rel="stylesheet" />
  <link href="./assets/css/sweetalert2.css" rel="stylesheet" />
  <!-- Animet CSS -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
</head>

<style>
    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus,
    textarea:-webkit-autofill,
    textarea:-webkit-autofill:hover,
    textarea:-webkit-autofill:focus,
    select:-webkit-autofill,
    select:-webkit-autofill:hover,
    select:-webkit-autofill:focus {
    transition: background-color 5000s ease-in-out 0s;
    }

    .message {
      background-color: white;
      width: 100%;
      max-width: 100%;
      padding: 1em 1em 1em 1.5em;
      border-left-width: 6px;
      border-left-style: solid;
      border-radius: 3px;
      position: relative;
      line-height: 1.5;
    }
    .message + .message {margin-top: 2em;}
    .message:before {
      color: white;
      width: 1.5em;
      height: 1.5em;
      position: absolute;
      top: 1em;
      left: -3px;
      border-radius: 50%;
      transform: translateX(-50%);
      font-weight: bold;
      line-height: 1.5;
      text-align: center;
    }
    .message p {margin: 0 0 1em;}
    .message p:last-child {margin-bottom: 0;}

    .message--error {border-left-color: firebrick;}
    .message--error:before {background-color: firebrick; content: "‼";}
    .message--warning {border-left-color: darkorange;}
    .message--warning:before {background-color: darkorange; content: "!";}
    .message--success {border-left-color: darkolivegreen;}
    .message--success:before {background-color: darkolivegreen; content: "✔";}

</style>
<!-- background-image: url('./assets/img2/bg2.jpg'); -->
<body class="bg-gray-200">

  <main class="main-content mt-0">

    <div class="page-header align-items-start min-vh-100"
     style="background-image: url('./assets/img2/bg2.jpg');">
      <span class="mask bg-gradient-dark opacity-2"></span>
      <div class="container mt-5">

       <!-- <div class="row">
          <div class="col-lg-6 col-md-8 col-12 mb-5 mx-auto">
            <div class="message  message--warning">
              <p>
                <span class="h5">แจ้งเตือน</span> <br>
                ขยายเวลาใช้สิทธิ์โครงการ<br>
                ถึงวันที่ <span class="text-primary"> 18 กันยายน 2565</span><br>

              </p>
            </div>
          </div>
        </div> -->

        <!-- <div class="row">
          <div class="col-lg-6 col-md-8 col-12 mb-5 mx-auto" style="top: 10px;">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              
                <div class="bg-gradient-info shadow-info border-radius-lg py-2 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-1 h5">
                    จำนวนสิทธิ์ที่เหลือ &nbsp;&nbsp;
                     <span class="h3" style="color: #FFB2A6;"> 
                      <?=$check_cal?>
                    </span>
                     <span> &nbsp;&nbsp; สิทธิ์</span>
                  </h4>
                </div>
              
            </div>
          </div>
        </div> -->

        <div class="row">

        

          <div class="col-lg-6 col-md-8 col-12 mx-auto mt-3">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-pas1 shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0 h5">
                    โครงการ<br>คนละครึ่ง คนละใบ คนละใจ (<span style="color: #F5E8C7;" class="text-decoration-underline">เฟส 2</span>)
                    <br>By UBU Green Club</h4>
                  <div class="row mt-3">
                    <div class="col-2 text-center ms-auto">
                      <!-- <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-facebook text-white text-lg"></i>
                      </a> -->
                    </div>
                    <div class="col-2 text-center px-1">
                      <!-- <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-github text-white text-lg"></i>
                      </a> -->
                    </div>
                    <div class="col-2 text-center me-auto">
                      <!-- <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-google text-white text-lg"></i>
                      </a> -->
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-body">

              <h3 class="text-center"> ปิดโครงการ<br> วันที่ <span class="text-primary">18 กันยายน 65</span></h3>

                <form action="" class="text-start" id="my_Login">
                <!--  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="u_email" name="data[email]">
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" id="u_pwd" name="data[psw]">
                  </div>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label mb-0 ms-2" for="rememberMe">จำการเข้าสู่ระบบ</label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-pas1 w-100 my-4 mb-2 text-white">เข้าสู่ระบบ</button>
                  </div>
                  <p class="mt-4 text-sm text-center">
                    ยังไม่มีบัญชี?
                    <a href="./sign-up" class="h5 text-primary text-gradient font-weight-bold">ลงทะเบียน</a>
                  </p>
                  <p class="mt-4 text-sm text-center">
                    จำรหัสผ่านไม่ได้?
                    <a href="./forgot" class="h5 text-primary text-gradient font-weight-bold">กดที่นี่</a>
                  </p> -->
                </form>

              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/sweetalert2.js"></script>
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="./assets/js/material-dashboard.min.js"></script>

    <script>

    // Global ID
    const email = "#u_email";
    const pwd = "#u_pwd";
      

    $(document).ready(function() {
      // Search parameter in Url
      const queryString = window.location.search;
      // console.log(queryString);
      
      // Get value in iden
      const urlParams = new URLSearchParams(queryString);
      
      

      if(urlParams.get('iden')) {
        const iden = urlParams.get('iden');
        const identification = "identification";
        // console.log(iden);

        // =============================== ตรวจสอบการยืนยันผ่าน Email
        $.ajax({
          url: "./php/login.php",
          type: "post",
          data: {identification:identification, iden:iden},
          success: function(res) {
            // console.log(res);
            if(res == "iden success") {
              Swal.fire({
                icon: 'success',
                title: 'ยืนยันบัญชีผ่าน Email สำเร็จ',
                showClass: {
                  popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                  popup: 'animate__animated animate__fadeOutUp'
                },
                allowOutsideClick: false
              })
            }

            if(res == "iden success2") {
              Swal.fire({
                icon: 'warning',
                title: 'Email นี้ยืนยันบัญชีเรียบร้อยแล้ว',
                showClass: {
                  popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                  popup: 'animate__animated animate__fadeOutUp'
                },
                allowOutsideClick: false
              })
            }

          } // success Function
        }) // Ajax function
      }
    }) // Document.ready


    // ============================ Login From ajax to PHP

    $(document).on('submit', '#my_Login', function(e){
      e.preventDefault();
      let login = "login";
      let email = $('#u_email').val();
      let pwd = $('#u_pwd').val();

      $.ajax({
        url: './php/login.php',
        type: 'post',
        data: {
          login:login,
          email:email,
          pwd:pwd
        },
        success: function(res) {
          // console.log(res);
          if(res == "empty data") {
            Swal.fire({icon: 'error', title: 'กรุณาใส่ข้อมูลให้ครบ'})
          }
          else if (res == "Email not verify") {
            Swal.fire({icon: 'error', title: 'กรุณายืนยันอีเมลก่อนเข้าใช้งาน'});
          }
          else if (res == "Login Error") {
            Swal.fire({icon: 'error', title: 'Email หรือ Password ผิดพลาด'});
          }
          else if (res == "login err2") {
            Swal.fire({icon: 'error', title: 'Email หรือ Password ผิดพลาด'});
          }
          else if (res == "login success") {
            Swal.fire({
              icon: 'success',
              title: 'เข้าสู่ระบบสำเร็จ',
              showConfirmButton: false,
              timer: 1500
            }).then(() => {
              $(location).attr('href', './user');
            })
          }
        } // success function
      })
    }) // #my_loggin


      // $(document).on('submit', '#my_Login', function(e) {
      //   e.preventDefault();
      //   let email = $('#u_email').val();
      //   let pwd = $('#u_pwd').val();

      //   $.ajax({
      //     url: 'https://sheetdb.io/api/v1/qfw0cgw9krl9f',
      //     type: 'post',
      //     dataType: 'xml',
      //     data:{"email":email, "psw":pwd},
      //     success: function(res) {
      //       alert(res);
      //     }
      //   })
      // })

  </script>
</body>
</html>

