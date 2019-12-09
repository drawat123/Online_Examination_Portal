<?php
    session_start();
    if(array_key_exists("id",$_SESSION))
    {
        include("connection.php");
        $query1="SELECT * FROM question ORDER BY id DESC LIMIT 1";
        $result1=mysqli_query($link,$query1);
        $r2=mysqli_fetch_array($result1);
        $_SESSION['lastquestion']=$r2['id'];
        $query="select * from question where id=".$_SESSION['questionid']."";
        $result=mysqli_query($link,$query);
        $r=mysqli_fetch_array($result);
    }
    else
    {
        header("location:index.php");
    }
?>
<html>
    <head>
        <title>USER</title>
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
            *{
                margin: 0 ;
                padding: 0;
            }
            body{
                background:none;
            }
            .container{
                width:40%;
                margin-top:10%;
            }
            #top{
                height: 50px;
                width: 100%;
                background-color:darkslategrey;
            }
            #paraone{
                padding-top: 10px;
                padding-left: 550px;
                font-family: 'Times New Roman', Times, serif;
                font-size: 30px;
            }
            #second_1{
                float:right;
                height:92%;
                width: 22%;
                background-color: rgba(122, 189, 182, 0.397);
            }
            #P{
                margin-top:40px;
                margin-left:20px;
            }
            #paratwo{
                
                font-size: 25px;
                padding-left: 40px;
                border: 5px solid ;
                background-color: aliceblue;
            }
            #end{
                position:fixed;
                bottom:0px;
            }
        </style>
    </head>
    <body>
        <div id="top">
            <p id="paraone" style="color:white">ONLINE TEST PORTAL</p>
        </div>
        <div id="second_1">
            <p id="paratwo">Timer:<span id="demo"></span></p>
            <?php
                $query="select * from question";
                $result=mysqli_query($link,$query);
                while($r1=mysqli_fetch_array($result))
                {
                    echo "<input id=".$r1['id']." type='button' class='qbtn btn btn-outline-success' value=".$r1['id']." style='margin-left:5px;'>";
                }
            ?>
            <!-- <p>Description:<br>
                If button is like =><button class="class=btn btn-outline-success">Question No.</button><br>
                If button is like =><button class="class=btn btn-success">Question No.</button><br>
                If button is like =><button class="class=btn btn-danger">Question No.</button><br>
            </p> -->
        </div>
        <div id="P">
            <div id="Q">
                <h1><input type="hidden" id="qno" value="<?php echo $r['id']?>"><?php echo $r['id'];echo ". ".$r['question']; ?></h1>
                <p class="lead"><?php echo $r['opt1'] ?> <input class="i1" type="radio" name="option" value="<?php echo $r['opt1']?>" <?php $queid=$r['id'];if($_SESSION['answered'][$queid]==$r['opt1']){echo "checked";} ?>></p>
                <p class="lead"><?php echo $r['opt2'] ?> <input class="i2" type="radio" name="option" value="<?php echo $r['opt2']?>" <?php $queid=$r['id'];if($_SESSION['answered'][$queid]==$r['opt2']){echo "checked";} ?>></p>
                <p class="lead"><?php echo $r['opt3'] ?> <input class="i3" type="radio" name="option" value="<?php echo $r['opt3']?>" <?php $queid=$r['id'];if($_SESSION['answered'][$queid]==$r['opt3']){echo "checked";} ?>></p>
                <p class="lead"><?php echo $r['opt4'] ?> <input class="i4" type="radio" name="option" value="<?php echo $r['opt4']?>" <?php $queid=$r['id'];if($_SESSION['answered'][$queid]==$r['opt4']){echo "checked";} ?>></p>
            </div>
            <button value="previous" id="previous" class="btn btn-outline-success">Previous</button>
            <button value="next" id="next" class="btn btn-outline-success">Next</button>
            <button value="skip" id="skip" class="btn btn-outline-danger">Skip</button>
        </div>
        <button id="end" class="btn btn-danger">End Test</button>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            if (performance.navigation.type == 1)
            {
                var d=sessionStorage.getItem("date");
            }
            else
            {
                sessionStorage.setItem("date", new Date());
                var d = Date.parse(sessionStorage.getItem("date"));
                d=d+3600000;
                sessionStorage.setItem("date",d);
            }
            var countdown=d;
            var x = setInterval(function() {
                var current = new Date().getTime(); 
                var distance = countdown - current;
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById("demo").innerHTML = hours + "h "
                + minutes + "m " + seconds + "s ";
                if (distance < 0) {
                    clearInterval(x);
                    alert("Your time is over");
                    window.location.href = "end.php?logout=1";
                }
            }, 1000);
            $(".qbtn").click(function(){
                var id = this.id;
                $.ajax({
                    method : "POST",
                    url: "gotoque.php",
                    data: { answer: id},
                });
                $("#Q").load(" #Q");
            });
            $("#skip").click(function(){
                var a1= $("#qno").val();
                var a=parseInt(a1);
                var d="#"+$("#qno").val();
                $(d).removeClass("btn-outline-success");
                $(d).removeClass("btn-success");
                $(d).addClass("btn-danger");
                var e1="<?php echo $_SESSION['lastquestion'] ?>";
                var e=parseInt(e1);
                for(i=a+1;i<=e;i++)
                {
                    var c="#"+i;
                    if($(c).hasClass( "btn-outline-success" ))
                    {
                        $.ajax({
                        method : "POST",
                        url: "goto.php",
                        data: { answer: a1,answer1: i},
                        })
                        break;
                    }
                    
                }
                if(a1==e)
                {
                    var c="#"+i;
                    $.ajax({
                    method : "POST",
                    url: "goto.php",
                    data: { answer: a1,answer1: a1},
                    })
                }
                $("#Q").load(" #Q");
            });
            $("#next").click(function(){
                $.ajax({
                method : "POST",
                url: "check.php",
                data: { answer: $('input[type="radio"]:checked').val(), qid: $('#qno').val()},
                })
                $("#Q").load(" #Q");
                var a="#"+$("#qno").val();
                if($('input[type="radio"]:checked').val()!=undefined)
                {
                    $(a).removeClass("btn-outline-success");
                    $(a).removeClass("btn-danger");
                    $(a).addClass("btn-success");
                }
                var a1=$("#qno").val();
                var a2="<?php echo $_SESSION['lastquestion']; ?>"
                if(a1==a2)
                {
                    c="If your test is over you can click on End Test";
                    alert(c);
                }
            });
            $("#previous").click(function(){
                $.get( "pre.php", function( data ) {
                    $("#Q").load(" #Q");
                });
            });
            $("#end").click(function(){
                if (!confirm("Click OK if you want to end this test."))
                {
                    return false;
                }
                else
                {
                    window.location="end.php?logout=1";
                }
            });
        </script>
    </body>
</html>