<?php
declare(strict_types=1);
require_once __DIR__ . '/../core/Database.php';

final class UserModel {
  public function findByEmail(string $email){
    $stmt = Database::pdo()->prepare(
      "SELECT * FROM utilisateurs WHERE email = :email LIMIT 1"
    );
    $stmt->execute(['email' => $email]);
    $u = $stmt->fetch();
    return $u ?: null;
  }
}
