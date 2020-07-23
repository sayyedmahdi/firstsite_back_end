<?php
session_start();
include 'config.php';
$id = $_SESSION['login'];
$db = mysqli_connect('localhost' , 'root' , '' , 'test');
$sql = "SELECT * FROM users WHERE id = $id";
$re = $db->query($sql);
$ss = $re->fetch_assoc();
$pas = $ss["password"];
if(isset($_POST['initialpassword']) && isset($_POST['username']) && isset($_POST['password'])){
    $password = $_POST['initialpassword'];
    $username = $_POST['username'];
    $fpassword = $_POST['password'];
    if($password == $pas){
        $exi = "UPDATE users SET username ='$username' , password = '$fpassword' WHERE id = $id";
        $ex = $db->query($exi);
    }
header("location : account.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchage Information</title>
    <style>

html,
        body {
    height: 100%;
}

        body {
    background-image: url("7.jpg");
            color: #fff;
            font-size: 1.5em;
            font-weight: 400;
            text-align: right;
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
        }

        .main {
    background-image: ;
            position: relative;
            background: #ffffff;
            color: #0e5698;
            display: inline-block;
            padding: 15px 30px;
            margin: 0 auto;
            border-radius: 7px;
            box-shadow: 0 50px 50px rgba(0, 0, 0, 0.2);
            min-height: 250px;
            min-width: 400px;
        }

        h1 {
    font: 30px sans-serif;
            text-align: center;
            margin: 25px 10px;
            font-weight: bold;
            color: #4a96db;
        }

        input,
        button,
        select,
        textarea {
    display: block;
    border: 1px solid #ccc;
            border-radius: 3px;
            margin-top: 10px;
            line-height: 28px;
            height: 30px;
            padding: 0 10px;
            width: 100%;
            box-sizing: border-box;
            font-family: sans-serif;
            font-size: 15px;
        }

        button {
    background: #007bec;
    color: #fff;
    line-height: 40px;
            height: 40px;
            font-size: 18px;
            border: 0;
        }

        button:hover {
    opacity: 0.7;
    cursor: pointer;
}
    </style>
</head>
<body>
<div class='main'>
    <h1>Exchage Information</h1>
    <form action="exi.php" method="post">
        <label>
            <input type="text" name="initialpassword" placeholder="initial password">
        </label>

        <label>
            <input type="text" name="username" placeholder="username">
        </label>
        <label>
            <input name="password" placeholder="password" type="password">
        </label>
        <button type="submit" name=login"">Exchange</button>
    </form>
</div>
</body>

</html>
