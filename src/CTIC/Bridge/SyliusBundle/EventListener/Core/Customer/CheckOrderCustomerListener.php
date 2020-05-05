<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\EventListener\Core\Customer;

use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Customer\Context\CustomerContextInterface;

final class CheckOrderCustomerListener implements CheckOrderCustomerInterface
{
    /** @var CustomerContextInterface */
    private $customerContext;

    public function __construct(CustomerContextInterface $customerContext)
    {
        $this->customerContext = $customerContext;
    }

    public function checkCustomer(OrderInterface $order): void
    {
        /** @var CustomerInterface $customer */
        $customer = $order->getCustomer();
        if (null === $customer) {
            $customer = $this->customerContext->getCustomer();
            if ($customer) {
                $order->setCustomer($customer);
            }
        }
        if (null === $customer || null === $customer->getUser()) {
            return;
        }

        return;
    }
}
