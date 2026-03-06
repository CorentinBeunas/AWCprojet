<?php
declare(strict_types=1);

final class View {
  public static function render(string $view, array $data = []){
    extract($data);
    require __DIR__ . "/../views/layouts/main.php";
  }
}
