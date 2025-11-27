<?php

declare(strict_types=1);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require_once dirname (__DIR__).'/vendor/autoload.php';
$mailer = new PHPMailer();

try {
     $mailer->isSMTP();



    //authentification avec SMTP
    $mailer->Host = 'smtp.gmail.com';
    $mailer->SMTPAuth = true;
    $mailer->Username = 'ben.voydie64@gmail.com';
    $mailer->Password = 'rrad ataz ybca zfzr';
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


