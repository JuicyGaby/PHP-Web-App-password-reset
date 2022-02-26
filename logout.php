<?php
session_start();
unset($_SESSION['UserLogin']);

header("Location: index.php");
