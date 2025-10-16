<?php
$insert=false;
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
     $email=$_POST['email'];
     $pass=$_POST['password'];
     $cpass=$_POST['cpassword'];

    //Check whether username exists
    //  $exists=false;
    $existsql= "SELECT * from info where Name='$name'";
    $result= mysqli_query($con,$existsql);
    $numExistsRows=mysqli_num_rows($result);
    if($numExistsRows > 0)
    {
      $show_error="Username already exists";
    }
    else
    {
     if($pass==$cpass && empty($name)!=true && empty($email)!=true && empty($pass)!=true && empty($cpass)!=true)
     {
      $hash=password_hash($pass,PASSWORD_DEFAULT);
       $sql= "INSERT INTO `info` (`Name`, `Email`, `Password`) VALUES ('$name', '$email', '$hash');";
       //echo $sql;
       $result=mysqli_query($con,$sql);
      if( $result)
      {
        //  echo "Successfully signed up";
         $insert=true;
      
      }
     }
    else
    {
        $show_error="The passwords dont match";
    }
    

       $con->close();
     
    }
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
    <title>SignUp</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="signup.php">SignUp<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
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
        <h1>WELCOME TO EBOOK READER </h1>
        <p>Please sign-up with your email-id to access the ebooks and download pdf. We will keep you updated about new
            books on our website through your email.
            You will be able to communicate with other readers on forums page and suggest some of your favourite books.
        </p>

        <?php
                    if($insert==true){
                         echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>
               <p class='msg'>Success!</strong>  Your account is now created and you can login.</p>
                
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
        <form action="signup.php" method="post" class="myform">
            <div class="form-group col-md-6">
                <label for="inputuser">Username</label>
                <input type="text" class="form-control" maxlength="14" id="username" name="username" required
                    placeholder="Enter username">
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                    aria-describedby="emailHelp" required placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" required
                    placeholder="Password">
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="password" class="form-control" maxlength="20" id="exampleInputPassword1" name="cpassword"
                    required placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary">Signup</button>
        </form>


    </div>
    <?php include 'footer.php';?>
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