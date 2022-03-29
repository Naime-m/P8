<?php

use App\Entity\Task;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskTest extends WebTestCase
{
    public function testGetDate()
    {
        $task = new Task();
        $date = '2022-03-03 18:53:53';
        $task->setCreatedAt($date);
        $this->assertEquals($task->getCreatedAt(), '2022-03-03 18:53:53');
    }

    public function testGetAuthor()
    {
        $task = new Task();
        $user = new User();
        $task->setAuthor($user);
        $this->assertEquals($task->getAuthor(), $user);
    }

    public function testGetContent()
    {
        $task = new Task();
        $task->setContent('test');
        $this->assertEquals($task->getContent(), 'test');
    }

    public function testGetIsDone()
    {
        $task = new Task();
        $task->setIsDone(true);
        $this->assertEquals($task->getIsDone(), true);
    }

    public function testGetTitle()
    {
        $task = new Task();
        $task->setTitle('test');
        $this->assertEquals($task->getTitle(), 'test');
    }

    public function testCreateTask()
    {
        $task = new Task();
        $task->setCreatedAt('2022-03-03 18:53:53');
        $task->setAuthor(new User());
        $task->setContent('Content');
        $task->setIsDone(false);
        $task->setTitle('A title');

        return $task;
        $this->assertEquals($task, $this->task);
    }
}
