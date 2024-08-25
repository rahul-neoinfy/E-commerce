<?php
include('../functions/myfunction.php');
if(isset($_SESSION['auth'])){

      if($_SESSION['usertype']== 'user'){
        redirect("../user/user_homepage.php","You are not authorized to acess this page");
      }

}else{
    redirect("../login.php","Login to continue");
}



?>