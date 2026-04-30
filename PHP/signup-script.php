<?php 
session_start();
include 'database.php'; 

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $email = filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL);
    $pwd = $_POST['user_password'];
    $firstname = $_POST['user_firstname'];
    $lastname = $_POST['user_lastname'];
    $date_of_birth = $_POST['user_dob'];

    if (empty($email) || empty($pwd)) {
        header("Location: ../USER-AUTH/signup.php?error=emptyfields");
        exit();
    }

    $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

    try {
        // 1. Check if the email already exists
        $sql_check = "SELECT email FROM users WHERE email = :email";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute(['email' => $email]);

        if ($stmt_check->fetch()) {
            header("Location: ../USER-AUTH/signup.php?error=emailtaken");
            exit();
        } 

        // 2. Insert the new user
        $sql_insert = "INSERT INTO users (email, pwd, first_name, last_name, date_of_birth) 
                       VALUES (:email, :pwd, :fname, :lname, :dob)";
        
        $stmt_insert = $conn->prepare($sql_insert);
        
        // Execute ONCE inside the conditional
        if ($stmt_insert->execute([
            'email'=> $email,
            'pwd' => $hashed_pwd,
            'fname'=> $firstname,
            'lname'=> $lastname,
            'dob'=> $date_of_birth
        ])) {
            // 3. Set Session and Redirect
            $_SESSION['user_id'] = $conn->lastInsertId();
            $_SESSION['first_name'] = $firstname;

            header("Location: ../index.php?signup=success");
            exit();
        }

    } catch (PDOException $e) {
        // If the email check somehow failed and a duplicate snuck through
        if ($e->errorInfo[1] == 1062) {
            header("Location: ../USER-AUTH/signup.php?error=emailtaken");
        } else {
            die("Database Error: " . $e->getMessage());
        }
        exit();
    }

} else {
    header("Location: ../index.php");
    exit();
}