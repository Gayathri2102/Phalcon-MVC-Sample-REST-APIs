<?php

namespace App\Services;

use App\Models\Orders;
use App\Models\Usercard;
use App\Models\Useraddr;
use App\Models\ProductByOrder;
use App\Models\Store;
use App\Models\Product;

/**
 * Business-logic for user order
 *
 * Class OrderService
 */
class OrderService extends AbstractService
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
     * Creating a new order
     *
     * @param array $orderData
     */
    public function setOrder(array $orderData)
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
    public function getOrder(array $userData)
    {
        try {
            $result = $this->modelsManager->createBuilder()
                ->columns([
                    'orders.orderid', 'orders.order_date', 'orders.orderprice', 'orders.order_status',
                    'usercard.cardid', 'usercard.cardno',
                    'useraddr.addr_line1','useraddr.addr_line2','useraddr.city','useraddr.province','useraddr.postal_code'
                ])
                ->from(['orders' => 'App\Models\Orders'])
                ->leftJoin('App\Models\Usercard', 'usercard.cardid = orders.cardid', 'usercard')
                ->leftJoin('App\Models\Useraddr', 'useraddr.addressid = orders.addressid', 'useraddr')
                ->where('orders.userid = :id:', ['id' => $userData["user_id"]])
                ->getQuery()->execute();

            foreach ($result as $results){
                $result = $this->modelsManager->createBuilder()
                    ->columns([
                        'product.productid', 'product.prod_name',
                        'store.storeid', 'store.store_name',
                        'product_by_order.quantity','product_by_order.price'
                    ])
                    ->from(['orders' => 'App\Models\Orders'])
                    ->leftJoin('App\Models\Store', 'usercard.cardid = orders.cardid', 'usercard')
                    ->leftJoin('App\Models\Useraddr', 'useraddr.addressid = orders.addressid', 'useraddr')
                    ->where('orders.userid = :id:', ['id' => $userData["user_id"]])
                    ->getQuery()->execute();
            }

            return $result->toArray();
        } catch (\PDOException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
