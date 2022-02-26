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
$passSet = false;
$randomPass = "";

if (isset($_POST['submit'])) {

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $length = 8;
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
        global $randomPass, $passSet;
        $passSet = true;
        $randomPass = randomPassword();
        $password = md5($randomPass);
        $query = "UPDATE `users` SET `USERS_PASSWORD`='$password' WHERE USER_ID = '$id'";
        $con->query($query) or die($con->connect_error);


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
            <h3>Reset Password</h3>
            <a href="home.php" class="btn btn-primary">Back</a>
            
        </div>
        
        
            <?php if ($passSet == true) { ?>
            <div class="div d-flex">
               <p class="lead alert alert-success">Password successfully reset.</p>
            </div>
            <p class="lead">New Password: <b></b><?php echo $randomPass ?></b></p>
            <a href="logout.php" class="btn btn-danger">Log-out</a>
           <?php } else { ?>
            <form action="" method="post">
                <button class="btn btn-warning" name="submit">Reset Password</button>
            </form>
           <?php }?>
        
        
        
    </div>
</body>
</html>