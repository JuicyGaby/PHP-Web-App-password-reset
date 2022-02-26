<?php
include_once("connections.php");
$con = connection();

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['UserLogin'] )) {
    header("Location: index.php");
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
    <div class="container">
        <div class="d-flex justify-content-between my-4">
            <h3><?php echo "Hello ". $_SESSION['UserLogin']?></h3>
            <a href="logout.php" class="btn btn-danger">Log-out</a>
        </div>
        <a class="btn btn-secondary me-3" href="changepass.php">Change Password</a>
        <a class="btn btn-warning" href="resetpass.php">Reset Password</a>
        
    </div>
    
</body>
</html>