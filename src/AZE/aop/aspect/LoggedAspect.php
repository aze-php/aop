<?php
namespace AZE\aop\aspect;

use AZE\core\Session;
use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;
use Go\Lang\Annotation\Execution;

class LoggedAspect implements Aspect
{
    /**
     * @param MethodInvocation $invocation
     *
     * @Before("@execution(AZE\aop\annotation\Logged)")
     */
    public function beforeMethodExecution(MethodInvocation $invocation)
    {
        $right = $invocation->getMethod()->getAnnotation(Logged::class)->right;

        if (empty(Session::instance()->get('user')) || !in_array(Session::instance()->get('user'), $right)) {
            header('location:/login/?required=' . json_encode($right));
        }
    }
}