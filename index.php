<?php
    session_start();
    $success="";
    $_SESSION['questionid']=1;
    $_SESSION['answered']=array();
    $_SESSION['answered'][1]="**";
    include("connection.php");
    $q="SELECT * FROM question";
    $re=mysqli_query($link,$q);
    $r4=mysqli_num_rows($re);
    for($i=1;$i<=$r4;$i++)
    {
        $_SESSION['answered'][$i]="**";
    }
    if(array_key_exists("logout",$_GET))
    {
        session_destroy();
    }
    if(array_key_exists("id",$_SESSION))
    {
        header("location:login.php");
    }
    if(mysqli_connect_error())
    {
        die("Database Connection Error");
    }
    else
    {
        if(isset($_POST['submit']))
        {
            if($_POST['signup']==0)
            {
                $query="select * from users where email='".$_POST['email']."'";
                if(mysqli_query($link,$query))
                {
                    $result=mysqli_query($link,$query);
                    if(mysqli_num_rows($result)>0)
                    {
                        $success="Account already exist";
                    }
                    else
                    {
                        $query="insert into users(email,password,marks) values('".$_POST['email']."','".$_POST['password']."',0)";
                        mysqli_query($link,$query);
                        $success="Account Created";
                    }
                }
                else
                {
                    echo "Error";
                }
            }
            else if($_POST['signup']==1)
            {
                $query="select * from users where email='".$_POST['email']."'";
                if(mysqli_query($link,$query))
                {
                    $result=mysqli_query($link,$query);
                    if(mysqli_num_rows($result)>0)
                    {
                        $row=mysqli_fetch_array($result);
                        if($_POST['password']==$row['password'])
                        {
                            $_SESSION['id']=$row['id'];
                            header("location:login.php");
                        }
                        else
                        {
                            $success="Email/Password combination cannot be found";
                        }
                    }
                    else
                    {
                        $success="Email/Password combination cannot be found";
                    }
                }
                else
                {
                    echo "Error";
                }
            }
            else if($_POST['signup']==2)
            {
                $query="select * from admin where name='".$_POST['email']."'";
                if(mysqli_query($link,$query))
                {
                    $result=mysqli_query($link,$query);
                    if(mysqli_num_rows($result)>0)
                    {
                        $row=mysqli_fetch_array($result);
                        if($_POST['password']==$row['password'])
                        {
                            $_SESSION['adminid']=$row['id'];
                            header("location:adminlogin.php");
                        }
                        else
                        {
                            $success="Name/Password combination cannot be found";
                        }
                    }
                    else
                    {
                        $success="Name/Password combination cannot be found";
                    }
                }
                else
                {
                    echo "Error";
                }
            }
        }
    }
?>
<html>

<head>
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    <style>
        #loginform
        {
            display: none;
        }
        #adminform
        {
            display: none;
        }
        .container{
            width:40%;
            margin-top:10%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div>
            <?php if($success!=""){echo "<div class='alert alert-danger' role='alert'>".$success."</div>";} ?>
        </div>
        <form method="post" id="signupform">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="option">Password</label>
                <input class="form-control" type="password" name="password" required>
            </div>
            <input type="hidden" name="signup" value="0">
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-success" id="submit" value="Sign Up">
                <a class="btn btn-outline-success toggleform" style="margin-left:102px;margin-right:102px;">User Login</a>
                <a class="btn btn-outline-success toggleform1">Admin Login</a>
            </div>
        </form>
        <form method="post" id="loginform">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="option">Password</label>
                <input class="form-control" type="password" name="password" required>
            </div>
            <input type="hidden" name="signup" value="1">
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-success" id="submit" value="Login">
                <a class="btn btn-outline-success toggleform2" style="margin-left:121px;margin-right:121px;">Sign Up</a>
                <a class="btn btn-outline-success toggleform1">Admin Login</a>
            </div>
        </form>
        <form method="post" id="adminform">
            <div class="form-group">
                <label for="email">Username</label>
                <input type="text" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="option">Password</label>
                <input class="form-control" type="password" name="password" required>
            </div>
            <input type="hidden" name="signup" value="2">
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-success" id="submit" value="Login">
                <a class="btn btn-outline-success toggleform" style="margin-left:130px;margin-right:125px;">User Login</a>
                <a class="btn btn-outline-success toggleform2">Sign Up</a>
            </div>
        </form>
    </div>
    </div>
    <script type="text/javascript" src="particles.js"></script>
    <script type="text/javascript" src="app.js"></script>
    <script>
        $(".toggleform").click(function(){
            $('#signupform').hide();
            $('#loginform').show();
            $('#adminform').hide();
        })
        $(".toggleform1").click(function(){
            $('#signupform').hide();
            $('#loginform').hide();
            $('#adminform').show();
        })
        $(".toggleform2").click(function(){
            $('#signupform').show();
            $('#loginform').hide();
            $('#adminform').hide();
        })
    </script>
</body>
</html>