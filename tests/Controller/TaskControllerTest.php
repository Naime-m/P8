<?php

namespace Tests\App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testTasksListPageIsUp()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('test@local.com');
        $client->loginUser($testUser);
        $client->request('GET', '/tasks');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testTaskCreatePageIsUp()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('test@local.com');
        $client->loginUser($testUser);
        $client->request('GET', '/tasks/create');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testTaskEditPageIsUp()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('test@local.com');
        $client->loginUser($testUser);
        $client->request('GET', '/tasks/16/edit');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testTaskToggle()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('test@local.com');
        $client->loginUser($testUser);
        $client->request('GET', '/tasks/1/toggle');
        $crawler = $client->followRedirect();

        $this->assertGreaterThan(0, $crawler->filter('html:contains("La tâche Tâche 1 a bien été marquée comme faite")')->count());
    }

    public function testTaskDeleteIsUp()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('test@local.com');
        $client->loginUser($testUser);
        $client->request('GET', '/tasks/1/delete');
        $crawler = $client->followRedirect();

        $this->assertGreaterThan(0, $crawler->filter('html:contains(" Superbe ! La tâche a bien été supprimée")')->count());
    }

    public function testTaskCreate()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('test@local.com');
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/tasks/create');

        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'test title';
        $form['task[content]'] = 'test content';

        $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertGreaterThan(0, $crawler->filter('html:contains("La tâche a été bien été ajoutée")')->count());
    }
}
