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

/** @var UserController $userController */
$userController = $container->get(UserController::class);
$userController->index();
