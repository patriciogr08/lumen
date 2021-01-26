<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
/*
$router->get('/', function () use ($router) {
    return $router->app->version();
});
*/
$router->get('/persona', 'PersonaController@listar');

$router->get('/persona/{id}', 'PersonaController@buscarPersona');

$router->post('/persona', 'PersonaController@insertar');

$router->put('/persona', 'PersonaController@actualizar');

$router->delete('/persona/{id}', 'PersonaController@eliminadoFisico');