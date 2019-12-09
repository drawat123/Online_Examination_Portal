<?php
    session_start();
    include("connection.php");
    if(array_key_exists("adminid",$_SESSION))
    {
        $query1="SELECT * FROM question ORDER BY id DESC LIMIT 1";
        $result1=mysqli_query($link,$query1);
        $r1=mysqli_fetch_array($result1);
        $r2=$r1['id']+1;
        $query="insert into question(id,question,opt1,opt2,opt3,opt4,correctopt) values('$r2','".$_POST['question']."','".$_POST['opt1']."','".$_POST['opt2']."','".$_POST['opt3']."','".$_POST['opt4']."','".$_POST['correctopt']."')";
        mysqli_query($link,$query);
    }
    header("location:adminlogin.php");
?>