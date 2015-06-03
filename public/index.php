<?php

include "../autoload.php";

$dbConnection = include '../config/db.php';

$controller = new \Rss\Controller;

$templater = new \Rss\Template\Templater();

$database = new \Rss\Database\Database(
    new \PDO(
        $dbConnection['dbHostDsn'],
        $dbConnection['dbUserName'],
        $dbConnection['dbPassword']        
    )
);

$curl = new \Rss\Curl();

$container = new \Rss\InjectionContainer();
$container->add('templateEngine', $templater);
$container->add('curl', $curl);
$container->add('repository', new \Rss\RSSFeed\Repository($database));
$container->add('templateFactory', new \Rss\Template\Factory());
$container->add('postVars', $_POST);
$container->add('rssParser', new \Rss\RSSFeed\Parser());

$controller->setInjectionContainer($container);
$templater->setInjectionContainer($container)
    ->setTemplatePath('../Templates/')
    ->setOuterTemplate('mainTemplate.php');

$router = new \Rss\Router($controller, $_SERVER['REQUEST_URI']);
try {
    echo $router->execute();
} catch (\Exception $e) {
    echo 'There was a problem with execution '.$e->getMessage();
}