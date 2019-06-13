<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get(
    'files',
    [
        'uses' => 'FilesController@getAll'
    ]
);
$router->get(
    'files/storage',
    [
        'uses' => 'FilesController@getStorageSpaceUsed'
    ]
);
$router->get(
    'files/{fileId}',
    [
        'uses' => 'FilesController@getOne'
    ]
);
$router->post(
    'files',
    [
        'uses' => 'FilesController@postFile'
    ]
);
$router->delete(
    'files/{fileId}',
    [
        'uses' => 'FilesController@deleteFile'
    ]
);