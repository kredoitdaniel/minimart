<?php
   require "connection.php";


   // function login()
   function login($username, $password){
      $conn = connection();

      $sql = "SELECT * FROM users WHERE username = '$username'";

      if($result = $conn->query($sql)){
         if($result->num_rows == 1){ // check if username is existing
            $row = $result->fetch_assoc(); //$row is the arrayname
            if(password_verify($password, $row['password'])){ // verify password
               session_start();
               // use session_start() to start all the session variables

               $_SESSION['user_id'] = $row['id'];
               $_SESSION['username'] = $row['username'];
               $_SESSION['full_name'] = $row['first_name'] . " " . $row['last_name'];
               // $_SESSION is a global array that we can use to another file

               header("location: products.php");
               exit;
            }else{
               echo "<p class='text-danger'>Incorrect Password!</p>";
            }
         }else{
            echo "<p class='text-danger'>Username not found!</p>";
         }
      }else{
         die("Error with query: " . $conn->error);
      }
   }
   // end function login()

   if(isset($_POST['btn_log_in'])){
      $username = $_POST['username'];
      $password = $_POST['password'];

      login($username, $password);
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

    <div style="height: 100vh;">
      <div class="row h-100 m-0">
         <div class="card w-25 my-auto mx-auto px-0">
            <div class="card-header text-primary bg-white">
               <h1 class="card-title text-center mb-0">MiniMart Catalog</h1>
            </div>
            <div class="card-body">
               <form action="" method="post">
                  <label for="username" class="small">Username</label>
                  <input type="text" name="username" id="username" class="form-control mb-2" autofocus required>

                  <label for="password" class="small">Password</label>
                  <input type="password" name="password" id="password" class="form-control mb-5">

                  <button type="submit" name="btn_log_in" class="btn btn-primary w-100">Log in</button>
               </form>

               <div class="text-center mt-3">
                  <a href="signUp.php" class="small">Create Account</a>
               </div>
            </div>
         </div>
      </div>
   </div>








    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>