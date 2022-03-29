<?php

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTest extends WebTestCase
{
    public function testGetUsername()
    {
        $user = new User();
        $user->setUsername('John');
        $this->assertEquals($user->getUsername(), 'John');
    }

    public function testGetRole()
    {
        $user = new User();
        $user->setRole('ROLE_USER');
        $this->assertEquals($user->getRole(), 'ROLE_USER');
        $this->assertEquals($user->getRoles(), ['ROLE_USER']);
    }

    public function testGetEmail()
    {
        $user = new User();
        $user->setEmail('test@test.local');
        $this->assertEquals($user->getEmail(), 'test@test.local');
    }

    public function testGetPassword()
    {
        $user = new User();

        $user->setPassword('test');
        $this->assertEquals($user->getPassword(), 'test');
    }
}
