<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\EventListener\Core\Customer;

use Doctrine\ORM\EntityManagerInterface;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Customer\Context\CustomerContextInterface;
use Webmozart\Assert\Assert;

final class CheckOrderCustomerListener implements CheckOrderCustomerListenerInterface
{
    /** @var CustomerContextInterface */
    private $customerContext;

    /** @var EntityManagerInterface */
    private $em;

    public function __construct(CustomerContextInterface $customerContext, EntityManagerInterface $em)
    {
        $this->customerContext = $customerContext;
        $this->em = $em;
    }

    public function checkCustomer(ResourceControllerEvent $event): void
    {
        $order = $event->getSubject();

        /** @var OrderInterface $order */
        Assert::isInstanceOf($order, OrderInterface::class);

        /** @var CustomerInterface $customer */
        $customer = $order->getCustomer();
        if (null === $customer) {
            $customer = $this->customerContext->getCustomer();
            if ($customer) {
                $order->setCustomer($customer);
                $this->em->persist($order);
                $this->em->flush();
            }
        }
        if (null === $customer || null === $customer->getUser()) {
            return;
        }

        return;
    }
}
