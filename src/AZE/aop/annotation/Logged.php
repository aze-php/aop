<?php
namespace AZE\aop\annotation;

use Doctrine\Common\Annotations\Annotation;

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