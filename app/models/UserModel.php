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
  public function createStudent($nom, $email, $hash){

  $sql = "INSERT INTO utilisateurs (nom, email, mdp_hash, role, actif)
          VALUES (:nom, :email, :hash, 'ETUDIANT', 1)";

  $stmt = Database::pdo()->prepare($sql);

  return $stmt->execute([
    'nom' => $nom,
    'email' => $email,
    'hash' => $hash
  ]);
}
}
