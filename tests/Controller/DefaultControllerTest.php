<?php

namespace Tests\App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    public function testHomepageIsUp()
    {
        $client = static::createClient(array(), array(
        'PHP_AUTH_USER' => 'test',
        'PHP_AUTH_PW'   => 'test',
    ));
    $client->request('GET', '/');
    $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testHomepageRedirectIfNoUser()
    {
        $client = static::createClient();
    $client->request('GET', '/');
    $this->assertTrue($client->getResponse()->isRedirect());
    }
    
    
    public function testHomepageShow()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'test',
            'PHP_AUTH_PW'   => 'test',
        ));

       $crawler = $client->request('GET', '/');

       $this->assertGreaterThan(0, $crawler->filter('html:contains("Bienvenue sur Todo List")')->count());
    }
}
