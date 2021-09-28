<?php
// connect to database
$host = "localhost";
$password = "";
$user = "root";
$dbname = "trainingcompany";

$conn = mysqli_connect($host, $user, $password, $dbname);
// if($conn){
//     echo "<h1>Database connected</h1>";
// }else{
//     echo "<h1>Database not connected</h1>";
// }
// ======== creat / insert ========
if(isset($_POST['Send'])){
$course = $_POST['Course'];
$cost = $_POST['Cost'];

$insert = "INSERT INTO `courses` VALUES (null , '$course', $cost) ";
$i = mysqli_query($conn , $insert);
if($i){
    echo "<h1>insert true</h1>";
}else{
    echo "<h1>insert false</h1>";
}
}

// ======== read / select ========
$select = "SELECT * FROM `courses`";
$s = mysqli_query($conn , $select);

// ======== delete ========
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = "DELETE from `courses` where id=$id ";
    mysqli_query($conn , $delete);
    if($delete){
        echo "<h1>delete true</h1>";
    }else{
        echo "<h1>delete false</h1>";
    }
    header("Location:http://localhost/start/index.php");

}
// ======== Edit/update الشرح عند الدقيقة 1:15========
$NAME = '';
$cost = '';
$update = false;
if(isset($_GET['edit'])){
    $update = true;
    $id = $_GET['edit'];
    $select = "SELECT * from `courses` where id = $id"; 
    $ss = mysqli_query($conn , $select);
    $row = mysqli_fetch_assoc($ss);
    $NAME = $row['NAME'];
    $cost = $row['cost'];
    if(isset($_POST['update'])){
        $course = $_POST['Course'];
        $cost = $_POST['Cost']; 
        $update = "UPDATE  `courses` SET NAME = '$course' , cost='$cost' where id = $id " ;
        $u = mysqli_query($conn , $update);
        if($u){
            echo "<h1>update true</h1>";
        }else{
            echo "<h1>update false</h1>";
        }
    header("Location:http://localhost/start/index.php");

    }
    
}





?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        body{
            background-color: #111;

        }
        .card{
            background-color: #333;
            color: white;
        }
        label{
            color: white;
        }
    </style>
</head>
<body>
    
<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <h2 class="text-info text-center">CRUD operations</h2>
            <form method="POST">
                <div class="form-groub">
                    <label> Name </label>
                    <input name="Course" type="text" placeholder="Course Name" value="<?php echo $NAME ?>" class="form-control">
                </div>
                <div class="form-groub">
                    <label> Cost </label>
                    <input name="Cost" type="text" placeholder="Course Cost" value="<?php echo $cost ?>" class="form-control">
                </div>
                <div class="mx-auto w-50">
                <?php if($update): ?>
                <button name="update" class="btn btn-primary mx-auto my-3 w-100">update data</button>
                <?php else : ?>
                <button name="Send" class="btn btn-info mx-auto my-3 w-100">Send data</button>
                <?php endif; ?>



                </div>
            </form>
        </div>
    </div>
</div>
<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Course</th>
                    <th>Cost</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($s as $data) { ?>
                    <tr>
                    <td><?php echo $data['id'] ?></td>
                    <td><?php echo $data['NAME'] ?></td>
                    <td><?php echo $data['cost'] ?></td>
                    <td><a href="index.php?delete=<?php echo $data['id'] ?>" class="btn btn-danger mx-2">Delete</a>
                    <a href="index.php?edit=<?php echo $data['id'] ?>" class="btn btn-info mx-2">Edit</a></td>
                    </tr>
                
                <?php } ?>
            </table>
        </div>
    </div>
</div>



</body>
</html>