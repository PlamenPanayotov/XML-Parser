<?php
require 'vendor/autoload.php';

use App\Repository\BookRepository;
use App\Config\Connection;
use App\Core\Template;
use App\Service\AppService;
use App\Router;

$params = parse_ini_file('./app/Config/config.ini');
if ($params === false) {
    throw new \Exception("Error reading database configuration file");
}
$dir = $params['dir'];

$template = new Template();
$service = new AppService($template);
$pdo = Connection::get()->connect();
$bookRepository = new BookRepository($pdo);
$router = new Router($service, $bookRepository, $template);
