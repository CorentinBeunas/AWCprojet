<?php
declare(strict_types=1);

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../models/UserModel.php';

final class AuthController {

  public function login(){
    Auth::start();
    $error = null;

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

    View::render('auth/login', ['title' => 'Connexion', 'error' => $error]);
  }

  public function logout(){
    Auth::start();
    Auth::logout();
    header("Location: index.php?route=login");
    exit;
  }
}
