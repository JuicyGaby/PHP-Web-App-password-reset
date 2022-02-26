<?php
include_once("connections.php");
$con = connection();
if (!isset($_SESSION)) {
    session_start();
}
$error = false;
if (isset($_POST['submit'])) {
    global $error;
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE USERS_USERNAME = '$username' AND USERS_PASSWORD = '$password'";
    $user = $con->query($query) or die($con->connect_error);
    $row = $user->fetch_assoc();
    $total = $user->num_rows;

    if ($total > 0) {
        $_SESSION['UserLogin'] = $row['USERS_USERNAME'];
        header("Location: home.php");
    } else {
        $error = true;
    }

    
    
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
    <div class="container mt-3 ">
        <h1>Lab 2 Activity</h1>
        <div class="mt-5 mb-2">
            <form action="" method="POST">
                <input type="text" name="username" placeholder="Username" class="mb-3"> <br>
                <input type="password" name="password" placeholder="Password"> <br>
                <button class="btn btn-primary mt-4" name="submit">Login</button>
            </form>
        </div>
        <div class="">
            <?php if ($error == true) { ?>
                <div class="div d-flex">
                    <p class="lead alert alert-danger">Please Try Again.</p>
                </div>
            <?php } ?>
        </div>

    </div>
    
</body>
</html>