<?php

  session_start();
  require_once('./php/db.php');
  require_once(__DIR__.'/qr_decode/autoload.php');
  use Zxing\QrReader;

    if(empty($_SESSION['id'])) {
      header('location: ./index');
    }

    $checkID = "SELECT * FROM mauth m
                JOIN qr_path q on m.m_uid = q.member_id
                LEFT JOIN faculty f ON f.fa_id = m.m_faculty
                WHERE m.m_uid = ?";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $checkID);
    mysqli_stmt_bind_param($stmt, 's', $_SESSION['id']);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);

    $qrcode = new QrReader($row['qr_img_path']);
    $qrcode_txt = $qrcode->text();

    if($row['m_status'] == 2) {
      $m_status = "นักศึกษา";
    }

    if($row['m_status'] == 3) {
      $m_status = "บุคลากร";
    }

?>

<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets//img2/icon.png">
  <link rel="icon" type="image/png" href="./assets/img2/icon.png">
  <title>
    ข้อมูลผู้ใช้งาน
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

  .dark {background: #110f16;}
  .light {background: #f3f5f7;}
  a, a:hover { text-decoration: none; transition: color 0.3s ease-in-out;}
  #pageHeaderTitle {margin: 2rem 0; text-transform: uppercase; text-align: center; font-size: 2.5rem;}

  /* Cards */
  .postcard {
    flex-wrap: wrap;
    display: flex;
    box-shadow: 0 4px 21px -12px rgba(0, 0, 0, 0.66);
    border-radius: 10px;
    margin: 0 0 2rem 0;
    overflow: hidden;
    position: relative;
    color: #ffffff !important;
  }
  .postcard.dark {background-color: #18151f;}
  .postcard.light {background-color: #e1e5ea;}
  .postcard .t-dark {color: #18151f;}
  .postcard a {
    color: inherit;
  }
  .postcard h1, .postcard .h1 {
    margin-bottom: 0.5rem;
    font-weight: 500;
    line-height: 1.2;
  }
  .postcard .small {font-size: 80%;}
  .postcard .postcard__title {font-size: 1.75rem;}
  .postcard .postcard__img {
    max-height: 180px;
    width: 100%;
    object-fit: cover;
    position: relative;
  }
  .postcard .postcard__img_link {display: contents;}
  .postcard .postcard__bar {
    width: 50px;
    height: 10px;
    margin: 10px 0;
    border-radius: 5px;
    background-color: #424242;
    transition: width 0.2s ease;
  }
  .postcard .postcard__text {
    padding: 1.5rem;
    position: relative;
    display: flex;
    flex-direction: column;
  }
  .postcard .postcard__preview-txt {
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: justify;
    height: 100%;
  }
  .postcard .postcard__tagbox {
    display: flex;
    flex-flow: row wrap;
    font-size: 14px;
    margin: 20px 0 0 0;
    padding: 0;
    justify-content: center;
  }
  .postcard .postcard__tagbox .tag__item {
    display: inline-block;
    background: rgba(83, 83, 83, 0.4);
    border-radius: 3px;
    padding: 2.5px 10px;
    margin: 0 5px 5px 0;
    cursor: default;
    user-select: none;
    transition: background-color 0.3s;
  }
  .postcard .postcard__tagbox .tag__item:hover {background: rgba(83, 83, 83, 0.8);}
  .postcard:before {
    content: ""; position: absolute; top: 0; right: 0; bottom: 0; left: 0;
    background-image: linear-gradient(-70deg, #424242, transparent 50%);
    opacity: 1; border-radius: 10px;}
  .postcard:hover .postcard__bar {width: 100px;}

  @media screen and (min-width: 769px) {
    .postcard {flex-wrap: inherit;}
    .postcard .postcard__title {font-size: 2rem;}
    .postcard .postcard__tagbox {justify-content: start;}
    .postcard .postcard__img {
      max-width: 300px; max-height: 100%; transition: transform 0.3s ease;}
    .postcard .postcard__text {padding: 3rem; width: 100%;}
    .postcard .media.postcard__text:before {
      content: ""; position: absolute; display: block;
      background: #18151f; top: -20%; height: 130%; width: 55px;
    }
    .postcard:hover .postcard__img {transform: scale(1.1);}
    .postcard:nth-child(2n+1) {flex-direction: row;}
    .postcard:nth-child(2n+0) {flex-direction: row-reverse;}
    .postcard:nth-child(2n+1) .postcard__text::before {left: -12px !important; transform: rotate(4deg);}
    .postcard:nth-child(2n+0) .postcard__text::before {right: -12px !important; transform: rotate(-4deg);}
  }
  @media screen and (min-width: 1024px) {
    .postcard__text {padding: 2rem 3.5rem;}
    .postcard__text:before {
      content: ""; position: absolute; display: block; top: -20%;
      height: 130%; width: 55px;}
    .postcard.dark .postcard__text:before {background: #18151f;}
    .postcard.light .postcard__text:before {background: #e1e5ea;}
  }

  /* COLORS */
  .postcard .postcard__tagbox .green.play:hover {background: #79dd09; color: black;}
  .green .postcard__title:hover {color: #79dd09;}
  .green .postcard__bar {background-color: #79dd09;}
  .green::before {background-image: linear-gradient(-30deg, rgba(121, 221, 9, 0.1), transparent 50%);}
  .green:nth-child(2n)::before {background-image: linear-gradient(30deg, rgba(121, 221, 9, 0.1), transparent 50%);}
  .postcard .postcard__tagbox .blue.play:hover {background: #0076bd;}
  .blue .postcard__title:hover {color: #0076bd;}
  .blue .postcard__bar {background-color: #0076bd;}
  .blue::before {background-image: linear-gradient(-30deg, rgba(0, 118, 189, 0.1), transparent 50%);}
  .blue:nth-child(2n)::before {background-image: linear-gradient(30deg, rgba(0, 118, 189, 0.1), transparent 50%);}
  .postcard .postcard__tagbox .red.play:hover {background: #bd150b;}
  .red .postcard__title:hover {color: #bd150b;}
  .red .postcard__bar {background-color: #bd150b;}
  .red::before {background-image: linear-gradient(-30deg, rgba(189, 21, 11, 0.1), transparent 50%);}
  .red:nth-child(2n)::before {background-image: linear-gradient(30deg, rgba(189, 21, 11, 0.1), transparent 50%);}
  .postcard .postcard__tagbox .yellow.play:hover {background: #bdbb49; color: black;}
  .yellow .postcard__title:hover {color: #bdbb49;}
  .yellow .postcard__bar {background-color: #bdbb49;}
  .yellow::before {background-image: linear-gradient(-30deg, rgba(189, 187, 73, 0.1), transparent 50%);}
  .yellow:nth-child(2n)::before {background-image: linear-gradient(30deg, rgba(189, 187, 73, 0.1), transparent 50%);}

  @media screen and (min-width: 769px) {
    .green::before {background-image: linear-gradient(-80deg, rgba(121, 221, 9, 0.1), transparent 50%);}
    .green:nth-child(2n)::before {background-image: linear-gradient(80deg, rgba(121, 221, 9, 0.1), transparent 50%);}
    .blue::before {background-image: linear-gradient(-80deg, rgba(0, 118, 189, 0.1), transparent 50%);}
    .blue:nth-child(2n)::before {background-image: linear-gradient(80deg, rgba(0, 118, 189, 0.1), transparent 50%);}
    .red::before {background-image: linear-gradient(-80deg, rgba(189, 21, 11, 0.1), transparent 50%);}
    .red:nth-child(2n)::before {background-image: linear-gradient(80deg, rgba(189, 21, 11, 0.1), transparent 50%);}
    .yellow::before {background-image: linear-gradient(-80deg, rgba(189, 187, 73, 0.1), transparent 50%);}
    .yellow:nth-child(2n)::before {background-image: linear-gradient(80deg, rgba(189, 187, 73, 0.1), transparent 50%);}
  }
  
</style>
<body>

<main class="main-content mt-0">

<!-- background-image: url('./assets/img2/bg2.jpg'); -->

    <div class="page-header align-items-start min-vh-100" 
    style="">
    
      <span class="mask bg-gradient-dark opacity-2"></span>
      
      <div class="container mt-3">

        <div class="row ">
          <div class="col-lg-6 col-md-8 col-12 mb-5 mx-auto">

            <a href="#" class="text-white btn bg-gradient-info h4 w-100 mb-0" id="store">
              <img src="./assets/img2/store.png" class="w-15"> &nbsp;&nbsp;&nbsp;&nbsp; ร้านค้าที่เข้าร่วมรายการ
              <!-- <div class="row">
                <div class="col-3 col-md-4">
                  
                </div>
                <div class="col-9 col-md-8">
                  
                </div>
              </div> -->
              
              
            </a>
            
          </div>
        </div>
        
        <div class="row mt-4">

          <div class="col-lg-6 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                
                <div class="bg-gradient-pas1 shadow-primary border-radius-lg py-2 pe-1">
                  
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">
                    ข้อมูลผู้ใช้งาน
                  </h4>
                    <div class="row mt-3">
                      
                    </div>
                </div>
              </div>

              <div class="card-body">
                <form class="text-start">

                  <div class="text-center">
                      <img class="img-fluid mt-0 w-60" src="./<?=$row['qr_img_path']?>">
                  </div>

                  
                  <div class="text-center mt-2">
                    ประเภท <h4><?=$m_status?></h4>
                  </div>
                  
                <?php if ($m_status == 2) { ?>
                  <div class="text-center mb-3">
                    คณะ <h4><?=$row['fa_name']?></h4>
                  </div>
                <?php } ?>

                  <div class="text-center mb-3">
                    <h4>
                     ชื่อ : 
                     <span class="text-primary">
                      <?=$row['m_fname']?> &nbsp;&nbsp; <?=$row['m_lname']?>
                     </span>
                    </h4>
                  </div>

                  <div class="text-center mb-3">
                    <h4>
                     จำนวนครั้งที่เหลือ : 
                     <span class="text-primary"><?=$row['qr_count']?></span>
                    </h4>
                  </div>

                  <div class="text-center mb-3">
                    <h4>
                     จำนวนเงิน : 
                     <span class="text-primary"><?=$row['qr_count']*20?></span>
                    </h4>
                  </div>

                  <div class="text-center my-auto" role="alert">
                    <h4 class="ml3 badge badge-pill bg-gradient-info h4">
                      ใช้สิทธิ์ได้ถึงวันที่ 
                      <span class="font-weight-bolder text-2xl text-decoration-underline"
                       
                      > 
                        18 ก.ย. 65
                      </span>
                    </h4>
                    
                  </div>


                  <!-- <h3>This is QrDecoder</h3>
                  <div class="text-center my-3">
                    <span class="btn bg-gradient-warning w-100 my-4 mb-2">
                      <a href="<?=$qrcode_txt?>">คลิกตรงนี้</a>
                      
                    </span>
                  </div> -->

                  <!-- <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label mb-0 ms-2" for="rememberMe">Remember me</label>
                  </div> -->
                  
                  <div class="text-center mt-3">
                    <a href="#" class="btn bg-gradient-primary w-50 my-3 mb-0" id="logout">
                      ออกจากระบบ
                    </a>
                    <!-- <button 
                     type="submit" 
                     class="btn bg-gradient-primary w-100 my-4 mb-2"
                     id="logout";
                     >
                     Logout
                    </button> -->
                  </div>
                  <!-- <p class="mt-4 text-sm text-center">
                    Don't have an account?
                    <a href="./sign-up.php" class="text-primary text-gradient font-weight-bold">Sign up</a>
                  </p> -->
                </form>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>


  <script src="./assets/js/sweetalert2.js"></script>
  <script src="./assets/js/jquery.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>

  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="./assets/js/material-dashboard.min.js"></script>
  <script>
      
    $(document).on('click', '#logout', function(e) {
      e.preventDefault();

      let logout = 'logout'

      Swal.fire({
        title: 'ยืนยันการออกจากระบบ',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก'
      }).then((result) => {
        if(result.isConfirmed) {
          $.ajax({
            url: './php/login.php',
            type: 'post',
            data: {logout:logout},
            success: function(res) {
              Swal.fire({
                icon: 'success',
                title: 'ออกจากระบบสำเร็จ',
                showConfirmButton: false,
                timer: 1500
              }).then(() => {
                $(location).attr('href', './index')
              })
            }
          })
        }
      })

    }) //document fucntion


    $(document).on('click', '#store', function(e){
      e.preventDefault();

      Swal.fire({
        title: '<strong>ร้านค้าที่ <u class="text-primary"> ร่วมรายการ  </u></strong>',
        html: `
          <section class="">
            <div class="container py-2">
              

              <article class="postcard light blue text-white">
                <a class="postcard__img_link" href="#">
                  <img class="postcard__img" src="./assets/img2/rec1.jpg" alt="Peony" />
                </a>
                <div class="postcard__text t-dark">
                  <h1 class="postcard__title blue">
                    <a href="#"> พีโอนี (Peony) </a>
                  </h1>
                </div>
              </article>

              <article class="postcard dark blue">
                <a class="postcard__img_link" href="#">
                  <img class="postcard__img" src="./assets/img2/rec2.jpg" alt="Huenkamnan" />
                </a>
                <div class="postcard__text">
                  <h1 class="postcard__title blue">
                    <a href="#" style="color:white; right:0px;">เฮือนกำนัน </a>
                  </h1>
                </div>
              </article>

              <article class="postcard light red">
                <a class="postcard__img_link" href="#">
                  <img class="postcard__img" src="./assets/img2/rec3.jpg" alt="Image Title" />
                </a>
                <div class="postcard__text t-dark">
                  <h1 class="postcard__title blue">
                    <a href="#"> บัลโคนี่คิส (Balcony Kiss) </a>
                  </h1>
                </div>
              </article>

              <article class="postcard light red">
                <a class="postcard__img_link" href="#">
                  <img class="postcard__img" src="./assets/img2/rec4.jpg" alt="Chapayom" />
                </a>
                <div class="postcard__text ">
                  <h1 class="postcard__title blue">
                    <a href="#"> ชาพะยอม (Chapayom) </a>
                  </h1>
                </div>
              </article>

              <article class="postcard light green">
                <a class="postcard__img_link" href="#">
                  <img class="postcard__img" src="./assets/img2/rec5.jpg" alt="Mirun" />
                </a>
                <div class="postcard__text t-dark">
                  <h1 class="postcard__title blue">
                    <a href="#"> มิรัน (Mirun) </a>
                  </h1>
                </div>
              </article>

              <article class="postcard dark green">
                <a class="postcard__img_link" href="#">
                  <img class="postcard__img" src="./assets/img2/rec6.jpg" alt="Farm Sweet" />
                </a>
                <div class="postcard__text ">
                  <h1 class="postcard__title blue">
                    <a href="#" style="color:white;"> ฟาร์มสวีท (Farm Sweet) </a>
                  </h1>
                </div>
              </article>



            </div>
          </section>
        `,
        showCloseButton: true,
        width: '100%'
      })
    })
  </script>
    
</body>
</html>