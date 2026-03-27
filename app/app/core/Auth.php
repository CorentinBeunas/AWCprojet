<?php
declare(strict_types=1);

final class Auth {
  public static function start(){
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }
  }
public static function user(){
    return isset($_SESSION['user']) ? $_SESSION['user'] : null;
}

  public static function requireLogin(){
    if (!self::user()) {
      header("Location: index.php?route=login");
      exit;
    }
  }

  public static function logout(){
    $_SESSION = [];
    session_destroy();
  }
}
