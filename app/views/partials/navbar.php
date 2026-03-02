<?php
require_once __DIR__ . '/../../core/Auth.php';
Auth::start();
$u = Auth::user();
?>

<nav class="navbar navbar-light bg-white shadow-sm mb-4">
  <div class="container d-flex justify-content-between align-items-center">

    <span class="navbar-brand fw-bold">
      Campus HelpDesk
    </span>

    <?php if ($u): ?>
      <div>

        <?php if ($u['role'] === 'ETUDIANT'): ?>
          <a href="index.php?route=tickets" class="btn btn-outline-primary btn-sm me-2">
            Mes tickets
          </a>
          <a href="index.php?route=ticket-create" class="btn btn-primary btn-sm me-2">
            Nouveau ticket
          </a>
        <?php endif; ?>

        <?php if ($u['role'] === 'TECH'): ?>
          <a href="index.php?route=tickets" class="btn btn-outline-primary btn-sm me-2">
            Tous les tickets
          </a>
        <?php endif; ?>

        <a href="index.php?route=logout" class="btn btn-outline-danger btn-sm">
          Déconnexion
        </a>

      </div>
    <?php endif; ?>

  </div>
</nav>