<?php
    session_start();
    $_SESSION['questionid']=$_POST['answer1'];
    $t=$_POST['answer'];
    $_SESSION['answered'][$t]="**";
    include("connection.php");
    $query="select * from users where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
    $result=mysqli_query($link,$query);
    $r=mysqli_fetch_array($result);
    $str1=$r['que'];
    $str=explode(" ",$str1);
    $k=0;
    if($r['que']!="")
    {
        for($i=0;$i<count($str);$i++)
        {
            if($str[$i]==$_POST['answer'])
            {
                $k++;
            }
        }
    }
    if($k!=0)
    {
        $query="select * from users where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
        $result=mysqli_query($link,$query);
        $r=mysqli_fetch_array($result);
        $subject = $r['que'] ;
        $search = $_POST['answer'] ;
        $trimmed = str_replace($search, '', $subject) ;
        $query="update users set marks=marks-1,que='$trimmed' where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
        mysqli_query($link,$query);
    }
?>