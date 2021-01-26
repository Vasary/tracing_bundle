<?php

namespace Vasary\TracingBundle\Tests\Unit\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function default(): void
    {
        $client = static::createClient(['environment' => 'test']);

        $client->request('GET', '/');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->headers->has('x-trace-id'));
    }

    /**
     * @test
     */
    public function setTraceId(): void
    {
        $customTraceIdValue = 'my_custom_trace';

        $client = static::createClient(['environment' => 'test']);

        $client->setServerParameter('HTTP_X-TRACE-ID', $customTraceIdValue);
        $client->request('GET', '/');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->headers->has('x-trace-id'));
        $this->assertEquals($customTraceIdValue, $response->headers->get('x-trace-id'));
    }
}
