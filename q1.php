<?php
session_start();
    if(array_key_exists("content",$_POST)){
        include("connection.php");
        $query="select * from users where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
        $query="update users set Q1C='".mysqli_real_escape_string($link,$_POST['content'])."' where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
        mysqli_query($link,$query);
        echo $_SESSION['id'];
    }
?>