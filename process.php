<?php
session_start();

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            if (isset($_POST['register'])) {
                if (register($_POST['username'], $_POST['password'], $_POST['email'])) {
                    header("location: home.php");
                    exit;
                } else {
                    header("location: register.php?s=0");
                    exit;
                }
            }
        }
    }
}

function register($username, $password , $email)
{
    global $pdo;
    if (isUserExists($username)) {
        return false;
    }
    $sql = "INSERT INTO users (username, password , email) VALUES (:username, :password, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ ':username' => $username, ':password' => $password, ':email' => $email]);
    global $re;
    $re = $stmt->fetch(PDO::FETCH_OBJ);
    return $stmt->rowCount();
}
function isUserExists($username)
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username]);
    return $stmt->rowCount();
}
