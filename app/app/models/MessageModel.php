<?php
declare(strict_types=1);
require_once __DIR__ . '/../core/Database.php';

final class MessageModel {

    public function findByTicket($ticketId) {
        $sql = "SELECT * FROM messages 
                WHERE ticket_id = :ticket_id
                ORDER BY created_at ASC";

        $stmt = Database::pdo()->prepare($sql);
        $stmt->execute(['ticket_id' => $ticketId]);

        return $stmt->fetchAll();
    }

    public function create($ticketId, $auteurId, $contenu) {
        $sql = "INSERT INTO messages (ticket_id, auteur_id, contenu)
                VALUES (:ticket_id, :auteur_id, :contenu)";

        $stmt = Database::pdo()->prepare($sql);

        return $stmt->execute([
            'ticket_id' => $ticketId,
            'auteur_id' => $auteurId,
            'contenu' => $contenu
        ]);
    }
}