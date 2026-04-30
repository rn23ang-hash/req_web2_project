<?php
session_start();
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $email = $_POST['user_email'];
    $pwd = $_POST['user_password'];


    if (empty($email) || empty($pwd)) {
        header("Location: ../USER-AUTH/login.php?error=emptyfields");
    } else {
        // 1. Prepare the query
        // We select the whole row to get the hashed password and user ID
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1;";
        $stmt = $conn->prepare($sql);
        
        // 2. Bind and Execute
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        // 3. Fetch the result
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // 4. Verify password against the hash in the DB
            // Assuming you used password_hash() during signup
            $checkPwd = password_verify($pwd, $user['pwd']);

            if ($checkPwd === false) {
                header("Location: ../USER-AUTH/login.php?error=wrongpwd");
                exit();
            } else if ($checkPwd === true) {
                // 5. Login Success: Set session variables
                $_SESSION['userId'] = $user['id'];
                $_SESSION['userEmail'] = $user['user_email'];

                header("Location: ../index.php?login=success");
                exit();
            }
        } else {
            header("Location: ../USER-AUTH/login.php?error=nouser");
            exit();
        }
    }


} else {


    header("Location: ../index.php");
    exit();

}