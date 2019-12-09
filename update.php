<?php
    session_start();
    include("connection.php");
    if(array_key_exists("adminid",$_SESSION))
    {
        $query="UPDATE question SET question='".$_POST['question']."',opt1='".$_POST['opt1']."',opt2='".$_POST['opt2']."',opt3='".$_POST['opt3']."',opt4='".$_POST['opt4']."',correctopt='".$_POST['correctopt']."' WHERE id='".$_POST['qid']."'";
        mysqli_query($link,$query);
    }
    header("location:adminlogin.php");
?>