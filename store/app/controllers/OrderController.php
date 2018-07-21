<?php

namespace App\Controllers;

use App\Controllers\HttpExceptions\Http400Exception;
use App\Controllers\HttpExceptions\Http422Exception;
use App\Controllers\HttpExceptions\Http500Exception;
use App\Controllers\AbstractController;
use App\Services\AbstractService;
use App\Services\ServiceException;
use App\Services\OrderService;

class OrderController extends AbstractController
{

    /**
     *
     */
    public function fetchOrderAction()
    {
        $data['user_id'] = $this->request->getPost('user_id');

        try {
            $orderList = $this->orderService->getOrder($data);
        } catch (ServiceException $e) {
            throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
        }

        return $orderList;
    }

    public function addOrderAction()
    {
        /** Init Block **/
        $errors = [];
        $data = [];
        /** End Init Block **/

        $data['addr_line1'] = $this->request->getPost('address_line_1');
        $data['addr_line2'] = $this->request->getPost('address_line_2');
        $data['city'] = $this->request->getPost('city');
        $data['province'] = $this->request->getPost('province');
        $data['postal_code'] = $this->request->getPost('postal_code');
        $data['userid'] = $this->request->getPost('user_id');

        /** Validation Block **/
        /** Address line1 Validation **/
        if (empty($data['addr_line1']))
            $errors['addr_line1'] = "";
        if (!preg_match("/^[0-9a-zA-Z ]*$/", $data['addr_line1']))
            $errors['addr_line1'] = "Invalid Address!";

        /** City Validation **/
        if (empty($data['city']))
            $errors['city'] = "";
        if (!is_string($data['city']))
            $errors['city'] = "Invalid City Name";

        /** Province Validation **/
        if (empty($data['province']))
            $errors['province'] = "";
        if (!is_string($data['city']))
            $errors['city'] = "Invalid City Name";
        if (strlen($data['province']) != 2)
            $errors['province'] = "Province code can contain only 2 alphabets";

        /** Postal Code Validation **/
        if (empty($data['postal_code']))
            $errors['postal_code'] ="";
        if (!preg_match("/^([A-Z][0-9][A-Z] [0-9][A-Z][0-9])$/", $data['postal_code']))
            $errors['postal_code'] = "Invalid postal code!";

        /** Error Handling **/
        if ($errors) {
            $exception = new Http400Exception(_('Input parameters validation error'), self::ERROR_INVALID_REQUEST);
            throw $exception->addErrorDetails($errors);
        }
        /** End Validation Block **/


        try {
            $orderList = $this->orderService->setOrder($data);
        } catch (ServiceException $e) {
            throw new Http500Exception($e->getMessage(), $e->getCode(), $e);
        }

        return $orderList;
    }
}

