<?php

require './vendor/autoload.php';

use App\Repositories\TagRepository;
use App\Repositories\LeadRepository;
use App\Repositories\UserRepository;
use App\Http\Controller\UserController;

$container = new App\Container();

$container->set(TagRepository::class, function() {
    return new TagRepository();
});

$container->set(LeadRepository::class, function() {
    return new LeadRepository();
});

$container->set(UserRepository::class, function() {
    return new UserRepository();
});

$userController = new UserController(
    $container->get(TagRepository::class),
    $container->get(UserRepository::class),
    $container->get(LeadRepository::class)
);

$userController->index();
