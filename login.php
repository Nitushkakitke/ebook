<?php
$login=false;
$show_error=false;

if($_SERVER["REQUEST_METHOD"]=="POST")
{
     $servername= "sql112.infinityfree.com";
     $username="if0_37541424";
     $password="qS90VFqv4iBm";
     $database="if0_37541424_ebook";

     $con=mysqli_connect($servername,$username,$password,$database);

     if(!$con)
     {
        die( "connection to databse failed due to ". mysqli_connect_error());

     }
     //echo "successfully connected ";

     $name=$_POST['username'];
     $pass=$_POST['password'];
     $exists=false;
     
      //  $sql= "SELECT * from info where Name='$name' AND Password='$pass' ";
       $sql= "SELECT * from info where Name='$name'";
       $result=mysqli_query($con,$sql);
       $num=mysqli_num_rows($result);
    
      if( $num==1 )
      {
        while($row=mysqli_fetch_assoc($result))
        {
          if(password_verify($pass,$row['Password']))
          {
            $login=true;
          session_start();
          $_SESSION['loggedin']=true;
          $_SESSION['username']=$name;
          header("location:books.php");   //DO NOT PUT SPACE BETWEEN LOCATION AND :
          }
          else
          {
            $show_error="Invalid Credentials.";
          } 
        }  
      }
      else
      {
        $show_error="Invalid Credentials.";
      } 
    
       $con->close();
     
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home.html">EBOOK</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">SignUp</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="login.php">Login<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="books.php">Books</a>
                </li>
                <!-- <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li> -->
            </ul>

        </div>
    </nav>
    <!-- <img src="bg1.jpg"  class="bg" alt="books"> -->
    <div class="container">

        <?php
                    if($login==true){
                         echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>
               <p class='msg'>Success!</strong>  You are now logged-in.</p>
                
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";}
              if($show_error==true){
                echo "
   <div class='alert alert-danger alert-dismissible fade show' role='alert'>
       <strong>
      <p class='msg'>Error!</strong> $show_error</p>
       
       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
         <span aria-hidden='true'>&times;</span>
       </button>
     </div>";}
              
              ?>
        <form action="login.php" method="post" class="myform">
            <div class="form-group col-md-6">
                <label for="inputuser">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
            </div>

            <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                    placeholder="Password">
            </div>


            <button type="submit" class="btn btn-primary">Login</button>
        </form>


    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="index.js"></script>
</body>

</html>