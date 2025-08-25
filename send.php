<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// include PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hajiojer32@gamil.com';       // ganti dengan Gmail kamu
        $mail->Password   = '789046Aji';          // ganti dengan App Password Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('tujuan@example.com', 'Penerima'); // ganti email tujuan

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Pesan dari $name";
        $mail->Body    = nl2br($message);
        $mail->AltBody = $message;

        $mail->send();
        echo "<h2>Pesan berhasil dikirim!</h2>";
    } catch (Exception $e) {
        echo "Pesan gagal dikirim. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "<p>Form belum dikirim.</p>";
}
?>
