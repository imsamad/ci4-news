<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index', ["as" => "rt.homepage"]);

$routes->group("auth",  static function ($routes) {

    $routes->group("", ["filter" => "AuthFilter:guest"], static function ($routes) {
        $routes->get('login',  'AuthController::loginForm', ["as" => "rt.login"]);
        $routes->get('signup', 'AuthController::signUpForm', ["as" => "rt.signUpForm"]);
    });

    $routes->post('login', 'AuthController::loginHandler', ["as" => "rt.loginHandler"]);
    $routes->post('signup', 'AuthController::signUpHandler', ["as" => "rt.signUpHandler"]);
    $routes->get('logout', 'AuthController::logout', ["as" => "rt.logout"]);
});

$routes->group('me', ["filter" => "AuthFilter:auth"], static function ($routes) {
    $routes->get('', 'PostController::index', ["as" => "rt.profilepage"]);

    $routes->get("posts/create", "PostController::createPostPage", ["as" => "rt.createPostPage"]);
    $routes->get("posts/edit/(:num)", "PostController::editPostPage/$1", ["as" => "rt.editPostPage"]);

    $routes->post("posts", "PostController::createPostHandler", ["as" => "rt.createPostHandler"]);
    $routes->post("posts/edit/(:num)", "PostController::editPostHandler/$1", ["as" => "rt.editPostHandler"]);

    $routes->delete("posts/(:num)", "PostController::deletePost/$1", ["as" => "rt.deletePost"]);
});

$routes->group('/admin', ["filter" => "AuthFilter:admin"], static function ($routes) {
    $routes->get('', 'AdminController::index', ["as" => "rt.adminDashboard"]);
});
