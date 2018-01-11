<?php
namespace AZE\aop\annotation\utils;

use Doctrine\Common\Annotations\Annotation;

/**
 * Table annotation
 *
 * @Annotation
 *
 * @Target({"CLASS"})
 */
class StaticInit extends Annotation
{
    public $aze = null;
}