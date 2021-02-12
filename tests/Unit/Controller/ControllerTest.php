<?php

namespace Vasary\TracingBundle\Tests\Unit\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function requestHeaders(): void
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
    public function loggerRecords(): void
    {
        $client = static::createClient(['environment' => 'test']);
        $logger = $client->getKernel()->getContainer()->get('handler.test');

        $client->request('GET', '/');

        self::assertTrue($logger->hasInfoThatMatches('/Hello PHPUnit/'));
        self::assertTrue($logger->hasInfoThatMatches('/^Entrypoint:\s\[.*\]\s.+/'));
        self::assertTrue($logger->hasInfoThatMatches('/^Request:\s.*/'));
        self::assertTrue($logger->hasInfoThatMatches('/^Outgoing response:\s.*/'));

        self::assertGreaterThan(0, count($logger->getRecords()));
        self::assertArrayHasKey('extra', $logger->getRecords()[0]);
        self::assertArrayHasKey('key', $logger->getRecords()[0]['extra']);
        self::assertArrayHasKey('application', $logger->getRecords()[0]['extra']);
        self::assertArrayHasKey('x-trace-id', $logger->getRecords()[0]['extra']);

        self::assertEquals('change_me', $logger->getRecords()[0]['extra']['application']);
        self::assertEquals('value', $logger->getRecords()[0]['extra']['key']);
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
