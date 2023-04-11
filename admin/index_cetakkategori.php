<?php

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Laporan PDF Plus Filter Periode Tanggal</title>

    <!-- Include file CSS Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Include library Bootstrap Datepicker -->
    <link href="libraries/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- Include File jQuery -->
    <script src="js/jquery.min.js"></script>
</head>

<body>
    <div style="padding: 15px;">
        <h3 style="margin-top: 0;"><b>Laporan Kategori</b></h3>
        <hr />


        <div style="margin-top: 5px;">
            <a href="printkategori.php">CETAK PDF</a>
        </div>
        <br>

    </div>

</body>

</html>

<?php
include "footer_admin.php";
?>