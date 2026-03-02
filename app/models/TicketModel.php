<?php
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';

final class TicketModel {

  public function create($titre, $description, $categorie, $priorite, $auteurId) {
    $sql = "INSERT INTO tickets (titre, description, categorie, priorite, auteur_id)
            VALUES (:titre, :description, :categorie, :priorite, :auteur_id)";

    $stmt = Database::pdo()->prepare($sql);

    return $stmt->execute([
      'titre' => $titre,
      'description' => $description,
      'categorie' => $categorie,
      'priorite' => $priorite,
      'auteur_id' => $auteurId
    ]);
  }

  public function findByAuteur($auteurId) {
    $sql = "SELECT * FROM tickets
            WHERE auteur_id = :auteur_id
            ORDER BY created_at DESC";

    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute(['auteur_id' => $auteurId]);

    return $stmt->fetchAll();
  }
  public function findById($id) {
    $sql = "SELECT * FROM tickets WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
  }
  public function findAll($statut = null, $priorite = null) {

    $sql = "SELECT * FROM tickets WHERE 1=1";
    $params = [];

    if ($statut) {
        $sql .= " AND statut = :statut";
        $params['statut'] = $statut;
    }

    if ($priorite) {
        $sql .= " AND priorite = :priorite";
        $params['priorite'] = $priorite;
    }

    $sql .= " ORDER BY created_at DESC";

    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll();
}
  public function updateStatus($id, $status) {
    $sql = "UPDATE tickets 
            SET statut = :statut, updated_at = NOW()
            WHERE id = :id";

    $stmt = Database::pdo()->prepare($sql);

    return $stmt->execute([
        'statut' => $status,
        'id' => $id
    ]);
}
public function assignToTech($ticketId, $techId) {

    $sql = "UPDATE tickets 
            SET technicien_id = :techId,
                statut = 'IN_PROGRESS',
                updated_at = NOW()
            WHERE id = :id";

    $stmt = Database::pdo()->prepare($sql);

    return $stmt->execute([
        'techId' => $techId,
        'id' => $ticketId
    ]);
}
}