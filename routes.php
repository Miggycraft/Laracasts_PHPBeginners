<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

// notes
$router->get('/notes', 'notes/index.php')->only('auth');

$router->get('/note', 'notes/show.php');
$router->delete('/note/edit', 'notes/destroy.php');

$router->get('/note/edit', 'notes/edit.php');
$router->patch('/note/edit', 'notes/update.php');

$router->get('/notes/create', 'notes/create.php')->only('auth');
$router->post('/notes/create', 'notes/store.php')->only('auth');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');
