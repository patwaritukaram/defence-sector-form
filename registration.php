<?php

include "connect.php";

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   $select = " SELECT * FROM tukaram WHERE email = '$email' ";
                                                     
   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'user already exist!';
   }else{
      if($pass != $cpass){

         $error[] = 'password not matched!';
       }else{
         $hash=password_hash($pass,PASSWORD_DEFAULT);
         $insert = "INSERT INTO tukaram(name, email, password) VALUES('$name','$email','$hash')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
   }
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>
   <link rel="stylesheet" href="style.css">

</head> 

<body style="background-image: url('defence1.jpg'); background-repeat: no-repeat;
  background-size: cover;">

   <div class="form-container"> 

      <form action="registration.php" name='myForm' id='myForm' method="post">
         <h3>register now</h3>
         <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
         <div>
            <input type="text" id="name" name="name" required placeholder="enter your name">
            <small>
               <span class="error"></span>
            </small>

         </div>

         <div>
            <input type="email" id="email" name="email" required placeholder="enter your email">
            <small>
               <span class="error"></span>
            </small>

         </div>

         <div>
            <input type="password" id="password" name="password" required placeholder="enter your password">
            <span class="error"></span>
         </div>
         <div>
            <input type="password" id="cpassword" name="cpassword" required placeholder="confirm your password">
            <span class="error"></span>
         </div>
         <input ref={ref} type="submit" name="submit" id="submit" value="register now" onclick="return fun();"
            class="form-btn">
         <p>already have an account? <a href="login.php">login now</a></p>
      </form>

   </div>
   <script>
      var returnval = false;
      var flag = false;
      console.log("helllo");
      document.getElementById('name').addEventListener('blur', function () {

         var elName = document.getElementById('name').value;
         var elErrorName = document.getElementsByClassName("error");
         var regexNameFormat = '^[a-zA-Z\s, ]+$';
         if (elName == "" || elName == null) {
            elErrorName[0].innerText = "Please Provide Your Full Name and Last Name";
            returnval = true;

         } if (elName.match(regexNameFormat)) {
            elErrorName[0].innerHTML = '';
            returnval = false;
         } else {
            elErrorName[0].innerText = "Valid Name and Last Name";
            returnval = true;
         }

      });
      document.getElementById('email').addEventListener('blur', function () {
         var elemail = document.getElementById('email').value; 
         var elErroremail = document.getElementsByClassName("error");
         var regexemailFormat = "^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$";
         if (elemail == "" || elemail == null) {
            elErroremail[1].innerText = "Please Provide Your Full Name and Last Name";
            flag = true;
         } if (elemail.match(regexemailFormat)) {
            elErroremail[1].innerHTML = '';
            flag = false;
         } else {
            elErroremail[1].innerText = "eamil is not valid";
            flag = true;

         }
      });
      function fun() {
         console.log('clicked');
         if (returnval) {
            return false;
         }
         else if (flag) {
            return false;

         }
         return true;

      }


   </script>
</body>

</html>