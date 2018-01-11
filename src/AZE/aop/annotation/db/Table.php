<?php
namespace AZE\aop\annotation\db;

use Doctrine\Common\Annotations\Annotation;

/**
 * Table annotation
 *
 * @Annotation
 *
 * @Target({"CLASS"})
 */
class Table extends Annotation
{
    /**
     * @var string Name of the table
     */
    public $name = "";
}