<?php

declare(strict_types=1);


require_once dirname(__DIR__) . '/vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


$mailer = new PHPMailer();

try {
     $mailer->isSMTP();



    //authentification avec SMTP
    $mailer->Host = 'smtp.gmail.com';
    $mailer->SMTPAuth = true;
    $mailer->Username = $_ENV['GMAIL_USER'];
    $mailer->Password = $_ENV['GMAIL_PASS'];
    $mailer->SMTPSecure = 'tls';
    $mailer->Port = 587;

    //indication des destinataires

    $mailer->setFrom('ben.voydie64@gmail.com', 'benjamin'); //expéditeur
    $mailer->addAddress('pikaben64@gmail.com', 'ben'); //destinataire (nom peux etre une option)

    //ajouter du contenu dans le mail
    $mailer->Subject = 'Test envoi mail avec PHPMailer';
    $mailer->Body = "Voici du texte simple pour le test";

    //envoi du mail avec try catch
    $mailer->send();
    echo "Mail envoyé avec succès !";
} catch (Exception $e) {
    echo "Erreur lors de l'envoi : " . $mailer->ErrorInfo;
}


