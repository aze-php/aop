<?php
namespace AZE\aop\aspect\db;

use Go\Aop\Aspect;
use Go\Aop\Framework\StaticInitializationJoinpoint;
use Go\Aop\Intercept\Invocation;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\After;
use Go\Lang\Annotation\Around;
use Go\Lang\Annotation\Before;
use Go\Lang\Annotation\Execution;
use Go\Lang\Annotation\Pointcut;
use AZE\aop\annotation\db\Table;
use Go\Aop\Intercept\ConstructorInvocation;

class TableAspect implements Aspect
{

    /**
     * @param MethodInvocation $invocation
     *
     * @Before("@within(AZE\aop\annotation\db\Table)")
     */
    public function defineDbTableProperty(StaticInitializationJoinpoint $joinpoint)
    {
        if ($joinpoint instanceof StaticInitializationJoinpoint) {
//            var_dump();
            $name = $joinpoint->getStaticPart()->name;
            $name::$AZETableName = null;
//            if ($joinpoint->getStaticPart()->hasMethod("staticInit")) {
//                $method = $joinpoint->getStaticPart()->getMethod("staticInit");
//                if ($method->isStatic()) {
//                    $method->invoke(null);
//                }
//            }
        }
//        $reflectedClass = new \ReflectionClass($joinpoint->getStaticPart()->name);
//        var_dump($reflectedClass->getStaticProperties());
//        $obj = $reflectedClass->newInstance();
//        $obj->test = function(){ return "aze"; };

//        var_dump($obj);
//        var_dump($obj->test());

        echo "=============================================================\n";
        echo "===================          JOINPOINT          =============\n";
        echo "=============================================================\n";
        var_dump($joinpoint);
        echo "=============================================================\n";
        echo "===================        getStaticPart        =============\n";
        echo "=============================================================\n";
        var_dump($joinpoint->getStaticPart());
        echo "=============================================================\n";
        echo "===================             proceed         =============\n";
        echo "=============================================================\n";
        var_dump($joinpoint->proceed());
        echo "=============================================================\n";
        echo "===================             getThis         =============\n";
        echo "=============================================================\n";
        var_dump($joinpoint->getThis());
        echo "=============================================================\n";
        echo "=============================================================\n";
        echo "=============================================================\n";

//        var_dump($this);
//        var_dump($joinpoint->getStaticPart()->getStaticProperties());
//        $reflectedClass->setStaticPropertyValue('tableName', "aze");
//        var_dump($joinpoint->getThis());
//        var_dump($joinpoint);
//        if ($invocation->getMethod()->name === "getTableName") {
//            return "azeazeaze";
////            return $this->
//        }
//        $right = $invocation->getMethod()->getAnnotation(Logged::class)->right;
//
//        if (empty(Session::instance()->get('user')) || !in_array(Session::instance()->get('user'), $right)) {
//            header('location:/login/?required=' . json_encode($right));
//        }
    }
}