<?php
namespace AZE\aop\aspect\utils;

use Go\Aop\Aspect;
use Go\Aop\Framework\StaticInitializationJoinpoint;
use Go\Lang\Annotation\Before;

class StaticInitAspect implements Aspect
{

    /**
     * @Before("@within(AZE\aop\annotation\utils\StaticInit)")
     */
    public function executeStaticInit($joinpoint)
    {
        if ($joinpoint instanceof StaticInitializationJoinpoint) {
            if ($joinpoint->getStaticPart()->hasMethod("staticInit")) {
                $method = $joinpoint->getStaticPart()->getMethod("staticInit");
                if ($method->isStatic()) {
                    $method->invoke(null);
                }
            }
        }
    }
}