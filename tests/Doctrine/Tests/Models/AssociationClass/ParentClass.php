<?php

declare(strict_types=1);

namespace Doctrine\Tests\Models\AssociationClass;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="association_class_parent")
 */
class ParentClass
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
     * @ORM\OneToMany(targetEntity="Doctrine\Tests\Models\AssociationClass\AssociationClass", mappedBy="parent", cascade={"persist"}, orphanRemoval=true)
     *
     * @var Collection<int, AssociationClass>
     */
    private $associations;

    public function __construct()
    {
        $this->associations = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function addChild(ChildClass $child): self
    {
        $this->associations->add(new AssociationClass($this, $child));

        return $this;
    }
}
