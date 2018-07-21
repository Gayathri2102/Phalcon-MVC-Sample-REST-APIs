<?php

namespace App\Services;

use App\Models\Useraddr;

/**
 * Business-logic for user address
 *
 * Class AddressService
 */
class AddressService extends AbstractService
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
     * Creating a new address
     *
     * @param array $addressData
     */
    public function setAddress(array $userData)
    {
        try {
            $user   = new Useraddr();
            $result = $user->setAddrLine1($userData['addr_line1'])
                ->setAddrLine2($userData['addr_line2'])
                ->setCity($userData['city'])
                ->setProvince($userData['province'])
                ->setPostalCode($userData['postal_code'])
                ->setUserid($userData['userid'])
                ->create();
            $newAddress = array();
            if ($result) {
                $newAddress["addressStatus"] = "ADDRESS_ADDED";
            }
            else {
                $newAddress["addressStatus"] = "ADDRESS_NOT_ADDED";
            }
            return $newAddress;

        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Returns user list
     *
     * @param array $userData
     * @return array
     */
    public function getAddress(array $userData)
    {
        try {
            $address = Useraddr::find(
                [
                    "conditions" => "userid = ?1",
                    'bind'       => [1 => $userData['user_id']],
                    'columns'    => "addr_line1, addr_line2, city, province, postal_code"
                ]
            );

            return $address->toArray();
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
