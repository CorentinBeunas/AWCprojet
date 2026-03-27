<h2 class="mb-3">Créer un compte étudiant</h2>

<?php if (!empty($error)): ?>
<div class="alert alert-danger">
  <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<form method="post">

<div class="mb-3">
<label>Nom</label>
<input type="text" name="nom" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Mot de passe</label>
<input type="password" name="password" class="form-control" required>
</div>

<button class="btn btn-primary w-100">
Créer le compte
</button>

<a href="index.php?route=login" class="btn btn-secondary w-100 mt-2">
Retour connexion
</a>

</form>