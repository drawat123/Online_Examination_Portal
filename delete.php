<?php
    session_start();
    include("connection.php");
    if(array_key_exists("adminid",$_SESSION) && array_key_exists("id",$_GET))
    {
        $query="DELETE FROM question WHERE id='".$_GET['id']."'";
        mysqli_query($link,$query);
    }
    header("location:adminlogin.php");
?>