<?php
    include("connection.php");
    if(isset($_POST["action"]))
    {
        $action=$_POST["action"];
        $query="select * from question where id='$action'";
        $result=mysqli_query($link,$query);
        $row=mysqli_fetch_array($result);
        echo $row['question'].",".$row['opt1'].",".$row['opt2'].",".$row['opt3'].",".$row['opt4'].",".$row['correctopt'].",".$row['id'];
    }
?>