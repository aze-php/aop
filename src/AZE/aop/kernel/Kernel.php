<?php
namespace AZE\aop\kernel;

use Go\Aop\Aspect;
use Go\Core\AspectKernel;
use Go\Core\AspectContainer;

/**
 * Application Aspect Kernel
 */
class Kernel extends AspectKernel
{
    private static $addedAspect = array();

    /**
     * Configure an AspectContainer with advisors, aspects and pointcuts
     *
     * @param AspectContainer $container
     *
     * @return void
     */
    protected function configureAop(AspectContainer $container)
    {
        $classes = forward_static_call_array(array('\AZE\aop\utils\ClassFinder','getClassesInNamespace'), array("AZE\\aop\\aspect"));
        foreach ($classes as $class) {
            $object = new $class;
            if ($object instanceof Aspect) {
                $container->registerAspect($object);
            }
        }

        foreach (self::$addedAspect as $aspect) {
            $container->registerAspect($aspect);
        }
    }

    public static function addAspect(Aspect $aspect)
    {
        self::$addedAspect[] = $aspect;
    }
}