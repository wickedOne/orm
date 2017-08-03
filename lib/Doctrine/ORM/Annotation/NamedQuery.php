<?php

declare(strict_types=1);

namespace Doctrine\ORM\Annotation;

/**
 * @Annotation
 * @Target("ANNOTATION")
 */
final class NamedQuery implements Annotation
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $query;
}
