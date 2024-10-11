<?php
require_once 'Database.php';
require_once 'Validator.php';
require_once 'TwoFactorAuth.php';
require_once 'User.php';

// Create a new instance of the Database class
$database = new Database();
$db = $database->getConnection();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate form inputs
    if (Validator::validateEmail($email) && Validator::validatePassword($password)) {
        // Create a new user instance
        $user = new User($db);
        $user->username = $username;
        $user->email = $email;
        $user->password = $password;

        // Register user
        if ($user->register()) {
            $code = TwoFactorAuth::generateCode();
            TwoFactorAuth::sendCode($email, $code);
            echo "Registration successful!";
        } else {
            echo "Failed to register.";
        }
    } else {
        echo "Invalid input.";
    }
}
?>
