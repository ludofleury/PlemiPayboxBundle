<?php

/*
 * This file is part of the PlemiPayboxBundle.
 *
 * (c) Ludovic Fleury <ludovic.fleury@plemi.org>
 * (c) David Guyon <david.guyon@plemi.org>
 * (c) Erwann Mest <erwann.mest@plemi.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plemi\Bundle\PayboxBundle\Tests\Transport;

use Plemi\Bundle\PayboxBundle\Transport\ShellTransport;

/**
 * Test class for ShellTransport
 */
class ShellTransportTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->object = new ShellTransport();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testCall()
    {
        $this->object->setEndpoint('/hello/world/hey.cgi');
        $method = new \ReflectionMethod('\Plemi\Bundle\PayboxBundle\Transport\ShellTransport', 'call');
        $method->setAccessible(TRUE);
        $response = $method->invoke($this->object, array());
        $this->assertTrue(is_string($response));
    }

    public function testCallEmpty()
    {
        $curl = new mockShellTransport();
        $this->assertEquals($curl->call(array()), '');
    }

}

class mockShellTransport extends ShellTransport
{

    public function call(array $datas)
    {
        return '';
    }

}
