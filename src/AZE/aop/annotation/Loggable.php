<?php
namespace AZE\aop\annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * Loggable marker
 *
 * @Annotation
 *
 * @Target("METHOD")
 */
class Loggable extends Annotation
{
}