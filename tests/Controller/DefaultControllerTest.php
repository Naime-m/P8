<?php

namespace Tests\App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHomepageIsUp()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('test@local.com');
        $client->loginUser($testUser);
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
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('test@local.com');
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/');

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Bienvenue sur Todo List")')->count());
    }
}
