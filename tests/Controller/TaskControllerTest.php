<?php

namespace Tests\App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testTasksListPageIsUp()
    {
        $client = static::createClient([], [
        'PHP_AUTH_USER' => 'test',
        'PHP_AUTH_PW' => 'test',
    ]);
        $client->request('GET', '/tasks');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testTaskCreatePageIsUp()
    {
        $client = static::createClient([], [
        'PHP_AUTH_USER' => 'test',
        'PHP_AUTH_PW' => 'test',
    ]);
        $client->request('GET', '/tasks/create');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testTaskEditPageIsUp()
    {
        $client = static::createClient([], [
        'PHP_AUTH_USER' => 'test',
        'PHP_AUTH_PW' => 'test',
    ]);
        $client->request('GET', '/tasks/16/edit');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testTaskToggle()
    {
        $client = static::createClient([], [
        'PHP_AUTH_USER' => 'test',
        'PHP_AUTH_PW' => 'test',
    ]);
        $client->request('GET', '/tasks/16/toggle');
        $crawler = $client->followRedirect();

        $this->assertGreaterThan(0, $crawler->filter('html:contains("La tâche test a bien été marquée comme faite")')->count());
    }

    public function testTaskDeleteIsUp()
    {
        $client = static::createClient([], [
        'PHP_AUTH_USER' => 'test',
        'PHP_AUTH_PW' => 'test',
    ]);
        $client->request('GET', '/tasks/17/delete');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testTaskCreate()
    {
        $client = static::createClient([], [
        'PHP_AUTH_USER' => 'test',
        'PHP_AUTH_PW' => 'test',
    ]);
        $crawler = $client->request('GET', '/tasks/create');

        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'test title';
        $form['task[content]'] = 'test content';

        $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertGreaterThan(0, $crawler->filter('html:contains("La tâche a été bien été ajoutée")')->count());
    }
}
