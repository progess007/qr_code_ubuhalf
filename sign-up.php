<?php 
  require_once './php/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img2/icon.png">
  <link rel="icon" type="image/png" href="./assets/img2/icon.png">
  <title>
    สมัครสมาชิก
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

    <main class="main-content mt-0 d-none" id="mainS">
      <section>
        <div class="page-header min-vh-100">
          <div class="container">


          
            <div class="row">
              <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                    style="background-image: url('./assets/img/illustrations/illustration-signup.jpg'); background-size: cover;">
                </div>
              </div>
              <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                <div class="card card-plain">
                  <div class="card-header">
                    <h4 class="font-weight-bolder">
                      สมัครสมาชิก
                      <span class="text-primary" id="txt_st"></span>
                    </h4>
                    <p class="mb-0">กรอกอีเมลและรหัสผ่านเพื่อทำการ สมัครสมาชิก</p>
                  </div>
  
                  <div class="card-body">
  
                    <form action="" id="my_Submit">

                    <input type="hidden" name="" id="u_status">
  
                      <div class="input-group input-group-outline mb-3" id="v_icon1">
                        <label class="form-label" id="valid_t1" autocomplete="email">Email </label>
                        <input type="email" class="form-control" id="u_email">
                      </div>
  
                      <div class="input-group input-group-outline mb-3" id="v_icon2">
                        <label class="form-label" id="valid_t2">รหัสผ่าน</label>
                        <input type="password" class="form-control" id="u_pass">
                      </div>
  
                      <div class="input-group input-group-outline mb-3" id="v_icon3">
                        <label class="form-label" id="valid_t3">ยืนยันรหัสผ่าน</label>
                        <input type="password" class="form-control" id="u_passC">
                      </div>

                      <div class="input-group input-group-outline mt-5 mb-3" id="v_icon4">
                        <label class="form-label" id="valid_t4">รหัสนักศึกษา</label>
                        <input type="text" class="form-control" id="u_stId">
                      </div>
  
                      <div class="row">
                        <div class="col-md-6">
                          <div class="input-group input-group-outline my-3" id="v_icon5">
                            <label class="form-label" id="valid_t5">ชื่อ</label>
                            <input type="text" class="form-control" id="u_name">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-group input-group-outline my-3" id="v_icon6">
                            <label class="form-label" id="valid_t6">นามสกุล</label>
                            <input type="text" class="form-control" id="u_lname">
                          </div>
                        </div>
                      </div>
  
                      <div class="input-group input-group-static mb-4 mt-4" id="v_icon7">
                        <label for="exampleFormControlSelect1" id="valid_t7" class="ms-0">เลือกคณะ</label>
                        <select class="form-control text-center" id="u_faculty">
                          <option value="" disabled selected><-- กรุณาเลือกคณะ --></option>
                          <?php
                            $sql = "SELECT * FROM faculty";
                            $sql = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_array($sql)) {
                              echo'<option value="'.$row['fa_id'].'">'.$row["fa_name"].'</option>';
                            }
                          ?>
                        </select>
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
                         class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0"
                        >
                         ยืนยันการสมัครสมาชิก
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

  $(document).ready(function() {

    Swal.fire({
      icon: 'warning',
      title: 'กรุณาเลือกประเภท',
      showDenyButton: true,
      confirmButtonText: 'นักศึกษา',
      denyButtonText: 'บุคลากร',
      allowOutsideClick: false
    }).then((result) => {
      if(result.isConfirmed) {
        // unhide Main Section
        $('#mainS').removeClass('d-none');

        $('#u_status').attr('value', 2)
        $('#txt_st').text('นักศึกษา')
      } 
      
      else if (result.isDenied) {
        // unhide Main Section
        $('#mainS').removeClass('d-none');

        $('#u_status').attr('value', 3)
        $('#txt_st').text('บุคลากร')
        $('#v_icon7').addClass('d-none')
        $('#v_icon4').addClass('d-none')

      }

    }) // then
  }) // document .ready 

  
    // Global Bootstrap Class
    const isVal = "is-valid"; // success
    const inVal = "is-invalid"; // unsuccess
    const isValf = "valid-feedback"; // success
    const inValf = "invalid-feedback"; //Un success

    // Global input ID Validation 
    const u_email = "#u_email"; const u_pass = "#u_pass"; const u_passC = "#u_passC";
    const u_stId = "#u_stId"; const u_name = "#u_name"; const u_lname = "#u_lname";
    const u_faculty = "#u_faculty"; const u_status= "#u_status";

    // Global label ID Validation
    const v1 = "#valid_t1"; const v2 = "#valid_t2"; const v3 = "#valid_t3";
    const v4 = "#valid_t4"; const v5 = "#valid_t5"; const v6 = "#valid_t6";
    const v7 = "#valid_t7";

    // Global Div ID Validation
    const d1 = "#v_icon1"; const d2 = "#v_icon2"; const d3 = "#v_icon3";
    const d4 = "#v_icon4"; const d5 = "#v_icon5"; const d6 = "#v_icon6";
    const d7 = "#v_icon6";

    function in_isVal(res , res2, txt) {
      $(res).addClass(inVal).removeClass(isVal);
      $(res2).text(txt);
    }

    function is_inVal(res, res2, txt) {
      $(res).addClass(isVal).removeClass(inVal);
      $(res2).text(txt);
    }

    // function put_txt(res, txt) {$(res).text(txt);}

    $(u_email).on('keyup', function(e){
      let email = $(this).val();
      let e_check = "e_check";

      if(!email.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/)) {
        in_isVal(d1, v1, "รูปแบบ Email ไม่ถูกต้อง");
      }
      else if(email.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/)) {
        is_inVal(d1, v1, "Email นี้สามารถใช้งานได้");

        $.ajax({
          url: './php/test.php',
          type: 'post',
          data: {e_check:e_check, email:email},
          success: function(res) {
            if(email == res) {
              in_isVal(d1, v1, "Email นี้ถูกใช้งานไปแล้ว");
            }
            else {
              is_inVal(d1, v1, "Email นี้สามารถใช้งานได้");
            }
          }
        })
      }

      if(e.keyCode == 8) {
        if(email.length == 0) {
          in_isVal(d1, v1, "Email");
        }
      }

    })  // Email Keyup

    $(u_pass).on('keyup', function(e) {
      let pwd = $(this).val();
      let strRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");

      if (pwd.length < 6) {
        in_isVal(d2, v2, "รหัสผ่านความยาวน้อยกว่า 6");
      }
      else if (!pwd.match(strRegex)) {
        in_isVal(d2, v2, "รหัสผ่านต้องมีตัวอักษร a-Z พิมพ์เล็กพิมพ์ใหญ่ อย่างละตัว");
      }
      else if (pwd.match(strRegex)) {
        is_inVal(d2, v2, "รหัสผ่านสามารถใช้งานได้");
      }

      if(e.keyCode == 8) {
        if(pwd.length == 0) {
          in_isVal(d2, v2, "รหัสผ่าน");
        }
      }
    }) // password KeyUp

    $(u_passC).on('keyup', function(e){
      let pwd = $(u_pass).val();
      let pwdC = $(this).val();

      if (pwd != pwdC) {
        in_isVal(d3, v3, "รหัสผ่านไม่ตรงกัน");
      }
      else if (pwd == pwdC) {
        is_inVal(d3, v3, "รหัสผ่านตรงกัน");
      }

      if(e.keyCode == 8) {
        if(pwdC.length == 0) {
          in_isVal(d3, v3,"ยืนยันรหัสผ่าน");
        }
      }
    }) // PassWord Confirm KeyUp

    $(u_stId).on('keyup', function(e){
      let stId = $(this).val();

      if(stId.length > 10) {
        is_inVal(d4, v4, "กรอกรหัสนึกษาเรียบร้อย");
      }

      if(e.keyCode == 8) {
        if(pwdC.length == 0) {
          in_isVal(d4, v4, "รหัสนักศึกษา");
        }
      }
    }) // StudentID keyup

    $(u_name).on('keyup', function(e) {
      let name = $(this).val();

      if(!name.match(/^[ก-๙]*$/)) {
        in_isVal(d5, v5, "กรอกได้เฉพาะชื่อภาษาไทย");
      }
      else if(name.match(/^[ก-๙]*$/)) {
        is_inVal(d5, v5, "สามารถใช้ชื่อนี้ได้");
      }

      if(e.keyCode == 8) {
        if(name.length == 0) {
          in_isVal(d5, v5, "ชื่อ");
        }
      }
    })

    $(u_lname).on('keyup', function(e) {
      let lname = $(this).val();

      if(!lname.match(/^[ก-๙]*$/)) {
        in_isVal(d6, v6, "กรอกได้เฉพาะภาษาไทย");
      }
      else if (lname.match(/^[ก-๙]*$/)) {
        is_inVal(d6, v6, "สามารถใช้นามสกุลนี้ได้");
      }

      if(e.keyCode == 8) {
        if(lname.length == 0) {
          in_isVal(d6, v6, "นามสกุล");
        }
      }
    })

    $(document).on('submit', '#my_Submit', function(e){
        e.preventDefault();
        let insert = "insert";
        let email = $(u_email).val();
        let pwd = $(u_pass).val();
        let pwdC = $(u_passC).val();
        let stId = $(u_stId).val();
        let fname = $(u_name).val();
        let lname = $(u_lname).val();
        let faculty = $(u_faculty).val();
        let status = $(u_status).val();
        


        // console.log(insert+' '+email+' '+pwd+' '+pwdC+' '+stId+' '+fname+' '+lname+' '+faculty+' k '+status);
        $.ajax({
            url: './php/test.php',
            type: 'post',
            data: {
                insert:insert,
                email:email,
                pwd:pwd,
                pwdC:pwdC,
                stId:stId,
                fname:fname,
                lname:lname,
                faculty:faculty,
                status:status
            },
            success: function(res) {
              console.log(res);

                if(res == "emp email,pwd,pwdC") {
                    Swal.fire({icon: 'error', title: 'ไม่ได้ใส่ Email หรือ Password'})
                }
                else if(res == "email format err") {
                    Swal.fire({icon: 'error', title: 'รูปแบบ Email ไม่ถูกต้อง'})
                }
                else if(res == "pwd not match") {
                    Swal.fire({icon: 'error', title: 'รูปแบบ Email ไม่ถูกต้อง'})
                }
                else if(res == "name err") {
                    Swal.fire({icon: 'error', title: 'ยังไม่ได้กรอกชื่อ และ นามสกุล'})
                }
                else if(res == "email used") {
                  Swal.fire({icon: 'error', title: 'Email นี้ถูกใช้ไปแล้ว'})
                }
                else if(res == "member full") {
                  Swal.fire({icon: 'error', title: 'จำนวนการลงทะเบียนครบ 120 คนแล้ว'})
                }
                else if(res == "sql err") {
                  Swal.fire({icon: 'error', title: 'Cannot connect to SQL1'})
                }
                else if(res == "sql err2") {
                  Swal.fire({icon: 'error', title: 'Cannot connect to SQL2'})
                }
                else if(res == "success") {
                  Swal.fire({
                    icon: 'success', 
                    title: 'สมัครสมาชิกสำเร็จ',
                    html: `กรุณายืนยัน
                      <span class="text-primary text-gradient font-weight-bold">
                         อีเมล 
                      </span>ก่อนเข้าใช้งาน<br>โครงการคนละครึ่ง คนละใบ คนละใจ
                    `,
                    allowOutsideClick: false,
                    timer: 15000,
                    timerProgressBar: true,
                  }).then(() => {
                    $(location).attr('href', './index')
                  })
                }
                
            } // Success Ajax
        })
    })
</script>


</body>
</html>

<!-- คณะ / แยกประเภท(นักศึกษา/บุคลากร(ปิดคณะไว้)) -->