<h1 class="h4 mb-3"><?= htmlspecialchars($ticket['titre']) ?></h1>

<div class="card">
  <div class="card-body">

    <p><strong>Catégorie :</strong> <?= htmlspecialchars($ticket['categorie']) ?></p>
    <p><strong>Priorité :</strong> <?= htmlspecialchars($ticket['priorite']) ?></p>
    <p><strong>Statut :</strong> <?= htmlspecialchars($ticket['statut']) ?></p>
    <p><strong>Date :</strong> <?= htmlspecialchars($ticket['created_at']) ?></p>
  <hr>
  <?php if ($user['role'] === 'TECH'): ?>
    <?php if ($user['role'] === 'TECH' && $ticket['statut'] === 'OPEN'): ?>
    <a href="index.php?route=ticket-take&id=<?= $ticket['id'] ?>"
       class="btn btn-primary btn-sm">
       Prendre en charge
    </a>
<?php endif; ?>
  <h5>Changer le statut :</h5>

  <a href="index.php?route=ticket-status&id=<?= $ticket['id'] ?>&status=IN_PROGRESS" class="btn btn-warning btn-sm">En cours</a>

  <a href="index.php?route=ticket-status&id=<?= $ticket['id'] ?>&status=RESOLVED" class="btn btn-success btn-sm">Résolu</a>

  <a href="index.php?route=ticket-status&id=<?= $ticket['id'] ?>&status=CLOSED" class="btn btn-dark btn-sm">Fermé</a> 
    <hr>
    <p><?= nl2br(htmlspecialchars($ticket['description'])) ?></p>
    <hr>
<h5>Discussion</h5>

<?php foreach ($messages as $m): ?>
  <div class="border p-2 mb-2">
    <small><?= htmlspecialchars($m['created_at']) ?></small>
    <p><?= nl2br(htmlspecialchars($m['contenu'])) ?></p>
  </div>
<?php endforeach; ?>

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