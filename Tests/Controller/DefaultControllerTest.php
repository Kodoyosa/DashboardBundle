<?php

namespace Kodo\DashboardBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/dashboard/');

        $this->assertContains('Dashboard', $client->getResponse()->getContent());

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }

    public function testSidemenu()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/dashboard/' );

        $this->assertGreaterThan(0, $crawler->filter('nav#sidemenu')->count());

    }

}
