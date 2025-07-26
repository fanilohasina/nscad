<?php

namespace app\models;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Flight;

class ContactModel {

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

	public  function getProduit() {
        $produit = ['nom' => 'iphone 15', 'prix'=> 1290];
        return $produit;
    }

    public function envoyerEmail($nom, $email, $sujet, $message) {
        $mail = new PHPMailer(true);

        try {
            // Configuration SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'hasinafanilo022@gmail.com';
            $mail->Password = 'mzfa xadm iocd zbfv'; // Votre mot de passe d'application Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            
            // Options supplémentaires pour la sécurité
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            // Configuration de l'email
            $mail->setFrom('hasinafanilo022@gmail.com', 'Mon Site Web');
            $mail->addReplyTo($email, $nom); // Utilise l'email et le nom de l'expéditeur
            $mail->addAddress('hasinafanilo022@gmail.com'); // Destinataire

            // Contenu de l'email
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Contact depuis le site: ' . $sujet;
            $mail->Body = "
                <h3>Nouveau message de contact</h3>
                <table style='border-collapse: collapse; width: 100%;'>
                    <tr>
                        <td style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;'><strong>Nom:</strong></td>
                        <td style='border: 1px solid #ddd; padding: 8px;'>" . htmlspecialchars($nom) . "</td>
                    </tr>
                    <tr>
                        <td style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;'><strong>Email:</strong></td>
                        <td style='border: 1px solid #ddd; padding: 8px;'>" . htmlspecialchars($email) . "</td>
                    </tr>
                    <tr>
                        <td style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;'><strong>Sujet:</strong></td>
                        <td style='border: 1px solid #ddd; padding: 8px;'>" . htmlspecialchars($sujet) . "</td>
                    </tr>
                    <tr>
                        <td style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;'><strong>Message:</strong></td>
                        <td style='border: 1px solid #ddd; padding: 8px;'>" . nl2br(htmlspecialchars($message)) . "</td>
                    </tr>
                    <tr>
                        <td style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;'><strong>Date:</strong></td>
                        <td style='border: 1px solid #ddd; padding: 8px;'>" . date('d/m/Y H:i:s') . "</td>
                    </tr>
                </table>
            ";
            
            $mail->send();
            return ['success' => true, 'message' => 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.'];
            
        } catch (Exception $e) {
            // Log l'erreur pour déboguer
            error_log("Erreur envoi email: " . $mail->ErrorInfo);
            return ['success' => false, 'message' => 'Désolé, une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer plus tard.'];
        }
    }
    
}