<?php

use App\Controllers\AbstractHttpException;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    // Loading Configs
    $config = require(__DIR__ . '/../app/config/config.php');

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new \Phalcon\DI\FactoryDefault();

    /**
     * Overriding Response-object to set the Content-type header globally
     */
    $di->setShared(
        'response',
        function () {
            $response = new \Phalcon\Http\Response();
            $response->setContentType('application/json', 'utf-8');

            return $response;
        }
    );

    /** Common config */
    $di->setShared('config', $config);

    /** Database */
    $di->set(
        "db",
        function () use ($config) {
            return new Mysql(
                [
                    "host"     => $config->database->host,
                    "username" => $config->database->username,
                    "password" => $config->database->password,
                    "dbname"   => $config->database->dbname,
                ]
            );
        }
    );

    /** Service to perform operations with the Users */
    $di->setShared('userService', '\App\Services\UserService');
    $di->setShared('addressService', '\App\Services\AddressService');
    $di->setShared('orderService', '\App\Services\OrderService');

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Micro();

    $application->setDI($di);

    /**
     * Handle routes
     */
    include APP_PATH . '/config/router.php';
/*
    $application->before(
        function () use ($application) {
            // Getting the return value of method
            error_log("First-".$application->request->getPost('name'));
        }
    );
*/
    // Making the correct answer after executing
    $application->after(
        function () use ($application) {
            // Getting the return value of method
            $return = $application->getReturnedValue();

            if (is_array($return)) {
                // Transforming arrays to JSON
                $dataArray = array();
                $dataArray["status"] ="SUCCESS";
                $dataArray["data"] = $return;

                $application->response->setContent(json_encode($dataArray));
            } elseif (!strlen($return)) {
                // Successful response without any content
                $application->response->setStatusCode('204', 'No Content');
            } else {
                // Unexpected response
                throw new Exception('Bad Response');
            }

            // Sending response to the client
            $application->response->send();
        }
    );

    $application->handle();
}
catch (AbstractHttpException $e) {
    $response = $application->response;
    $response->setStatusCode($e->getCode(), $e->getMessage());
    $response->setJsonContent($e->getAppError());
    $response->send();
} catch (\Phalcon\Http\Request\Exception $e) {
    $application->response->setStatusCode(400, 'Bad request')
        ->setJsonContent([
            AbstractHttpException::KEY_CODE    => 400,
            AbstractHttpException::KEY_MESSAGE => 'Bad request'
        ])
        ->send();
} /**catch (\Exception $e) {
    // Standard error format
    $result = [
        AbstractHttpException::KEY_CODE    => 500,
        AbstractHttpException::KEY_MESSAGE => 'Some error occurred on the server.'
    ];

    // Sending error response
    $application->response->setStatusCode(500, 'Internal Server Error')
        ->setJsonContent($result)
        ->send();
}
**/