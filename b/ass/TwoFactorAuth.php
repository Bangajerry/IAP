<?php
class TwoFactorAuth {
    public static function generateCode() {
        return rand(100000, 999999);
    }

    public static function sendCode($email, $code) {
        // Here, you'd normally use a mail server or third-party API to send the code.
        echo "2FA Code sent to $email: $code";
    }
}
?>