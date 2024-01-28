<?php

declare(strict_types=1);

namespace Doctrine\Tests\ORM\Functional\Ticket\AssociationClass;

use Doctrine\Tests\Models\AssociationClass\AssociationClass;
use Doctrine\Tests\Models\AssociationClass\ChildClass;
use Doctrine\Tests\Models\AssociationClass\ParentClass;
use Doctrine\Tests\OrmFunctionalTestCase;

use function count;
use function sprintf;
use function var_export;

class AssociationClassTest extends OrmFunctionalTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->createSchemaForModels(
            ParentClass::class,
            ChildClass::class,
            AssociationClass::class
        );
    }

    public function testUnitOfWorkWithRemoveAfterClear(): void
    {
        $parent      = new ParentClass();
        $firstChild  = new ChildClass();
        $secondChild = new ChildClass();

        $parent
            ->addChild($firstChild)
            ->addChild($secondChild);

        $this->_em->persist($firstChild);
        $this->_em->persist($secondChild);
        $this->_em->persist($parent);

        $this->_em->flush();
        $this->_em->clear();

        $parent      = $this->_em->find(ParentClass::class, $parent->getId());
        $firstChild  = $this->_em->find(ChildClass::class, $firstChild->getId());
        $secondChild = $this->_em->find(ChildClass::class, $secondChild->getId());

        $this->_em->remove($firstChild);
        $this->_em->remove($secondChild);
        $this->_em->remove($parent);

        $this->_em->flush();

        foreach ($this->_em->getUnitOfWork()->getIdentityMap() as $classString => $object) {
            self::assertCount(0, $object, sprintf('%s contains %d objects: %s', $classString, count($object), var_export($object)));
        }
    }
}
