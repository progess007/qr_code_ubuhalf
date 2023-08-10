<?php

require_once('./db.php');
require_once('../sheetdb/autoload.php');
use SheetDB\SheetDB;

    if(isset($_POST['store_iden'])) {

        if(!isset($_POST['faculty'])) {
            $faculty = "";
        }

        $m_id_iden = $_POST['m_id'];
        $name = $_POST['name'];
        $store_name = $_POST['st_name'];
        $faculty = $_POST['faculty'];
        $status = $_POST['status'];
        $strDate2 = $_POST['strDate2'];
        $discount = $_POST['discount'];

        $sheetdb = new SheetDB('l2hdtj999ok6p');
        $response = $sheetdb->get(); // returns all spreadsheets data
        $response = $sheetdb->keys(); // returns all spreadsheets key names
        $response = $sheetdb->name(); // returns name of a spreadsheet document

        date_default_timezone_set('Asia/Bangkok');
        $date = date('ymdHis');
        

        $iden_query = "SELECT * FROM qr_path WHERE member_id=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $iden_query);
        mysqli_stmt_bind_param($stmt, 'i', $m_id_iden);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($res)) {
            $cal = $row['qr_count'] - $discount; 

            $update_qr = "UPDATE qr_path 
                          SET qr_count=?
                          WHERE member_id=?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $update_qr);
            mysqli_stmt_bind_param($stmt, 'ii', $cal, $m_id_iden);
            if(mysqli_stmt_execute($stmt)) {

                $insert_his = "INSERT INTO qr_history(
                                                      qr_store_name,
                                                      qr_m_id,
                                                      qr_date
                                                     )
                                            VALUES(?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $insert_his);
                mysqli_stmt_bind_param($stmt, 'sis', $store_name, $m_id_iden, $date );
                if(mysqli_stmt_execute($stmt)) {

                    $sheetdb->create([
                        'ชื่อร้าน'=> $store_name,
                        'ชื่อผู้ใช้สิทธิ์'=> $name, 
                        'คณะ' => $faculty,
                        'ประเภท' => $status,
                        'วันที่ใช้' => $strDate2
                    ]);
                    echo "Update Success";

                } // mysql_execute
                
                
            } // mysqli_execute

            
        } //fetch assoc
        

    }



?>