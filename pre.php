<?php
    session_start();
    if($_SESSION['questionid']!=1)
    {
       
        $_SESSION['questionid']--;
        $queid=$_SESSION['questionid'];
        echo $_SESSION['answered'][$queid];
    }
?>