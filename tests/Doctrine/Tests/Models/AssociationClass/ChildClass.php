<?php

declare(strict_types=1);

namespace Doctrine\Tests\Models\AssociationClass;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="association_class_children")
 */
class ChildClass
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     *
     * @var int
     */
    private $id;

    public function getId(): int
    {
        return $this->id;
    }
}
