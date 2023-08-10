<!DOCTYPE html>
<html lang="en">
<head>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img2/icon.png">
  <link rel="icon" type="image/png" href="./assets/img2/icon.png">
  <title>
    ลืมรหัสผ่าน
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
  <link href="./assets/css/sweetalert2.css" rel="stylesheet" />\
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

</style>

<body>
    <div class="container position-sticky z-index-sticky top-0">
    
    </div>

    <main class="main-content mt-0" id="main">
      <section>
        <div class="page-header min-vh-100">
          <div class="container">
            <div class="row">
              <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('./assets/img/illustrations/illustration-signup.jpg'); background-size: cover;">
                </div>
              </div>
              <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                <div class="card card-plain">
                  <div class="card-header">
                    <h4 class="font-weight-bolder">ลืมรหัสผ่าน!</h4>
                    <p class="mb-0">กรุณากรอก Email ที่ใช้ในการสมัครสมาชิก</p>
                  </div>
  
                  <div class="card-body">
  
                    <form action="#" id="my_Submit">
  
                      <div class="input-group input-group-outline mb-3" id="v_icon1">
                        <label class="form-label" id="valid_t1" autocomplete="email">Email </label>
                        <input type="email" class="form-control" id="u_email">
                      </div>
  
                      <div class="form-check form-check-info text-start ps-0">
                        <!-- <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                        <label class="form-check-label" for="flexCheckDefault">
                          I agree the <a href="#" class="text-dark font-weight-bolder">Terms and Conditions</a>
                        </label> -->
                      </div>
  
                      <div class="text-center">
                        <button 
                         type="submit" 
                         class="btn btn-lg bg-gradient-pas1 btn-lg w-100 mt-4 mb-0 text-white"
                        >
                         ยืนยัน
                        </button>
                      </div>
  
                    </form>
  
                  </div>
  
                  <div class="card-footer text-center pt-0 px-lg-2 px-1">
                    <p class="mb-2 text-sm mx-auto">
                      หากมีบัญชีอยู่แล้ว?
                      <a href="./index" class="text-primary text-gradient font-weight-bold">คลิกที่นี่</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/sweetalert2.js"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="./assets/js/material-dashboard.min.js"></script>


<script>

  // Global Variable
  let email = "#u_email";

  $(document).ready(function() {

    const searchUrl = window.location.search;
    const urlParams = new URLSearchParams(searchUrl);

    if(urlParams.get('forgot')) {
        const f_token = urlParams.get('forgot');
        const f_iden = "Forgot Identification";
        $('#main').addClass('d-none');
        // console.log(f_token);

        Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอกรหัสผ่านใหม่',
            html:
                `<input id="pwd" class="swal2-input" placeholder="รหัสผ่านใหม่">
                 <input id="pwd_repeat" class="swal2-input" placeholder="ยืนยันรหัสผ่านใหม่">
                 <div class="d-none" id="check_pass">
                  
                 </div>`,
            allowOutsideClick: false,
            showClass: {
                  popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                  popup: 'animate__animated animate__fadeOutUp'
                },
        }).then((result) => {
            let pwd = $('#pwd').val();
            let pwd_re = $('#pwd_repeat').val();
            if(result.isConfirmed) {
                if(pwd != pwd_re) {
                    Swal.fire({
                        icon: 'error',
                        title: `<h5>รหัสผ่านไม่ตรงกัน
                                    <span class="text-primary">เปลี่ยนแปลงรหัสผ่านไม่สำเร็จ</span>
                                </h5>`,
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        allowOutsideClick: false
                    }).then(() => {
                        location.reload(true);
                    })
                } //pwd != pwd

                if(pwd == pwd_re) {
                    $.ajax({
                        url: './php/login.php',
                        type: 'post',
                        data: {f_iden:f_iden, f_token:f_token, pwd:pwd, pwd_re:pwd_re},
                        success: function(res) {
                            console.log(res);
                            if (res == "f_pass_success") {
                              Swal.fire({
                                icon: 'success',
                                title: 'เปลี่ยนแปลงรหัสผานสำเร็จ',
                                allowOutsideClick: false
                              }).then((result) => {
                                if(result.isConfirmed) {
                                  $(location).attr('href', './index');
                                }
                              })
                            }
                            if (res == "error") {
                              Swal.fire({icon: 'error', title:'error'})
                            }
                        }
                    })
                }
            } // result is Confirm            
        })

    } // if Url Param

    const ch = "#check_pass";
    const success = "swal2-success-message";
    const valid = "swal2-validation-message";
    const but_ch = ".swal2-confirm"

    function ch_valid (res, res2, txt) {
      $(res).removeClass('d-none').removeClass(success).addClass(valid);
      $(res2).text(txt);
    }

    function ch_success (res, res2, txt) {
      $(res).removeClass('d-none').removeClass(valid).addClass(success);
      $(res2).text(txt);
    }

    function but_block (res) {
      $(res).prop('disabled', true);
    }

    function but_unblock (res) {
      $(res).prop('disabled', false);
    }

    $(document).on('keyup', '#pwd', function(){
        let pwd = $(this).val();
        let strRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");
        // console.log(pwd)

        if(pwd.length < 9) {
            ch_valid(ch, ch, 'รหัสผ่านความยาวน้อยกว่า 9 ตัว')
            but_block(but_ch);
        }
        else if (!pwd.match(strRegex)) {
          ch_valid(ch, ch, 'รหัสผ่านต้องมีตัวอักษร a-Z พิมพ์เล็กพิมพ์ใหญ่ อย่างละตัว');
          but_block(but_ch);
        }
        else if(pwd.match(strRegex)) {
          ch_success(ch, ch, 'รหัสผ่านสามารถใช้งานได้');
          but_block(but_ch);
        }

        // if(e.keyCode == 8) {
        //   if(pwd.length == 0) {
        //     ch_valid(ch, ch, 'กรุณากรอก Password');
        //     but_block(but_ch);
        //   }
        // }
        
    })  // pwd keyup


    $(document).on('keyup', '#pwd_repeat', function(){
        let pwd = $('#pwd').val();
        let pwd_re = $(this).val();
        // console.log(pwd)

        if(pwd != pwd_re) {
          ch_valid(ch, ch, 'รหัสผ่านไม่ตรงกัน');
          but_block(but_ch);
        }

        else if(pwd == pwd_re) {
          ch_success(ch, ch, 'รหัสผ่านตรงกัน');
          but_unblock(but_ch);
        }

    }) // pwd-repeat keyup

  }) 


  // =========== Ajax form to PHP Forgot Password
  $(document).on('submit', '#my_Submit' , function(e){
    e.preventDefault();
    const forgot = "forgot";
    const email = $("#u_email").val();

    $.ajax({
        url: './php/login.php',
        type: 'post',
        data: {forgot:forgot, email:email},
        success: function(res) {
            if(res == "f_success") {
                Swal.fire({
                    icon: 'success',
                    title: `<h5>กรุณาตรวจสอบข้อความใน <span class="text-primary">Email</span><br>
                            <span>เพื่อทำการแก้ไขรหัสผ่าน</span>
                            </h5>`,
                    allowOutsideClick: false
                })
            }
            else if(res == "no email") {
                Swal.fire({
                    icon: 'error', 
                    title: 'ไม่พบ Email นี้ในระบบ',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        } // success Function
    }) // Ajax
  
}) // document submit



</script>


</body>
</html>

<!-- คณะ / แยกประเภท(นักศึกษา/บุคลากร(ปิดคณะไว้)) -->