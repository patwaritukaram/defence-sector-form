<?php

include 'connect.php';

session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = $_POST['password'];  

   $select = " SELECT * FROM tukaram WHERE email = '$email'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);
      if(password_verify($pass,$row['password'])){

      

         $_SESSION['user'] = $row['email'];
         header('location:info.php');

      // elseif($row['type'] == 'user'){

      //    $_SESSION['user'] = $row['name'];
      //    header('location:student.php');

      // }
      }
      else{
         $error[] = 'incorrect email or password!';
      }
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body style="background-image: url('defence2.jpg'); background-repeat: no-repeat;
  background-size: cover;" class="tuka">
            
<div class="form-container">

   <form action="login.php" method="post" >
     <a href="info.php"> <h3>login now</h3></a> 
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
        
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <a href="info.php"> <input type="submit" name="submit" value="login now" class="form-btn" > </a>
      <p>don't have an account? <a href="registration.php">register now</a></p> 
   </form>

</div>

</body>
</html>