<?php

namespace Kodo\DashboardBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Client;

class GeneralControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/dashboard/general/');

        $this->assertContains('Generals list', $client->getResponse()->getContent());
    }

}