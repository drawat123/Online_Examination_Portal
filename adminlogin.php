<?php
    session_start();
    include("connection.php");
    if(array_key_exists("adminid",$_SESSION))
    {
        
    }
    else
    {
        header("location:index.php");
    }
?>
<html>

<head>
    <title>Admin</title>
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
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td,th {
            border: 2px solid black;
            text-align: left;
            padding: 8px;
        }
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        .close1 {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close1:hover,
        .close1:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1 style="margin-left:40%;">Admin Panel</h1>
    <div style="margin-top:5%;">
        <table>
            <?php
                $query="select * from question";
                $i=0;
                $result=mysqli_query($link,$query);
                echo "<tr>";
                while($row=mysqli_fetch_field($result))
                {
                    echo "<th>$row->name</th>";
                }
                echo "<th colspan='2'>Action</th>";
                echo "</tr>";
                while($row=mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    $query1="select * from question";
                    $result1=mysqli_query($link,$query1);            
                    while($r=mysqli_fetch_field($result1))
                    {
                        echo "<td>".$row[$r->name]."</td>";
                    }
                    $i++;
                    echo "<td><input id='".$row['id']."' value='Edit' type='button' class='edit btn btn-outline-danger'></td>";
                    echo "<td><a href='delete.php?id=".$row['id']."' class='delete btn btn-outline-danger'>Delete</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <input type="button" value="ADD" id="add" class="btn btn-outline-danger" style="margin-top:1%;">
    </div>
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="post" id="signupform" action="add.php">
                <div class="form-group">
                    <label for="question">Question</label>
                    <input type="text" name="question" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="opt1">Option 1</label>
                    <input class="form-control" type="text" name="opt1" required>
                </div>
                <div class="form-group">
                    <label for="opt2">Option 2</label>
                    <input class="form-control" type="text" name="opt2" required>
                </div>
                <div class="form-group">
                    <label for="opt3">Option 3</label>
                    <input class="form-control" type="text" name="opt3" required>
                </div>
                <div class="form-group">
                    <label for="opt4">Option 4</label>
                    <input class="form-control" type="text" name="opt4" required>
                </div>
                <div class="form-group">
                    <label for="correctopt">Correct Option</label>
                    <input class="form-control" type="text" name="correctopt" required>
                </div>
                <input type="hidden" name="signup" value="0">
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-success" id="submit" value="Add">
                </div>
            </form>
        </div>      
    </div>
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close1">&times;</span>
            <form method="post" id="editform" action="update.php">
                <div class="form-group">
                    <label for="question">Question</label>
                    <input type="text" id="question" name="question" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="opt1">Option 1</label>
                    <input id="opt1" class="form-control" type="text" name="opt1" required>
                </div>
                <div class="form-group">
                    <label for="opt2">Option 2</label>
                    <input id="opt2" class="form-control" type="text" name="opt2" required>
                </div>
                <div class="form-group">
                    <label for="opt3">Option 3</label>
                    <input id="opt3" class="form-control" type="text" name="opt3" required>
                </div>
                <div class="form-group">
                    <label for="opt4">Option 4</label>
                    <input id="opt4" class="form-control" type="text" name="opt4" required>
                </div>
                <div class="form-group">
                    <label for="correctopt">Correct Option</label>
                    <input id="correctopt" class="form-control" type="text" name="correctopt" required>
                </div>
                <input type="hidden" name="qid" id="qid">
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-success" id="submit1" value="Edit">
                </div>
            </form>
        </div>      
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $("#signupform").submit(function() {
            if (confirm("Please confirm if everything is correct"))
            {
                document.getElementById("#signupform").submit();
            }
            else
            {
                return false;
            }
        });
        $("#editform").submit(function() {
            if (confirm("Please confirm if everything is correct"))
            {
                document.getElementById("#editform").submit();
            }
            else
            {
                return false;
            }
        });
        $(".delete").click(function(){
            if (!confirm("Are you sure you want to delete this question?"))
            {
                return false;
            }
        });
        document.getElementById("add").onclick=function()
        {
            
            // Get the modal
            var modal = document.getElementById("addModal");

            // Get the button that opens the modal
            var btn = document.getElementById("add");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal 
                modal.style.display = "block";

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
        $(".edit").click(function() {
            var id = $(this).attr('id');
            var str="";
            // Get the modal
            //var name = $(id).attr("name");
            $.ajax({
                type:"POST",
                url:"edit.php",
                data:{action: id},
                success:function(data){
                    str=data;
                    var res = str.split(",");
                    $("#question").val(res[0]);
                    $("#opt1").val(res[1]);
                    $("#opt2").val(res[2]);
                    $("#opt3").val(res[3]);
                    $("#opt4").val(res[4]);
                    $("#correctopt").val(res[5]);
                    $("#qid").val(res[6]);
                }
            });
            
            var modal = document.getElementById('editModal');

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close1")[0];

            // When the user clicks the button, open the modal 
                modal.style.display = "block";

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>
    <a href="index.php?logout=1" class="btn btn-outline-danger" style="position: fixed;bottom: 0px;left: 0px;">Log Out</a>
</body>

</html>