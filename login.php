

<?php
session_start();

if(isset($_SESSION['auth'])){
    $_SESSION['message']="You are already Logged in";
    header('Location: ./user/user_homepage.php');
    exit();
}

@include 'config/db1.php';

// session_start();

// if(isset($_POST['submit'])){

//    $name = mysqli_real_escape_string($conn, $_POST['name']);
//    $email = mysqli_real_escape_string($conn, $_POST['email']);
//    $pass = md5($_POST['password']);
//    $cpass = md5($_POST['cpassword']);
//    $user_type = $_POST['user_type'];

//    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

//    $result = mysqli_query($conn, $select);

//    if(mysqli_num_rows($result) > 0){

//       $row = mysqli_fetch_array($result);

//       if($row['user_type'] == 'admin'){

//          $_SESSION['admin_name'] = $row['name'];
//          header('location:admin_page.php');

//       }elseif($row['user_type'] == 'user'){

//          $_SESSION['user_name'] = $row['name'];
//          header('location:user_page.php');

//       }
     
//    }else{
//       $error[] = 'incorrect email or password!';
//    }

// };



//update 


if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if it's not already started
}

if (isset($_POST['submit'])) {
    $query = new Query(); // Initialize the Query class

    // $email = mysqli_real_escape_string($query->connect(), $_POST['email']);



    $email = $_POST['email'];
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";


    // $select = $obj->getdatabyId('users', $data, 'id', $id);


    $result = $query->getDataByCustomQuerys($select);

    // if (mysqli_num_rows($result) > 0) {
    //     $row = mysqli_fetch_array($result);



    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['auth'] =true;

        if ($row['usertype'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];      
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['usertype']=$row['usertype'];
            header('Location: ./admin');
        } elseif ($row['usertype'] == 'user') {

            $_SESSION['username'] = $row['name'];
            $_SESSION['useremail'] = $row['email'];
            $_SESSION['usertype']=$row['usertype'];
            echo $_SESSION['usertype'];
            header('Location: ./user/user_homepage.php');
        }
    } else {
        $error[] = 'Incorrect email or password!';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="index.php">register now</a></p>
   </form>

</div>

</body>
</html>