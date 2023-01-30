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

use App\Models\User\User;
use App\Models\Servico\Servico;
use App\Models\Cliente\Cliente;
use App\Models\Pet\Pet;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/**
 * ##################
 * ### ROTAS AUTH ###
 * ##################
 */
$router->group(['prefix' => 'api/v1', 'namespace' => 'V1\Auth'], function () use ($router) {
    $router->post('/register', [
        'uses' => 'AuthController@register',
        
    ]);
    $router->post('/login', [
        'uses' => 'AuthController@login'
    ]);
    $router->post('/logout', [
        'middleware' => 'auth',
         'uses' => 'AuthController@logout'
    ]);
    $router->post('/refresh', [
        'middleware' => 'auth',
         'uses' => 'AuthController@refresh'
        ]);
});



/**
 * ##################
 * ### ROTAS USER ###
 * ##################
 */
$router->group(['prefix' => 'api/v1', 'namespace' => 'V1\User', 'as' => User::class], function () use ($router) {

    $router->post('/users', [
        'uses' => 'AuthController@register',
        'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->get('/users', [
        'uses' => 'UserController@findAll'
    ]);
    $router->get('/users/{id}', [
        'uses' => 'UserController@findOneBy'
    ]);
    $router->put('/users/{param}', [
        'uses' => 'UserController@editBy',
        'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->patch('/users/{param}', [
        'uses' => 'UserController@editBy',
        'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->delete('/users/{id}', [
        'uses' => 'UserController@delete'
    ]);
 });
 
 
 /**
  * ######################
  * ### ROTAS PETS ###
  * #####################
  */
 $router->group(['prefix' => 'api/v1', 'namespace' => 'V1\Pet', 'as' => Pet::class], function () use ($router) {
     
     $router->post('/pets', [
         'uses' => 'PetController@create',
         'middleware' => 'ValidateDataMiddleware',
         'middleware' => 'auth'
     ]);
     $router->get('/pets', [
         'uses' => 'PetController@findAll',
         'middleware' => 'auth'
     ]);
     $router->get('/pets/cliente/{cliente}', [
         'uses' => 'PetController@findByCliente'
     ]);
     $router->get('/pets/{param}', [
         'uses' => 'PetController@findBy'
     ]);
     $router->put('/pets/{param}', [
         'uses' => 'PetController@editBy',
         'middleware' => 'ValidateDataMiddleware'
     ]);
     $router->patch('/pets/{param}', [
         'uses' => 'PetController@editBy',
         'middleware' => 'ValidateDataMiddleware'
     ]);
     $router->delete('/pets/{param}', [
         'uses' => 'PetController@deleteBy'
     ]);
     $router->delete('/pets/cliente/{Cliente}', [
         'uses' => 'PetController@deleteByCliente'
     ]);
 });


/**
 * ######################
 * ### ROTAS CLIENTES ###
 * #####################
 */
$router->group(['prefix' => 'api/v1', 'namespace' => 'V1\Cliente', 'as' => Cliente::class], function () use ($router) {
    
    $router->post('/clientes', [
        'uses' => 'ClienteController@create',
        //'middleware' => 'ValidateDataMiddleware',
        //'middleware' => 'auth'
    ]);
    $router->get('/clientes', [
        'uses' => 'ClienteController@findAll',
        'middleware' => 'auth'
    ]);
    $router->get('/clientes/user/{User}', [
        'uses' => 'ClienteController@findByUser'
    ]);
    $router->get('/clientes/{param}', [
        'uses' => 'ClienteController@findBy',
        'middleware' => 'auth'
    ]);
    $router->put('/clientes/{param}', [
        'uses' => 'ClienteController@editBy',
        'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->patch('/clientes/{param}', [
        'uses' => 'ClienteController@editBy',
        'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->delete('/clientes/{param}', [
        'uses' => 'ClienteController@deleteBy'
    ]);
    $router->delete('/clientes/user/{User}', [
        'uses' => 'ClienteController@deleteByUser'
    ]);
});

/**
 * ######################
 * ### ROUTES SERVICES ##
 * #####################
 */
$router->group(['prefix' => 'api/v1', 'namespace' => 'V1\Servico', 'as' => Servico::class], function () use ($router) {
    
    $router->post('/servicos', [
        'uses' => 'ServicoController@create',
        //'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->get('/servicos', [
        'uses' => 'ServicoController@findAllService'
    ]);
    $router->get('/servicos/cliente/{cliente}', [
        'uses' => 'ServicoController@findByCliente'
    ]);
    $router->get('/servicos/{param}', [
        'uses' => 'ServicoController@findBy'
    ]);
    $router->put('/servicos/{param}', [
        'uses' => 'ServicoController@editBy',
        'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->delete('/servicos/cliente/{cliente}', [
        'uses' => 'ServicoController@deleteCliente'
    ]);
    $router->delete('/servicos/{id}', [
        'uses' => 'ServicoController@delete'
    ]);
});

/**
 * ########################
 * ### ROUTES PROVIDERS ##
 * ######################
 */
$router->group(['prefix' => 'api/v1', 'namespace' => 'V1\Provider', 'as' => Provider::class], function () use ($router) {
    
    $router->post('/providers', [
        'uses' => 'ProviderController@create',
        //'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->get('/providers', [
        'uses' => 'ProviderController@findAll'
    ]);
    $router->get('/providers/{param}', [
        'uses' => 'ProviderController@findBy'
    ]);
    $router->put('/providers/{param}', [
        'uses' => 'ProviderController@editBy',
        'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->delete('/providers/{id}', [
        'uses' => 'ProviderController@delete'
    ]);
});

/**
 * #######################
 * ### ROUTES PRODUCTS ##
 * #####################
 */
$router->group(['prefix' => 'api/v1', 'namespace' => 'V1\Product', 'as' => Product::class], function () use ($router) {
    
    $router->post('/product', [
        'uses' => 'ProductController@create',
        //'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->get('/products', [
        'uses' => 'ProductController@findAllProducts'
    ]);
    $router->get('/products/provider/{provider}', [
        'uses' => 'ProductController@findByProvider'
    ]);
    $router->get('/product/{param}', [
        'uses' => 'ProductController@findBy'
    ]);
    $router->put('/product/{param}', [
        'uses' => 'ProductController@editBy',
        'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->delete('/products/provider/{provider}', [
        'uses' => 'ProductController@deleteProvider'
    ]);
    $router->delete('/product/{id}', [
        'uses' => 'ProductController@delete'
    ]);
});

/**
 * ########################
 * ### ROUTES EMPLOYEES ##
 * ######################
 */
$router->group(['prefix' => 'api/v1', 'namespace' => 'V1\Employe', 'as' => Employe::class], function () use ($router) {
    
    $router->post('/employe', [
        'uses' => 'EmployeController@create',
        //'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->get('/employees', [
        'uses' => 'EmployeController@findAll'
    ]);
    $router->get('/employe/{param}', [
        'uses' => 'EmployeController@findBy'
    ]);
    $router->put('/employe/{param}', [
        'uses' => 'EmployeController@editBy',
        //'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->delete('/employe/{id}', [
        'uses' => 'EmployeController@delete'
    ]);
});

/**
 * #######################
 * ### ROUTES TICKETS ###
 * #####################
 */
$router->group(['prefix' => 'api/v1', 'namespace' => 'V1\Ticket', 'as' => Ticket::class], function () use ($router) {
    
    $router->post('/ticket', [
        'uses' => 'TicketController@create',
        //'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->get('/tickets', [
        'uses' => 'TicketController@findAllTickets'
    ]);
    $router->get('/tickets/provider/{provider}', [
        'uses' => 'TicketController@findByProvider'
    ]);
    $router->get('/ticket/{param}', [
        'uses' => 'TicketController@findBy'
    ]);
    $router->put('/ticket/{param}', [
        'uses' => 'TicketController@editBy',
        'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->delete('/tickets/provider/{provider}', [
        'uses' => 'TicketController@deleteProvider'
    ]);
    $router->delete('/ticket/{id}', [
        'uses' => 'TicketController@delete'
    ]);
});

/**
 *  ###################
 * ### ROUTES SALES ##
 * ##################
 */
$router->group(['prefix' => 'api/v1', 'namespace' => 'V1\Sale', 'as' => Sale::class], function () use ($router) {
    
    $router->post('/sale', [
        'uses' => 'SaleController@create',
        //'middleware' => 'ValidateDataMiddleware'
    ]);

    $router->get('/sales', [
        'uses' => 'SaleController@findAll'
    ]);

    $router->get('/sale/{param}', [
        'uses' => 'SaleController@findBy'
    ]);

    $router->put('/sale/{param}', [
        'uses' => 'SaleController@editBy',
        'middleware' => 'ValidateDataMiddleware'
    ]);
   
    $router->delete('/sale/{id}', [
        'uses' => 'SaleController@delete'
    ]);
});




