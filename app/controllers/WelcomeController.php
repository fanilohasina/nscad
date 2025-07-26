<?php

namespace app\controllers;

use app\models\ProductModel;
use Flight;

class WelcomeController {

	public function __construct() {

	}

	public function home() {
        Flight::render('home');
    }

    public function sendEmail() {
        $name     = $_POST['name'] ?? '';
        $email   = $_POST['email'] ?? '';
        $subject   = $_POST['subject'] ?? '';
        $message = $_POST['message'] ?? '';
        
        // Validation basique
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            $data = [
                'error' => 'Tous les champs sont obligatoires.',
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message
            ];
            Flight::render('home', $data);
            return;
        }
        
        // Validation de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data = [
                'error' => 'Veuillez entrer une adresse email valide.',
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message
            ];
            Flight::render('home', $data);
            return;
        }
        
        $contactModel = Flight::contactModel();
        $result = $contactModel->envoyerEmail($name, $email, $subject, $message);
        
        // Gestion du retour de l'envoi d'email
        if ($result['success']) {
            $data = ['success' => $result['message']];
        } else {
            $data = [
                'error' => $result['message'],
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message
            ];
        }
        
        Flight::render('home');
    }
}