<?php

namespace Ligneus\ExceptionTrackerBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * @author Florian Weber <fweber@ligneus.de>
 */
class ExceptionListener
{
    /**
     * @var string
     */
    private $trackerEndpoint;

    /**
     * @var string
     */
    private $appKey;

    /**
     * @var string
     */
    private $environment;

    public function __construct($trackerEndpoint, $appKey, $environment)
    {
        $this->trackerEndpoint = $trackerEndpoint;
        $this->appKey = $appKey;
        $this->environment = $environment;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        if ($this->environment != 'prod') {
            return;
        }

        // You get the exception object from the received event
        $exception = $event->getException();

        $this->logException($exception);

        return;
    }

    protected function logException($exception)
    {
        $data['status'] = (method_exists($exception, 'getStatusCode')) ? $exception->getStatusCode() : 500;
        $data['title'] = '';
        $data['text'] = '';
        $data['appkey'] = $this->appKey;
        $data['message'] = $exception->getMessage();
        $data['class'] = get_class($exception);
        $data['trace'] = '';

        $this->postJson(json_encode($data));
    }

    /**
     * @param  string $json
     * @return string
     */
    protected function postJson($json)
    {
        $ch = curl_init($this->trackerEndpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: '.strlen($json), )
        );

        return curl_exec($ch);
    }
}
