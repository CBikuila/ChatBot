<?php
// Déconnexion de l'utilisateur

// Code de déconnexion ici
session_destroy();
// Renvoyer la réponse deconnexion réussie
//echo 'response_deconnexion';
// Réponse en JSON
$response_deconnexion = array(
  'status' => 'success',
  'message' => 'Déconnexion réussie'
);

// Envoi de la réponse JSON
header('Content-Type: application/json');
echo json_encode($response_deconnexion);