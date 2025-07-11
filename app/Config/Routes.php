<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->setAutoRoute(false);

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');
$routes->get('/dashboard', 'Auth::dashboard');
$routes->get('/logout', 'Auth::logout');
$routes->post('/crear_usuario', 'Auth::crear_usuario');
$routes->get('/crear_usuario', 'Auth::crear_usuario');
$routes->get('tickets', 'Auth::tickets');
$routes->get('/crear_ticket', 'Auth::crear_ticket');
$routes->post('/crear_ticket', 'Auth::crear_ticket');
$routes->get('ver_ticket/(:segment)', 'Auth::ver_ticket/$1');
$routes->post('ver_ticket/(:segment)', 'Auth::ver_ticket/$1');
$routes->get('registrar/', 'Auth::register');

$routes->post('editar_usuario/(:segment)', 'Auth::editar_usuario/$1');
$routes->get('eliminar_usuario/(:segment)', 'Auth::eliminar_usuario/$1');
$routes->post('eliminar_usuario/(:segment)', 'Auth::eliminar_usuario/$1');
$routes->get('editar_usuario/(:segment)', 'Auth::editar_usuario/$1');

$routes->get('/asignar_ticket/(:segment)', 'Auth::asignar_ticket/$1');
$routes->post('/asignar_ticket/(:segment)', 'Auth::asignar_ticket/$1');
$routes->post('/cambiar_estado/(:segment)', 'Auth::cambiar_estado/$1');

$routes->post('email/', 'Auth::email');



$routes->post('editar_ticket/(:segment)', 'Auth::editar_ticket/$1'); // Nueva ruta para edición con POST
$routes->get('editar_ticket/(:segment)', 'Auth::editar_ticket/$1');
$routes->get('eliminar_ticket/(:segment)', 'Auth::eliminar_ticket/$1');
$routes->post('eliminar_ticket/(:segment)', 'Auth::eliminar_ticket/$1');
$routes->get('ver_ticket/(:segment)', 'Auth::ver_ticket/$1');
$routes->post('ver_ticket/(:segment)', 'Auth::ver_ticket/$1');



