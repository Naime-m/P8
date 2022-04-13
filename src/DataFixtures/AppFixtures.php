<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('test');
        $password = $this->hasher->hashPassword($user, 'pass');
        $user->setPassword($password);
        $user->setEmail('test@local.com');
        $user->setRole('ROLE_USER');

        $manager->persist($user);

        $admin = new User();
        $admin->setUsername('testadmin');
        $password = $this->hasher->hashPassword($admin, 'passadmin');
        $admin->setPassword($password);
        $admin->setEmail('testadmin@local.com');
        $admin->setRole('ROLE_ADMIN');

        $manager->persist($admin);

        $usertest = new User();
        $usertest->setUsername('testuser');
        $password = $this->hasher->hashPassword($usertest, 'pass');
        $usertest->setPassword($password);
        $usertest->setEmail('testuser@local.com');
        $usertest->setRole('ROLE_USER');

        $manager->persist($usertest);

        for ($i = 1; $i < 5; ++$i) {
            $task = new Task();
            $task->setTitle('Tâche '.$i);
            $task->setContent('Contenu de la tâche '.$i);
            $task->setIsDone(false);
            $task->setCreatedAt(new DateTime());
            $task->setAuthor($user);
            $manager->persist($task);
        }

        for ($i = 5; $i < 10; ++$i) {
            $taskdone = new Task();
            $taskdone->setTitle('Tâche '.$i);
            $taskdone->setContent('Contenu de la tâche '.$i);
            $taskdone->setIsDone(true);
            $taskdone->setCreatedAt(new DateTime());
            $taskdone->setAuthor($user);
            $manager->persist($taskdone);
        }

        for ($i = 10; $i < 15; ++$i) {
            $taskadmin = new Task();
            $taskadmin->setTitle('Tâche '.$i);
            $taskadmin->setContent('Contenu de la tâche '.$i);
            $taskadmin->setIsDone(false);
            $taskadmin->setCreatedAt(new DateTime());
            $taskadmin->setAuthor($admin);
            $manager->persist($taskadmin);
        }

        for ($i = 15; $i < 20; ++$i) {
            $taskadmindone = new Task();
            $taskadmindone->setTitle('Tâche '.$i);
            $taskadmindone->setContent('Contenu de la tâche '.$i);
            $taskadmindone->setIsDone(true);
            $taskadmindone->setCreatedAt(new DateTime());
            $taskadmindone->setAuthor($admin);
            $manager->persist($taskadmindone);
        }

        for ($i = 20; $i < 25; ++$i) {
            $taskauthornull = new Task();
            $taskauthornull->setTitle('Tâche '.$i);
            $taskauthornull->setContent('Contenu de la tâche '.$i);
            $taskauthornull->setIsDone(true);
            $taskauthornull->setCreatedAt(new DateTime());
            $taskauthornull->setAuthor(null);
            $manager->persist($taskauthornull);
        }

        $manager->flush();
    }
}
