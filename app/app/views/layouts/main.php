<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title><?= htmlspecialchars($title ? $title : 'Campus HelpDesk') ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php require __DIR__ . '/../partials/navbar.php'; ?>

<div class="container py-4">
<?php if (!empty($error)): ?>
<div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<?php require __DIR__ . '/../' . $view . '.php'; ?>
</div>

</body>
</html>
