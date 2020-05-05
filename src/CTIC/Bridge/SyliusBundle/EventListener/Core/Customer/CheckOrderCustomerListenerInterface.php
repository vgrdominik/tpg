<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\EventListener\Core\Customer;

use Sylius\Component\Core\Model\OrderInterface;

interface CheckOrderCustomerListenerInterface
{
    public function checkCustomer(OrderInterface $order): void;
}
