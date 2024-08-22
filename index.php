<?php

include 'config/db1.php';
$query = new Query();
// $conn = $query->connect();


// if(isset($_POST['submit'])){

//    $name = mysqli_real_escape_string($conn, $_POST['name']);
//    $email = mysqli_real_escape_string($conn, $_POST['email']);
//    $number = mysqli_real_escape_string($conn, $_POST['number']);
// $name = mysqli_real_escape_string($query->connect(), $_POST['name']);
// $email = mysqli_real_escape_string($query->connect(), $_POST['email']);
// $number = mysqli_real_escape_string($query->connect(), $_POST['number']);






// $name = mysqli_real_escape_string($conn, $_POST['name']);
// $email = mysqli_real_escape_string($conn, $_POST['email']);
// $number = mysqli_real_escape_string($conn, $_POST['number']);
//    $pass = md5($_POST['password']);
//    $cpass = md5($_POST['cpassword']);
//    $user_type = $_POST['user_type'];

//    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";



//    $result = mysqli_query($conn, $select);
// $result = $query->connect()->query($select);





// $result = $conn->query($select);

//    if(mysqli_num_rows($result) > 0){

//       $error[] = 'user already exist!';

//    }else{

//       if($pass != $cpass){
//          $error[] = 'password not matched!';
//       }else{
//          $insert = "INSERT INTO user_form(name, email,number, password, usertype) VALUES('$name','$email','number','$pass','$user_type')";


        //  mysqli_query($conn, $insert);
        // $query->connect()->query($insert);



//         $conn->query($insert);
//          header('location:login.php');
//       }
//    }

// };



//update
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    // Check if the user already exists
    $selectQuery = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
    $result = $query->getDataByCustomQuery($selectQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        if ($pass != $cpass) {
            $error[] = 'Passwords do not match!';
        } else {
            $insertQuery = "INSERT INTO users (name, email, number, password, usertype) VALUES ('$name', '$email', '$number', '$pass', '$user_type')";
            if ($query->executeQuery($insertQuery)) {
                header('location:login.php');
                exit;
            } else {
                $error[] = 'Registration failed!';
            }
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="number" name="number" required placeholder="enter your number">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select name="user_type">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>