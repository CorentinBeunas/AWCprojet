<?php
declare(strict_types=1);

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../models/TicketModel.php';

final class DashboardController {

  public function home(){
    Auth::start();

    if (Auth::user()) {
      header("Location: index.php?route=dashboard");
      exit;
    }

    header("Location: index.php?route=login");
  }

  public function dashboard(){
    Auth::start();
    Auth::requireLogin();

    $user = Auth::user();
    $tickets = [];

    $ticketModel = new TicketModel();

    if ($user['role'] === 'ETUDIANT') {
      $tickets = $ticketModel->findByAuteur($user['id']);
    } else {
      $tickets = $ticketModel->findAll();
    }

    View::render('dashboards/dashboard', [
      'title' => 'Dashboard',
      'user' => $user,
      'tickets' => $tickets
    ]);
  }
}