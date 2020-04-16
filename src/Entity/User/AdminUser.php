<?php

declare(strict_types=1);

namespace App\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\AdminUser as BaseAdminUser;
use Sylius\RbacPlugin\Entity\AdministrationRoleAwareInterface;
use Sylius\RbacPlugin\Entity\AdministrationRoleAwareTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_admin_user")
 */
class AdminUser extends BaseAdminUser implements AdministrationRoleAwareInterface
{
    use AdministrationRoleAwareTrait;
}
