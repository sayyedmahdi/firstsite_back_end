<?php
session_start();
include_once ('config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
                if (login($username , $password)) {
                    header("location: account.php");
                    exit;
                }else {
                    header("location:login.php");
                    exit;
                }

        }
        else{
            header("location: login.php");
        }
    }
}
function login($username, $password)
{
    global $pdo;
    if (!isUserExists($username , $password) || isUserExists($username , $password) == 0) {
        return false;
    }
    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username, ':password' => $password]);
    global $result;
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION['login'] = $result->id;
    return true;
}
function isUserExists($username , $password)
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username]);
    return $stmt->rowCount();
}

