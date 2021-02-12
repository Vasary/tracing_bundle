<?php

namespace Vasary\TracingBundle\Tests\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

final class MockController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function index(): Response
    {
        $this->logger->info('Hello PHPUnit');

        return new Response();
    }
}
