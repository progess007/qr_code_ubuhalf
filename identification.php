<?php
session_start();
require_once('./php/db.php');
require_once(__DIR__.'/qr_decode/autoload.php');

if($_GET['iden']) {

    $iden_user = $_GET['iden'];

    $qr_query = "SELECT * FROM mauth m
                 JOIN qr_path q ON q.member_id = m.m_uid
                 LEFT JOIN faculty f ON f.fa_id = m.m_faculty
                 WHERE q.qr_iden = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $qr_query);
    mysqli_stmt_bind_param($stmt, "s", $iden_user);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);

    // echo $row['qr_id']."<br>".$row['qr_img_path'];

    if($row['m_status'] == 2) {
      $m_status = "นักศึกษา";
    }

    if($row['m_status'] == 3) {
      $m_status = "บุคลากร";
    }

    
} else {
    header('location: ./error.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img2/icon.png">
  <link rel="icon" type="image/png" href="./assets/img2/icon.png">
  <title>
    ร้านค้าลดราคา
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

  body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Roboto', sans-serif;
  }

  .select {
    display: block;
    padding: 1rem 1rem;
    position: relative;
    min-width: 200px;
    
  }
  .select svg {
    position: absolute;
    right: 2rem;
    top: calc(50% - 3px);
    width: 10px;
    height: 6px;
    stroke-width: 2px;
    stroke: #9098a9;
    fill: none;
    stroke-linecap: round;
    stroke-linejoin: round;
    pointer-events: none;
  }
  .select select {
    -webkit-appearance: none;
    padding: 7px 40px 7px 12px;
    width: 100%;
    border: 1px solid #e8eaed;
    border-radius: 5px;
    background: #F9F9F9;
    box-shadow: 0 1px 3px -2px #9098a9;
    cursor: pointer;
    font-family: inherit;
    font-size: 1.5rem;
    transition: all 150ms ease;
  }
  .select select:required:invalid {
    color: #5a667f;
  }
  .select select option {
    color: #223254;
  }
  .select select option[value=""][disabled] {
    display: none;
  }
  .select select:focus {
    outline: none;
    border-color: #07f;
    box-shadow: 0 0 0 2px rgba(0,119,255,0.2);
  }
  .select select:hover + svg {
    stroke: #07f;
  }
  .sprites {
    position: absolute;
    width: 0;
    height: 0;
    pointer-events: none;
    user-select: none;
  }

</style>

<body class="g-sidenav-show  bg-gray-200">

    <div class="container-fluid py-4 mt-5 ">
      <div class="row text-center">

        <div class="col-lg-6 col-md-8 col-12 mx-auto">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-pas1 shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize h4 ps-3">กรุณาเลือกชื่อร้านของท่าน</h6>
              </div>
            </div>

            <div class="card-body px-0 pb-2 ">

                <form>
                    <div class="my-5">
                        <label class="select" for="slct">
                        <select required="required" id="st_name">
                            <option disabled="disabled" selected="selected">กรุณาเลือกชื่อร้าน</option>
                            <option value="พีโอนี่ (Peony)">พีโอนี่ (Peony)</option>
                            <option value="เฮือนกำนัน">เฮือนกำนัน</option>
                            <option value="บัลโคนี่คิส (Balcony Kiss)">บัลโคนี่คิส (Balcony Kiss)</option>
                            <option value="ชาพะยอม (Chapayom)">ชาพะยอม (Chapayom)</option>
                            <option value="มิรัน (Mirun)">มิรัน (Mirun)</option>
                            <option value="ฟาร์มสวีท (Farm Sweet)">ฟาร์มสวีท (Farm Sweet)</option>
                        </select>
                        <svg>
                            <use xlink:href="#select-arrow-down"></use>
                        </svg>
                        </label>
                        <!-- SVG Sprites-->
                        <svg class="sprites">
                        <symbol id="select-arrow-down" viewbox="0 0 10 6">
                            <polyline points="1 1 5 5 9 1"></polyline>
                        </symbol>
                        </svg>
                    </div>

                    <div class="text-center mx-5">
                        <a 
                        href="#"
                        class="btn bg-gradient-primary w-100 h4 my-4 mb-2" 
                        id="store_iden"
                        >
                            กดตรงนี้เพื่อทำการลดราคา
                        </a>

                    </div>
                    
                </form>

            </div> <!-- End Card body -->

          </div>
        </div>
      </div>



      <div class="row text-center mt-5">
        <div class="col-lg-6 col-md-8 col-12 mx-auto">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3 h4">ข้อมูลส่วนบุคคล ผู้ใช้สิทธิ์</h6>
              </div>
            </div>

                <div class="card-body px-0 pb-2">
                    <input 
                        type="hidden" 
                        value="<?=$row['m_uid']?>"
                        id="m_id_iden"
                    >
                </div>

                <div class="text-center mb-3">
                  <input type="hidden" id="val_status" value="<?=$m_status?>">
                    <h4>
                    <span class="text-secondary">ประเภท </span> :
                        <?=$m_status?>
                    </h4>
                </div>

                <div class="text-center mb-3">
                    <h4>
                    <span class="text-secondary">ชื่อ </span> :
                    <input type="hidden" id="val_name" value="<?=$row['m_fname']?> &nbsp;&nbsp; <?=$row['m_lname']?>">
                        <?=$row['m_fname']?> &nbsp;&nbsp; <?=$row['m_lname']?>
                    </h4>
                </div>

              <?php if($row['m_status'] == 2) { ?>
                <div class="text-center mb-3">
                <input type="hidden" id="val_faculty" value="<?=$row['fa_name'] ?>">
                    <h4>
                    <span class="text-secondary">คณะ </span> :
                        <?=$row['fa_name'] ?>
                    </h4>
                </div>
                <?php }?>

                <div class="text-center mb-3">
                  <input type="hidden" id="val_qrCount" value="<?=$row['qr_count']?>">
                    <h4>
                        <span class="text-secondary">จำนวนครั้งที่เหลือ </span> :
                        <?=$row['qr_count']?>
                    </h4>
                </div>



          </div>
        </div>
      </div>

    </div>


  <script src="./assets/js/sweetalert2.js"></script>
  <script src="./assets/js/jquery.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>

  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="./assets/js/material-dashboard.min.js"></script>

  <script>

    // $(document).ready(function(){
    //     let asd = "asdasdas";
    //    Swal.fire({
    //         title: 'Multiple inputs',
    //         html:
    //             '<input id="swal-input1" class="swal2-input">' +
    //             '<input id="swal-input2" class="swal2-input">',
    //     }).then((result) => {
    //         if(result.isConfirmed) {
    //             let ad_login = "ad_login";
    //             let admin_id = $('#swal-input1').val();
    //             let admin_pwd = $('#swal-input2').val();
    //             // console.log(m1+' '+m2);
    //             $('#main').removeClass('d-none');
    //             // location.reload(true);

    //         }
    //     })
    // }) // ready function

    

    $(document).on('click', '#store_iden', function(e) {
        e.preventDefault();

        let store_iden = "store_iden"
        let discount = 1;
        let m_id = $('#m_id_iden').val();
        let st_name = $('#st_name').val();
        let name = $('#val_name').val();
        let faculty = $('#val_faculty').val();
        let status = $('#val_status').val();
        let qr_count = $('#val_qrCount').val();


        let d = new Date();
        let strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate()
                      + " เวลา " +d.getHours() + ":" + d.getMinutes()+"."+d.getSeconds();

        let strDate2 = d.toLocaleString('th-TH', {timeZone: 'Asia/Bangkok',});

        // $.ajax({
        //   url: './php/discont.php',
        //   type: 'post',
        //   data: {
        //           store_iden:store_iden,
        //           m_id:m_id,
        //           discount:discount,
        //           st_name:st_name,
        //           name:name,
        //           faculty:faculty,
        //           status:status,
        //           strDate2:strDate2
        //         },
        //   success: function(res) {
        //     console.log(res);
        //   }
        // })

        // $.ajax({
        //   url: 'https://sheetdb.io/api/v1/a3rv8il1j0824',
        //   type: 'post',
        //   dataType: 'xml',
        //   data: {"ชื่อร้าน": st_name, 
        //           "ชื่อผู้ใช้สิทธิ์": name, 
        //           "คณะ": faculty,
        //           "ประเภท": status,
        //           "วันที่ใช้": strDate2
        //         }
        // })

        if(st_name == null) {
          Swal.fire({
            icon: 'error',
            title: 'กรุณาเลือกร้านก่อนลดราคา',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
          })
        } // Check Null Store Name

        if(st_name != null) {
            Swal.fire({
              title: "ยืนยันการลดราคา",
              icon: 'warning',
              showConfirmButton: true,
              confirmButtonColor: "#3085d6",
              showCancelButton: true,
              cancelButtonColor: "#d33",
              cancelButtonText: 'ยกเลิก',
              confirmButtonText: 'ยืนยัน',
              allowOutsideClick: false
            }).then((result) => {
              if(result.isConfirmed) {
                  $.ajax({
                      url: './php/discont.php',
                      type: 'post',
                      data: {
                              store_iden:store_iden,
                              m_id:m_id,
                              discount:discount,
                              st_name:st_name,
                              name:name,
                              faculty:faculty,
                              status:status,
                              strDate2:strDate2
                            },
                      success: function(res){
                        console.log(res)
                        Swal.fire({
                          icon: 'success',
                          title: `ร้าน <span class="text-primary">${st_name}</span><br>
                              ลดราคาเป็นจำนวนเงิน 20 บาทสำเร็จ`,
                          allowOutsideClick: false
                        }).then(() => {
                          location.reload(true);
                        })

                      }
                  }) // ajax
              } // result isConfirmed
              
          }) // Swal fire
        } // if Check store no null

        if(qr_count == 0) {
          Swal.fire({
            icon: 'error',
            title: 'สิทธื์ของผูใช้ได้หมดลงแล้ว ไม่สามารถลดราคาได้',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
          })
        }



        // console.log(store_iden+' '+discount+' '+m_id+' '+st_name+' '+name
        //           +' '+faculty+' '+status+' '+strDate)

        
    }) // document

  </script>


</body>
</html>