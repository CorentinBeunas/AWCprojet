<?php
declare(strict_types=1);
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/View.php';

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

    $u = Auth::user();

    if ($u['role'] === 'ADMIN') {
      View::render('dashboards/admin', ['title'=>'Admin','user'=>$u]);
    } elseif ($u['role'] === 'TECH') {
      View::render('dashboards/tech', ['title'=>'Tech','user'=>$u]);
    } elseif ($u['role'] === 'ETUDIANT') {
      View::render('dashboards/user', ['title'=>'User','user'=>$u]);
    }
  }
}
