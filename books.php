<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
    header("location:login.php");
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Welcome - <?php echo $_SESSION['username'] ?></title>
    <style>
    /* Set a fixed height for the card and ensure content fits */
    .fixed-size-card {
        height: 400px;
        width: 280px;
        /* Adjust this value according to your design */
        display: flex;
        flex-direction: column;
    }

    /* Ensure the image fits within the card */
    .img-fixed {
        height: 230px;
        /* Fixed height for image */
        object-fit: cover;
        /* Ensures image maintains aspect ratio but fills the space */
    }

    /* Adjust card body to take up the remaining space */
    .card-body {
        flex: 1;
        /* Takes up remaining space */
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    /* Force the text content to fit within the body */
    .card-text {
        overflow: hidden;
        /* Hide overflow if content is too long */
        text-overflow: ellipsis;
        /* Adds '...' if text overflows */
        font-size: 11px;
        /* white-space: nowrap; Prevents text wrapping */
    }

    .card-title {
        font-size: 14px;
    }

    .container {
       
        margin: auto;
        padding: 43px;


    }
    </style>

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
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="books.php">Books<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <?php
// Step 2: Database connection
$servername= "sql112.infinityfree.com";
     $username="if0_37541424";
     $password="qS90VFqv4iBm";
     $database="if0_37541424_ebook";


// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 3: Fetch data from the database
$sql = "SELECT image, title, text, link FROM `book` ";
$result = $conn->query($sql);



if ($result->num_rows > 0) {
    ?>
    <div class="container">
        <div class="row">
            <?php
            // Step 4: Loop through each row and display the card
            while ($row = $result->fetch_assoc()) {
                ?>
            <div class="col-md-4 mb-4">
                <div class="card fixed-size-card">
                    <!-- Step 5: Dynamically insert image, title, text, and link -->
                    <img class="card-img-top img-fixed " src="<?php echo $row['image']; ?>" alt="book image">
                    <div class="card-body">
                        <h5 class="card-title "><?php echo $row['title']; ?></h5>
                        <p class="card-text"><?php echo $row['text']; ?></p>
                        <a href="<?php echo $row['link']; ?>" target="_self" class="btn btn-primary btn-sm">View PDF</a>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
} else {
    echo "No records found.";
}

$conn->close();
?>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>