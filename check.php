<?php
    session_start();
    if(array_key_exists("answer",$_POST))
    {
        include("connection.php");
        $queid=$_POST['qid'];
        $_SESSION['answered'][$queid]=$_POST['answer'];
        if($_SESSION['answered'][$queid+1]=="")
        {
            $_SESSION['answered'][$queid+1]="**";
        }
        $query1="SELECT * FROM question ORDER BY id DESC LIMIT 1";
        $result1=mysqli_query($link,$query1);
        $r1=mysqli_fetch_array($result1);
        $query="select * from question where id=".mysqli_real_escape_string($link,$_POST['qid'])."";
        $result=mysqli_query($link,$query);
        $r=mysqli_fetch_array($result);
        if($_SESSION['questionid']<$r1['id'])
        {
            $_SESSION['questionid']++;
        }
        if($r['correctopt']==$_POST['answer'])
        {
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
                    if($str[$i]==$_POST['qid'])
                    {
                        $k++;
                    }
                }
            }
            if($k==0)
            {
                if($r['que']=="")
                {
                    $query="update users set que=".$_POST['qid']." where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
                    mysqli_query($link,$query);
                }
                else
                {
                    $query="select * from users where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
                    $result=mysqli_query($link,$query);
                    $r=mysqli_fetch_array($result);
                    $queid=$r['que']." ".$_POST['qid'];
                    $query="update users set que='$queid' where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
                    mysqli_query($link,$query);
                }
                $query="update users set marks=marks+1 where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
                mysqli_query($link,$query);
            }
            /*$query2="select * from users where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
            $result2=mysqli_query($link,$query2);
            $r2=mysqli_fetch_array($result2);
            if($r2['answered']=="")
            {
                $q=$_POST['qid']."=".$_POST['answer'];
                $query="update users set answered='$q' where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
                mysqli_query($link,$query);
            }
            else
            {
                $q=$r2['answered']." ".$_POST['qid']."=".$_POST['answer'];
                $query="update users set answered='$q' where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
                mysqli_query($link,$query);
            }*/
        }
        else
        {
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
                    if($str[$i]==$_POST['qid'])
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
                $search = $_POST['qid'] ;
                $trimmed = str_replace($search, '', $subject) ;
                $query="update users set marks=marks-1,que='$trimmed' where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
                mysqli_query($link,$query);
            }
            /*$query2="select * from users where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
            $result2=mysqli_query($link,$query2);
            $r2=mysqli_fetch_array($result2);
            if($r2['answered']=="")
            {
                $q=$_POST['qid']."=".$_POST['answer'];
                $query="update users set answered='$q' where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
                mysqli_query($link,$query);
            }
            else
            {
                $q=$r2['answered']." ".$_POST['qid']."=".$_POST['answer'];
                $query="update users set answered='$q' where id=".mysqli_real_escape_string($link,$_SESSION['id'])."";
                mysqli_query($link,$query);
            }*/
        }
        

    }
?>