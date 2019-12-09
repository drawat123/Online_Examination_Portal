<?php
    session_start();
    if(array_key_exists("id",$_SESSION))
    {
        include("connection.php");
        $query="select * from users where id='".$_SESSION['id']."'";
        $result=mysqli_query($link,$query);
        $r=mysqli_fetch_array($result);
        $marks=0;
        if($r['Q1']==$r['Q1C'])
        {
            $marks++;
        }
        if($r['Q2']==$r['Q2C'])
        {
            $marks++;
        }
        if($r['Q3']==$r['Q3C'])
        {
            $marks++;
        }
        echo "<div class='alert alert-success' role='alert'><h1>Your Marks Are : ".
        $marks." out of 3</h1></div>";
        session_destroy();
    }
    else
    {
        header("location:index.php");
    }
?>
<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">
        <style>
            html
            { 
                background: url(img.jpg) no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            body{
                background:none;
            }
            </style>
</head>
    </html>