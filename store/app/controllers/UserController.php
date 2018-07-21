<?php

namespace App\Controllers;

use App\Controllers\HttpExceptions\Http400Exception;
use App\Controllers\HttpExceptions\Http422Exception;
use App\Controllers\HttpExceptions\Http500Exception;
use App\Controllers\AbstractController;
use App\Services\AbstractService;
use App\Services\ServiceException;
use App\Services\UsersService;

class UserController extends AbstractController
{

    /**
     *
     */
    public function loginAction()
    {
        $data['user_id'] = $this->request->getPost('user_id');
        $data['password'] = $this->request->getPost('password');

        try {
            $userList = $this->userService->getUser($data);
        } catch (ServiceException $e) {
            throw new Http500Exception(_('Internal Server Error'), $e->getCode(), $e);
        }

        return $userList;
    }

    public function registerAction()
    {
        /** Init Block **/
        $errors = [];
        $data = [];
        /** End Init Block **/

        $data['firstName'] = $this->request->getPost('firstName');
        $data['lastName'] = $this->request->getPost('lastName');
        $data['email'] = $this->request->getPost('email');
        $data['password'] = $this->request->getPost('password');
        $data['contact'] = $this->request->getPost('contact');

        /** Validation Block **/
        /** Firstname Validation **/
        if (empty($data['firstName']))
            $errors['firstName'] = "Firstname cannot be blank!";
        if (!preg_match("/^[A-Za-z]+$/", $data['firstName']))
            $errors['firstName'] = "Accepts only Letters!";

        /** Lastname Validation **/
        if (empty($data['lastName']))
            $errors['lastName'] ="Lastname cannot be blank!";
        if (!preg_match("/^[A-Za-z-' ]+$/", $data['lastName']))
            $errors['lastName'] = "Accepts only Letters,space,hyphen and apostrophe!";
        if (preg_match("/^ |^-| $|-$/", $data['lastName']))
            $errors['lastName'] = "Cannot start or end with space and hyphen!";
        $var1 = preg_replace("/[A-Za-z']/", "", $data['lastName']);
        if (strlen($var1)>1)
            $errors['lastName'] = "Can have only one hypen or space!";
        $var1 = preg_replace("/[A-Za-z -]/", "", $data['lastName']);
        if (strlen($var1)>1)
            $errors['lastName'] = "Can have only one apostrophe!";
        if ((strlen($var1)==1) && !preg_match("/^[A-Za-z]'/", $data['lastName']))
            $errors['lastName'] = "Can have apostrophe only at the second position!";

        /** Email Validation **/
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
            $errors['email'] = "Invalid email format";

        /** Password Validation **/
        if (empty($data['password']))
            $errors['password'] = "Password cannot be blank!";
        if (strlen($data['password']) < 8)
            $errors['password'] = "Password should be of minimum 8 characters";

        /** Contact Validation **/
        if (empty($data['contact']))
            $errors['contact'] = "Contact cannot be blank";
        if (strlen($data['contact']) != 10)
            $errors['contact'] = "Please enter valid phone number along with the region code";

        /** Error Handling **/
        if ($errors) {
            $exception = new Http400Exception(_('Input parameters validation error'), self::ERROR_INVALID_REQUEST);
            throw $exception->addErrorDetails($errors);
        }
        /** End Validation Block **/


        try {
            $userList = $this->userService->setUser($data);
        } catch (ServiceException $e) {
            throw new Http500Exception($e->getMessage(), $e->getCode(), $e);
        }

        return $userList;
    }
}

