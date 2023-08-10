<?php
// UPDATE mauth SET m_token_status = 1 WHERE mauth.m_uid = 32;


session_start();
require_once('./db.php');

// =================== Iden Email Token

if(isset($_POST['identification'])) {
    $m_token = $_POST['iden'];
    
    $query_check = "SELECT m_uid,m_email,m_token,m_token_status FROM mauth WHERE m_token = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query_check);
    mysqli_stmt_bind_param($stmt, 's' , $m_token);
    if(mysqli_stmt_execute($stmt)) {
       $res = mysqli_stmt_get_result($stmt);
       $row = mysqli_fetch_assoc($res);

       $m_ch_status = $row['m_token_status'];
       $m_uid = $row['m_uid'];
       $iden_status = 1;

       if($m_ch_status == 0) {
         $query_iden = "UPDATE mauth SET m_token_status=? WHERE m_uid=?";
         $stmt = mysqli_stmt_init($conn);
         mysqli_stmt_prepare($stmt, $query_iden);
         mysqli_stmt_bind_param($stmt, 'ii', $iden_status, $m_uid);
         mysqli_stmt_execute($stmt);
         echo "iden success";
       }

       if($m_ch_status == 1) {
         echo "iden success2";
       }
    }
    mysqli_stmt_close($stmt);
}

// =================== Login to user

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    if(empty($email) or empty($pwd)) {
        echo "empty data";
        exit();
    }
    else {
        $sql = "SELECT * FROM mauth WHERE m_email = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($res) == 1) {
            $row = mysqli_fetch_assoc($res);
            $m_t_status = $row['m_token_status'];
            if($m_t_status == 0) {
                echo "Email not verify";
            }
            if($m_t_status == 1) {
                if(password_verify($pwd, $row['m_password'])) {
                    $_SESSION['id'] = $row['m_uid'];
                    echo "login success";
                }
                else {
                    echo "login err2";
                }
            }
        }
        else {
            echo "Login Error";
        }
    }
    mysqli_stmt_close($stmt);
}

// ====================================== Forgot Password

if(isset($_POST['forgot'])) {
    $f_email = $_POST['email'];
    
    $f_query = "SELECT * FROM mauth WHERE m_email = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $f_query);
    mysqli_stmt_bind_param($stmt, 's', $f_email);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $f_token = $row['m_token'];

                $recipient = $f_email;
                $subject = "โครงการคนละครึ่ง คนละใบ คนละใจ แก้ไขรหัสผ่าน(Forgot Password)";
                $body = "<a style=\" \"
                                href=\"https://ubuhalf.epizy.com/forgot?forgot=$f_token\">กดที่นี่เพื่อทำการแก้ไขรหัสผ่าน</a>
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
        mysqli_stmt_close($stmt);
        echo "f_success";

    } else {
        echo "no email";
    }
}

if(isset($_POST['f_iden'])) {
    $f_iden_token = $_POST['f_token'];
    $pwd = $_POST['pwd'];
    $pwd_re = $_POST['pwd_re'];

    if($pwd != $pwd_re) {
        echo "pwd not match";
    }

    if($pwd == $pwd_re) {
        $pwd_hash = password_hash($pwd, PASSWORD_BCRYPT);
        $f_set_pass = "UPDATE mauth SET m_password = ? WHERE m_token = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $f_set_pass);
        mysqli_stmt_bind_param($stmt, 'ss', $pwd_hash, $f_iden_token);
        if(mysqli_stmt_execute($stmt)) {
            echo "f_pass_success";
        }
        else {
            echo "error";
        }
    }
    mysqli_stmt_close($stmt);
}

// ====================================== Admin Login

if(isset($_POST['ad_login'])) {
    $ad_id = $_POST['admin_id'];
    $ad_pwd = $_POST['admin_pwd'];
}



// ====================================== Logout
if(isset($_POST['logout'])) {
    unset($_SESSION['id']);
    session_destroy();
    echo "logout success";
}




?>