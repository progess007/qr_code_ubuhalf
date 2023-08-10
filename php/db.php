<?php

$serverName = 'sql209.epizy.com';
$user = 'epiz_32357604';
$password = '6Ssz1g6Ht45';
$dbName = 'epiz_32357604_qrcode';

$conn = mysqli_connect($serverName, $user, $password, $dbName);

if(!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}

// $serverName = 'sql209.epizy.com';
// $user = 'epiz_32357604';
// $password = '6Ssz1g6Ht45';
// $dbName = 'epiz_32357604_qrcode';

mysqli_set_charset($conn, 'utf8');

?>