<?php
declare(strict_types=1);

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../models/UserModel.php';

final class AuthController {

  public function login(){
    Auth::start();
    $error = null;
     $user = null; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
      $password = $_POST['password'] ? $_POST['password'] : '';

      $user = (new UserModel())->findByEmail($email);

      if (!$user || !password_verify($password, $user['mdp_hash'])) {
        $error = "Identifiants incorrects.";
      } else {
        session_regenerate_id(true);
        $_SESSION['user'] = $user;
        header("Location: index.php?route=dashboard");
        exit;
      }
    }

    View::render('Auth/login', [
      'title' => 'Connexion',
      'error' => $error,
      'user' => $user
       ]);
  }
  public function register(){

  Auth::start();
  $error = null;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = trim($_POST['nom'] ? $_POST['nom'] : '');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ? $_POST['password'] : '';

    if (!$nom || !$email || !$password) {
      $error = "Tous les champs sont obligatoires.";
    } else {

      $userModel = new UserModel();

      if ($userModel->findByEmail($email)) {
        $error = "Cet email existe déjà.";
      } else {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $userModel->createStudent($nom, $email, $hash);

        header("Location: index.php?route=login");
        exit;
      }
    }
  }

  View::render('Auth/register', [
    'title' => 'Créer un compte',
    'error' => $error
  ]);
}
  public function logout(){
    Auth::start();
    Auth::logout();
    header("Location: index.php?route=login");
    exit;
  }
}
