<?php

namespace App\Services;

use App\Models\User;

/**
 * Business-logic for users
 *
 * Class UsersService
 */
class UserService extends AbstractService
{
    /** Unable to create user */
    const ERROR_UNABLE_CREATE_USER = 11001;

    /** User not found */
    const ERROR_USER_NOT_FOUND = 11002;

    /** No such user */
    const ERROR_INCORRECT_USER = 11003;

    /** Unable to update user */
    const ERROR_UNABLE_UPDATE_USER = 11004;

    /** Unable to delete user */
    const ERROR_UNABLE_DELETE_USER = 1105;

    /**
     * Creating a new user
     *
     * @param array $userData
     */
    public function setUser(array $userData)
    {
        try {
            $user   = new User();
            $result = $user->setFirstName($userData['firstName'])
                ->setLastName($userData['lastName'])
                ->setEmail($userData['email'])
                ->setPassword(password_hash($userData['password'], PASSWORD_DEFAULT))
                ->setContact($userData['contact'])
                ->create();
            $newUsers = array();
            if ($result) {
                $newUsers["registerStatus"] = "LOGIN_SUCCESS";
            }
            else {
                $newUsers["registerStatus"] = "LOGIN_FAILURE";
            }
            return $newUsers;

        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                throw new ServiceException('User already exists', self::ERROR_ALREADY_EXISTS, $e);
            } else {
                throw new ServiceException($e->getMessage(), $e->getCode(), $e);
            }
        }
    }

    /**
     * Returns user list
     *
     * @param array $userData
     * @return array
     */
    public function getUser(array $userData)
    {
        try {
            $users = User::find(
                [
                    "conditions" => "email = ?1 AND password=?2",
                    'bind'       => [1 => $userData['user_id'], 2 => $userData['password']],
                    'columns'    => "userid, firstname, lastname"
                ]
            );
            $newUsers = array();
            if (count($users) != 0)
            {
                foreach ($users as $row)
                {
                    $row->loginStatus = "LOGIN_SUCCESS";
                    $newUsers[] = $row;
                }
            }
            else
            {
                $newUsers["loginStatus"] = "LOGIN_FAILURE";
            }
            $users = $newUsers;
            return $users;
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
