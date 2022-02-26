<?php
include_once("connections.php");
$con = connection();

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['UserLogin'] )) {
    header("Location: index.php");
}
    $username = $_SESSION['UserLogin'];
    $query = "SELECT * FROM users WHERE USERS_USERNAME = '$username'";
    $user = $con->query($query) or die($con->connect_error);
    $row = $user->fetch_assoc();

    $id = $row['USER_ID'];
    $isChanged = false;


    if (isset($_POST['submit'])) {

        $password = md5($_POST['password']);
        $query = "UPDATE `users` SET `USERS_PASSWORD`='$password' WHERE USER_ID = '$id'";
        $con->query($query) or die($con->connect_error);
        $isChanged = true;
    }        

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between mt-4">
            <h2>Change Password</h2>
            <a href="home.php" class="btn btn-primary">Back</a>
        </div>
            <form action="" method="POST" class="my-4">
                    <h4 class="mb-5">Edit Password: <?php echo $_SESSION['UserLogin']; ?></h4>
                    <input type="password" name="password" required placeholder="Password" required class="my-3"> <br>
                    <button name="submit" class="btn btn-success">Change Password</button>    
                    <?php if ($isChanged == true) { ?>
                        <div class="div d-flex mt-4">
                            <p class="lead alert alert-success">Password Successfully Changed</p>
                        </div>
                    <?php } ?>


                    

                    
            </form>
        </div>
</body>
</html>