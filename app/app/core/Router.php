<?php
declare(strict_types=1);

final class Router {
  public static function dispatch(string $route){
    switch ($route) {
      case 'login':
        (new AuthController())->login();
        return;
      case 'logout':
        (new AuthController())->logout();
        return;
      case 'dashboard':
        (new DashboardController())->dashboard();
        return;
      default:
        (new DashboardController())->home();
        return;
      case 'tickets':
        require_once __DIR__ . '/../controllers/TicketController.php';
        (new TicketController())->index();
        return;
      case 'ticket-create':
         require_once __DIR__ . '/../controllers/TicketController.php';
        (new TicketController())->create();
        return;
      case 'ticket-show':
        require_once __DIR__ . '/../controllers/TicketController.php';
        (new TicketController())->show();
        return;
      case 'ticket-status':
        require_once __DIR__ . '/../controllers/TicketController.php';
        (new TicketController())->changeStatus();
        return;
        case 'ticket-take':
        require_once __DIR__ . '/../controllers/TicketController.php';
        (new TicketController())->take();
        return;
        case 'ticket-priority':
        require_once __DIR__ . '/../controllers/TicketController.php';
        (new TicketController())->changePriority();
        return;
        case 'register':
        (new AuthController())->register();
        return;
    }
  }
}
