<?php

    $emailadressReceive = "alexander.schnabl5@gmail.com" //Define here on which email adress the messages from the web should go.


    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
        $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

        if (empty($name) || empty($email) || empty($message)) {
            echo "Bitte füllen Sie alle Pflichtfelder aus.";
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Bitte geben Sie eine gültige E-Mail-Adresse ein.";
            exit;
        }

        // E-Mail-Details
        $to = $emailadressReceive;
        $headers = "From: $email" . "\r\n" .
                "Reply-To: $email" . "\r\n" .
                "X-Mailer: PHP/" . phpversion();
        $fullMessage = "Name: $name\n\nE-Mail: $email\n\nBetreff: $subject\n\nNachricht:\n$message";

        // E-Mail senden
        if (mail($to, $subject, $fullMessage, $headers)) {
            echo "Vielen Dank für Ihre Nachricht. Wir werden uns so schnell wie möglich bei Ihnen melden.";
        } else {
            echo "Entschuldigung, beim Senden Ihrer Nachricht ist ein Fehler aufgetreten. Bitte versuchen Sie es später erneut.";
        }
    } else {
        echo "Ungültige Anforderung.";
    }
?>
