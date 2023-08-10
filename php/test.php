<?php

include './db.php';
include "../phpqrcode/qrlib.php";

    if(isset($_POST['e_check'])) {

        $email = $_POST['email'];

        $sql = "SELECT * FROM mauth WHERE m_email=?";
        $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

        $res = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            echo $row['m_email'];
        } else {
            echo "Email is not Use";
        }
    }

if (isset($_POST['insert'])){

   $email = $_POST['email'];
   $pwd = $_POST['pwd'];
   $pwdC = $_POST['pwdC'];
   $stId  = $_POST['stId'];
   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $img = "./assets/img2/df-user.png";
   $faculty = $_POST['faculty'];
   $token_status = 0;
   $m_status = $_POST['status'];

  //echo "$email $pwd $pwdC $stId $fname $lname $img $faculty $m_status";

    // Datetime
    date_default_timezone_set('Asia/Bangkok');
    $date = date('ymdHis');

    if(empty($email) or empty($pwd) or empty($pwdC)) {
        echo "emp email,pwd,pwdC";
            exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "email format err";
            exit();
    }
    else if($pwd != $pwdC) {
        echo "pwd not match";
            exit();
    }
    else if(empty($fname) or empty($lname)) {
        echo "name err";
    }
    else {
        $sql = "SELECT m_email FROM mauth WHERE m_email=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo "sql err";
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resCheck = mysqli_stmt_num_rows($stmt);

            $memberCh = "SELECT * FROM mauth";
            $memque = mysqli_query($conn, $memberCh);
            $rowCh = mysqli_fetch_assoc($memque);

            if($resCheck > 0) {
                echo "email used";
                    exit();
            }
            else if (mysqli_num_rows($memque) >= 120) {
                echo "member full";
                    exit();
            }
            else {
                $sql2 = "INSERT INTO mauth(
                                            m_email,
                                            m_password,
                                            m_stId,
                                            m_fname,
                                            m_lname,
                                            m_img,
                                            m_faculty,
                                            m_token,
                                            m_token_status,
                                            m_cdate,
                                            m_udate,
                                            m_status
                                            )
                         VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql2)) {
                    echo "sql err2";
                        exit();
                }
                else {

                    // Email Send
                    $token_iden = "This is Token Identification ". $email;
                    $token_hash = password_hash($token_iden, PASSWORD_BCRYPT);

                    $recipient = $email;
                    $subject = "โครงการคนละครึ่ง คนละใบ คนละใจ ยืนยัน Email Address";
                    $body = "<a style=\" \"
                        href=\"https://ubuhalf.epizy.com/index?iden=$token_hash\">กดลิ้งค์นี้เพื่อทำการยืนยัน Email</a>
                        ";

                    $scriptUrl = "https://script.google.com/macros/s/AKfycbw7E6emcz8vCeoOqwFb4Yw0CW9rxTy9BJkxf4hGj7HkWtnbGc5-qJoLbFNKLhHrGl36/exec";

                    $data = array(
                    "recipient" => $recipient,
                    "subject" => $subject,
                    "body" => $body,
                    "isHTML" => 'true'
                    );

                    $ch = curl_init($scriptUrl);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    $result = curl_exec($ch);

                    // encrption Password
                    $encPass = password_hash($pwd, PASSWORD_BCRYPT);

                    mysqli_stmt_bind_param($stmt, 'ssssssssissi', $email, 
                                                                 $encPass,
                                                                 $stId,
                                                                 $fname,
                                                                 $lname, 
                                                                 $img, 
                                                                 $faculty, 
                                                                 $token_hash, 
                                                                 $token_status, 
                                                                 $date, 
                                                                 $date,
                                                                 $m_status);
                    if( mysqli_stmt_execute($stmt)) {
                        $PNG_TEMP_DIR = '../temp/';
                        $sql = "SELECT m_uid FROM mauth WHERE m_email='$email'";
                        $sql = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($sql);


                        //----> THiS IS QRCODE GENERATING

                        $m_uid = $row['m_uid'];

                        $filename = $PNG_TEMP_DIR.$m_uid.'.'.$date.'.png';

                        $qr_iden = "This is Identification ".$m_uid;
                        $qr_hash = password_hash($qr_iden, PASSWORD_BCRYPT);
                        $imageWidth = 250; //px

                        $link_iden = "https://ubuhalf.epizy.com/identification?iden=$qr_hash"; //Link to Discount
                        

                        QRcode::png($link_iden, $filename, $imageWidth);
                            $path = "temp/$m_uid.$date.png";
                            $count = 5;
                            $sql = "INSERT INTO qr_path(
                                                        qr_img_path,
                                                        qr_iden,
                                                        qr_count,
                                                        member_id
                                                    )VALUES(?, ?, ?, ?)";
                            $stmt = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmt, $sql);
                            mysqli_stmt_bind_param($stmt, 'ssii', $path, $qr_hash, $count, $m_uid);
                            mysqli_stmt_execute($stmt);
                            echo "success";
                    } //Gen QrCOde
                } // Insert member
            } //sql2 command
        } //check Email > 0
    }   
        
//    echo "$email $pwd $pwdC $fname $lname $phone ss";
   
}

?>