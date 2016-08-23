<?php

namespace PouleR\FacebookMessengerBundle\Tests\Service;

use phpmock\phpunit\PHPMock;
use PouleR\FacebookMessengerBundle\Service\CurlInterface;
use PouleR\FacebookMessengerBundle\Service\CurlService;

/**
 * Class FacebookMessengerServiceTest.
 */
class CurlServiceTest extends \PHPUnit_Framework_TestCase
{
    use PHPMock;

    /**
     * Test the CurlService by creating mocks for curl()
     */
    public function testCurlService()
    {
        $curlInit = $this->getFunctionMock('PouleR\FacebookMessengerBundle\Service', 'curl_init');
        $curlInit->expects($this->once())->willReturn(1);

        $curlOpt = $this->getFunctionMock('PouleR\FacebookMessengerBundle\Service', 'curl_setopt');
        $curlOpt->expects($this->exactly(8))
            ->withConsecutive(
                [1, CURLOPT_HTTPHEADER, array('Content-Type: application/json')],
                [1, CURLOPT_RETURNTRANSFER, true],
                [1, CURLOPT_HEADER, 0],
                [1, CURLOPT_TIMEOUT, 30],
                [1, CURLOPT_URL, 'http://www.google.com'],
                [1, CURLOPT_POST, 1],
                [1, CURLOPT_POSTFIELDS, 'body'],
                [1, CURLOPT_URL, 'http://www.facebook.com?client_id=unit&client_secret=test']
            );

        $curlExec = $this->getFunctionMock('PouleR\FacebookMessengerBundle\Service', 'curl_exec');
        $curlExec->expects($this->exactly(2))
            ->willReturnOnConsecutiveCalls('ok', 200);

        $curlClose = $this->getFunctionMock('PouleR\FacebookMessengerBundle\Service', 'curl_close');
        $curlClose->expects($this->once());

        $service = new CurlService();
        self::assertInstanceOf(CurlInterface::class, $service);

        $result = $service->post('http://www.google.com', 'body');
        self::assertEquals('ok', $result);

        $result = $service->get('http://www.facebook.com', array('client_id' => 'unit', 'client_secret' => 'test'));
        self::assertEquals(200, $result);
    }
}
