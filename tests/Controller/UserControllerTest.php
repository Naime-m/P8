<?php

namespace Tests\App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testLoginPageIsUp()
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testUserCreatePageIsUp()
    {
        $client = static::createClient();
        $client->request('GET', '/users/create');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testUserListPageIsUp()
    {
        $client = static::createClient([], [
        'PHP_AUTH_USER' => 'testadmin',
        'PHP_AUTH_PW' => 'test',
    ]);
        $client->request('GET', '/users');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testUserEditIsUp()
    {
        $client = static::createClient([], [
        'PHP_AUTH_USER' => 'testadmin',
        'PHP_AUTH_PW' => 'test',
    ]);
        $client->request('GET', '/users/1/edit');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testUserCreate()
    {
        $client = static::createClient([], [
        'PHP_AUTH_USER' => 'test',
        'PHP_AUTH_PW' => 'test',
    ]);
        $crawler = $client->request('GET', '/users/create');

        $form = $crawler->selectButton('Ajouter')->form();
        $form['user[username]'] = 'John Doe';
        $form['user[password][first]'] = 'test';
        $form['user[password][second]'] = 'test';
        $form['user[email]'] = 'johndoe@gmail.local';
        $form['user[role]'] = 'ROLE_ADMIN';
        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertGreaterThan(0, $crawler->filter('html:contains("L\'utilisateur a bien été ajouté")')->count());
    }
}
