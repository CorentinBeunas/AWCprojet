<h1 class="h4 mb-3"><?= htmlspecialchars($ticket['titre']) ?></h1>

<div class="card">
  <div class="card-body">

    <p><strong>Catégorie :</strong> <?= htmlspecialchars($ticket['categorie']) ?></p>
    <p><strong>Priorité :</strong> <?= htmlspecialchars($ticket['priorite']) ?></p>
    <p><strong>Statut :</strong> <?= htmlspecialchars($ticket['statut']) ?></p>
    <p><strong>Date :</strong> <?= htmlspecialchars($ticket['created_at']) ?></p>
  <?php if ($user['role'] === 'ETUDIANT'): ?>  
<h5>Messages : </h5>

<?php foreach ($messages as $msg): ?>

<div class="message">
    <p><?= htmlspecialchars($msg['contenu']) ?></p>
    <small><?= $msg['created_at'] ?></small>
</div>

<?php endforeach; ?>
<?php endif; ?>
  <hr>
  <?php if ($user['role'] === 'TECH'): ?>
    <?php if ($user['role'] === 'TECH' && $ticket['statut'] === 'OPEN'): ?>
    <a href="index.php?route=ticket-take&id=<?= $ticket['id'] ?>"
       class="btn btn-primary btn-sm">
       Prendre en charge
    </a>
<?php endif; ?>
<hr>

<h5>Modifier la priorité :</h5>

<a href="index.php?route=ticket-priority&id=<?= $ticket['id'] ?>&priorite=FAIBLE"
class="btn btn-success btn-sm">Faible</a>

<a href="index.php?route=ticket-priority&id=<?= $ticket['id'] ?>&priorite=MOYENNE"
class="btn btn-warning btn-sm">Moyenne</a>

<a href="index.php?route=ticket-priority&id=<?= $ticket['id'] ?>&priorite=ELEVEE"
class="btn btn-danger btn-sm">Élevée</a>
  <h5>Changer le statut :</h5>

  <a href="index.php?route=ticket-status&id=<?= $ticket['id'] ?>&status=IN_PROGRESS" class="btn btn-warning btn-sm">En cours</a>

  <a href="index.php?route=ticket-status&id=<?= $ticket['id'] ?>&status=RESOLVED" class="btn btn-success btn-sm">Résolu</a>

  <a href="index.php?route=ticket-status&id=<?= $ticket['id'] ?>&status=CLOSED" class="btn btn-dark btn-sm">Fermé</a> 
    <hr>
    <p><?= nl2br(htmlspecialchars($ticket['description'])) ?></p>
    <hr>
<hr>

<h5>Discussion</h5>

<?php if (!empty($messages)): ?>
  <?php foreach ($messages as $m): ?>
    <div class="border p-2 mb-2">
      <small><?= htmlspecialchars($m['created_at']) ?></small>
      <p><?= nl2br(htmlspecialchars($m['contenu'])) ?></p>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <p class="text-muted">Aucun message pour ce ticket.</p>
<?php endif; ?>

<form method="post">
  <div class="mb-3">
    <textarea name="contenu" class="form-control" required></textarea>
  </div>
  <button class="btn btn-primary btn-sm">Envoyer</button>
</form>
<?php endif; ?>  
  </div>
</div>
<a href="index.php?route=tickets" class="btn btn-secondary mt-3">
  Retour
</a>