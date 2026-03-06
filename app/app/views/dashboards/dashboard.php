<h1 class="mb-4">Bienvenue <?= htmlspecialchars($user['nom']) ?></h1>

<div class="card shadow-sm">
<div class="card-body">

<h4 class="mb-3">Tickets</h4>

<?php if (empty($tickets)): ?>

<div class="alert alert-info">
Aucun ticket pour le moment.
</div>

<?php else: ?>

<table class="table table-hover">
<thead>
<tr>
<th>ID</th>
<th>Titre</th>
<th>Priorité</th>
<th>Statut</th>
<th>Date</th>
<th></th>
</tr>
</thead>

<tbody>

<?php foreach ($tickets as $t): ?>

<tr>
<td><?= $t['id'] ?></td>

<td><?= htmlspecialchars($t['titre']) ?></td>

<td>
<span class="badge bg-warning">
<?= htmlspecialchars($t['priorite']) ?>
</span>
</td>

<td>
<span class="badge bg-secondary">
<?= htmlspecialchars($t['statut']) ?>
</span>
</td>

<td><?= $t['created_at'] ?></td>

<td>
<a href="index.php?route=ticket-show&id=<?= $t['id'] ?>" 
class="btn btn-sm btn-primary">
Voir
</a>
</td>

</tr>

<?php endforeach; ?>

</tbody>
</table>

<?php endif; ?>

</div>
</div>