<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\EventListener\Core\Customer;

use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;

interface CheckOrderCustomerListenerInterface
{
    public function checkCustomer(ResourceControllerEvent $event): void;
}
