<?php 
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "laundry";
    $connect= new mysqli($hostname,$username,$password,$database);
    if ($connect -> connect_error){
        die ('maaf koneksi gagal : '. $connect->connect_error);
    }

?>