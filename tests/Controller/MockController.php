<?php

namespace Vasary\TracingBundle\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;

final class MockController
{
    public function index(): Response
    {
        return new Response();
    }
}
