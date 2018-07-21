<?php

/*
$router = $di->getRouter();

class YourRoutes extends Phalcon\Mvc\Router\Group
{
    public function initialize()
{
        $this->setPaths(['namespace' => '\App\Controllers']);
        $this->addPost('/checkLogin', ['controller' => 'UserController', 'action' => 'loginAction']); // this will be controller1 class
        $this->addPost('/setUser', ['controller' => 'UserController', 'action' => 'registerAction']); // this will be controller2 class
    }
}

$router->mount(new YourRoutes());
//$router->handle();
*/

// Define your routes here
$usersCollection = new \Phalcon\Mvc\Micro\Collection();
$usersCollection->setHandler('\App\Controllers\UserController', true);
$usersCollection->post('/checkLogin', 'loginAction');
$usersCollection->post('/setUser', 'registerAction');

$application->mount($usersCollection);

$addressCollection = new \Phalcon\Mvc\Micro\Collection();
$addressCollection->setHandler('\App\Controllers\AddressController', true);
$addressCollection->post('/setAddress', 'addAddressAction');
$addressCollection->post('/getAddress', 'fetchAddressAction');

$application->mount($addressCollection);

$orderCollection = new \Phalcon\Mvc\Micro\Collection();
$orderCollection->setHandler('\App\Controllers\OrderController', true);
$orderCollection->post('/setOrder', 'addOrderAction');
$orderCollection->post('/getOrder', 'fetchOrderAction');

$application->mount($orderCollection);

// not found URLs
$application->notFound(
    function () use ($application) {
        $exception =
            new \App\Controllers\HttpExceptions\Http404Exception(
                _('URI not found or error in request.'),
                \App\Controllers\AbstractController::ERROR_NOT_FOUND,
                new \Exception('URI not found: ' . $application->request->getMethod() . ' ' . $application->request->getURI())
            );
        throw $exception;
    }
);