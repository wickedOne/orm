<?php

declare(strict_types=1);

namespace Doctrine\Tests\Models\AssociationClass;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="association_class_association")
 */
class AssociationClass
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Doctrine\Tests\Models\AssociationClass\ParentClass", inversedBy="associations")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false, onDelete="CASCADE")
     *
     * @var ParentClass
     */
    private $parent;

    /**
     * @ORM\OneToOne(targetEntity="Doctrine\Tests\Models\AssociationClass\ChildClass")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false, onDelete="CASCADE")
     *
     * @var ChildClass
     */
    private $child;

    public function __construct(ParentClass $parent, ChildClass $child)
    {
        $this->parent = $parent;
        $this->child  = $child;
    }
}
