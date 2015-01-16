<?php

namespace Ligneus\ExceptionTrackerBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\Debug\ExceptionHandler;

class ExceptionListener
{
    private $prevExceptionHandler;

    public function __construct()
    {
        // Set our handle method as fatal exception handler.
        // It is required to extend Symfony\Component\Debug\ExceptionHandler
        $this->prevExceptionHandler = set_exception_handler(array($this, 'handle'));
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getException();

        $this->logException($exception);
    }

    public function handle(\Exception $exception)
    {
        // Call our custom handler.
        $this->onFatalErrorException($exception);

        // Call exception handler that was overridden.
        // Or try to call parent::handle($exception)
        if (is_array($this->prevExceptionHandler) && $this->prevExceptionHandler[0] instanceof ExceptionHandler) {
            $this->prevExceptionHandler[0]->handle($exception);
        }
    }

    public function onFatalErrorException(\Exception $exception)
    {
        $this->logException($exception);
    }

    protected function logException($exception)
    {
        dump($exception);
    }

}
