<?php
    session_start();
    if(array_key_exists("logout",$_GET) && array_key_exists("id",$_SESSION))
    {
        include("connection.php");
        $query="select * from users where id='".$_SESSION['id']."'";
        $result=mysqli_query($link,$query);
        $r=mysqli_fetch_array($result);
        echo "<h1>Your Marks are ".$r['marks']."</h1>";
        session_destroy();
    }
    else
    {
        header("location:index.php");
    }
?>