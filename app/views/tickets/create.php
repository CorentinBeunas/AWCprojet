<h1 class="h4 mb-3">Créer un ticket</h1>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post">
  <div class="mb-3">
    <label class="form-label">Titre</label>
    <input type="text" name="titre" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" required></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Catégorie</label>
    <select name="categorie" class="form-select" required>
      <option value="">Choisir...</option>
      <option value="RESEAU">Réseau</option>
      <option value="MATERIEL">Matériel</option>
      <option value="LOGICIEL">Logiciel</option>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Priorité</label>
    <select name="priorite" class="form-select" required>
      <option value="">Choisir...</option>
      <option value="FAIBLE">Faible</option>
      <option value="MOYENNE">Moyenne</option>
      <option value="ELEVEE">Élevée</option>
    </select>
  </div>

  <button class="btn btn-success">Créer</button>
</form>