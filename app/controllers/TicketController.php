<?php
declare(strict_types=1);

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../models/TicketModel.php';

final class TicketController {

  public function index() {
    Auth::start();
    Auth::requireLogin();

    $user = Auth::user();
    $ticketModel = new TicketModel();

    if ($user['role'] === 'ETUDIANT') {

        // L'étudiant voit uniquement ses tickets
        $tickets = $ticketModel->findByAuteur($user['id']);

    } elseif ($user['role'] === 'TECH') {

        // Le technicien peut filtrer
        $statut = $_GET['statut'] ? $_GET['statut'] : null;
        $priorite = $_GET['priorite'] ? $_GET['priorite'] : null;

        $tickets = $ticketModel->findAll($statut, $priorite);

    } else {

        // ADMIN (si tu veux tout afficher)
        $tickets = $ticketModel->findAll();
    }

    View::render('tickets/list', [
        'title' => 'Liste des tickets',
        'tickets' => $tickets
    ]);
}

  public function create() {
    Auth::start();
    Auth::requireLogin();

    $user = Auth::user();
    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $titre = trim($_POST['titre'] ? $_POST['titre'] : '');
      $description = trim($_POST['description'] ? $_POST['description'] : '');
      $categorie = trim($_POST['categorie'] ? $_POST['categorie'] : '');
      $priorite = trim($_POST['priorite'] ? $_POST['priorite'] : '');

      if (!$titre || !$description || !$categorie || !$priorite) {
        $error = "Tous les champs sont obligatoires.";
      } else {

        (new TicketModel())->create(
          $titre,
          $description,
          $categorie,
          $priorite,
          $user['id']
        );

        header("Location: index.php?route=tickets");
        exit;
      }
    }

    View::render('tickets/create', [
      'title' => 'Nouveau ticket',
      'error' => $error
    ]);
  }
  public function show() {
  Auth::start();
  Auth::requireLogin();

  $user = Auth::user();
  $id = (int)($_GET['id'] ? $_GET['id'] : 0);

  if (!$id) {
    header("Location: index.php?route=tickets");
    exit;
  }

  $ticket = (new TicketModel())->findById($id);

  if (!$ticket) {
    header("Location: index.php?route=tickets");
    exit;
  }

  // 🔐 Sécurité : étudiant ne peut voir que ses tickets
  if ($user['role'] === 'ETUDIANT' && $ticket['auteur_id'] != $user['id']) {
    header("Location: index.php?route=tickets");
    exit;
  }

  View::render('tickets/show', [
    'title' => 'Détail du ticket',
    'ticket' => $ticket,
    'user' => $user
  ]);
  require_once __DIR__ . '/../models/MessageModel.php';

    $messageModel = new MessageModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contenu = trim($_POST['contenu'] ? $_POST['contenu'] : '');
    if ($contenu) {
        $messageModel->create($id, $user['id'], $contenu);
    }
}

$messages = $messageModel->findByTicket($id);
}
public function changeStatus() {

    Auth::start();
    Auth::requireLogin();

    $user = Auth::user();

    // 🔐 Seul le TECH peut changer le statut
    if ($user['role'] !== 'TECH') {
        header("Location: index.php");
        exit;
    }

    $id = (int)($_GET['id'] ? $_GET['id'] : 0);
    $newStatus = $_GET['status'] ? $_GET['status'] : '';

    if (!$id || !$newStatus) {
        header("Location: index.php?route=tickets");
        exit;
    }

    $ticketModel = new TicketModel();
    $ticket = $ticketModel->findById($id);

    if (!$ticket) {
        header("Location: index.php?route=tickets");
        exit;
    }

    $allowedTransitions = [
        'IN_PROGRESS' => ['RESOLVED'],
        'RESOLVED'    => ['CLOSED']
    ];

    $currentStatus = $ticket['statut'];


    if (
        !isset($allowedTransitions[$currentStatus]) ||
        !in_array($newStatus, $allowedTransitions[$currentStatus])
    ) {
        header("Location: index.php?route=ticket-show&id=" . $id);
        exit;
    }


    $ticketModel->updateStatus($id, $newStatus);

    header("Location: index.php?route=ticket-show&id=" . $id);
    exit;
}
public function take() {
    Auth::start();
    Auth::requireLogin();

    $user = Auth::user();

    if ($user['role'] !== 'TECH') {
        header("Location: index.php");
        exit;
    }

    $id = (int)($_GET['id'] ? $_GET['id'] : 0);

    if ($id) {
        (new TicketModel())->assignToTech($id, $user['id']);
    }

    header("Location: index.php?route=ticket-show&id=" . $id);
    exit;
}
}


