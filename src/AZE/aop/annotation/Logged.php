<?php
namespace AZE\aop\annotation;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Logged marker
 *
 * @Annotation
 *
 * @Target({"CLASS","METHOD"})
 */
class Logged extends Annotation
{
    /**
     * @var array
     */
    public $right = array();
}