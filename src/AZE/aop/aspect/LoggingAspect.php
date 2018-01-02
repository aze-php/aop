<?php
namespace AZE\aop\aspect;

use AZE\core\configuration\Config;
use Go\Aop\Aspect;
use Go\Aop\Intercept\FunctionInvocation;
use Go\Aop\Intercept\Joinpoint;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\After;
use Go\Lang\Annotation\Before;
use Go\Lang\Annotation\Around;
use Go\Lang\Annotation\Pointcut;
use Go\Lang\Annotation\Execution;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggingAspect implements Aspect
{
    private $logger = null;
    public function __construct()
    {
        $this->logger = new Logger("log");
        $this->logger->pushHandler(new StreamHandler(Config::get()->logs->path . '/info.log', Logger::INFO));
    }

    /**
     * @param MethodInvocation $invocation
     *
     * @Before("@execution(AZE\aop\annotation\Loggable)")
     */
    public function beforeMethodExecution(MethodInvocation $invocation)
    {
        $obj = $invocation->getThis();
        $class = $obj === (object)$obj ? get_class($obj) : $obj;
        $this->logger->info("Executing " . $class.'->'.$invocation->getMethod()->name, $invocation->getArguments());
    }
}