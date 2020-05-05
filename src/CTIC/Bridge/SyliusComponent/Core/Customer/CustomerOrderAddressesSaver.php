<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusComponent\Core\Customer;

use Sylius\Component\Core\Customer\CustomerAddressAdderInterface;
use Sylius\Component\Core\Customer\OrderAddressesSaverInterface;
use Sylius\Component\Core\Model\AddressInterface;
use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Customer\Context\CustomerContextInterface;

final class CustomerOrderAddressesSaver implements OrderAddressesSaverInterface
{
    /** @var CustomerAddressAdderInterface */
    public $addressAdder;

    /** @var CustomerContextInterface */
    public $customerContext;

    public function __construct(CustomerAddressAdderInterface $addressAdder, CustomerContextInterface $customerContext)
    {
        $this->addressAdder = $addressAdder;
        $this->customerContext = $customerContext;
    }

    public function saveAddresses(OrderInterface $order): void
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

        $this->addAddress($customer, $order->getBillingAddress());
        $this->addAddress($customer, $order->getShippingAddress());
    }

    private function addAddress(CustomerInterface $customer, ?AddressInterface $address): void
    {
        if (null !== $address) {
            $this->addressAdder->add($customer, clone $address);
        }
    }
}
