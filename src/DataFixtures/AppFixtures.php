<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setPrenom("Rémi");
        $admin->setNom("Remy");
        $admin->setEmail("rr@g.com");
        $admin->setPassword($this->hasher->hashPassword($admin, "azerty"));
        $admin->setRoles(["ROLE_ADMIN"]);

        $manager->persist($admin);

        $utilisateur = new User();
        $utilisateur->setPrenom("John");
        $utilisateur->setNom("DOE");
        $utilisateur->setEmail("jd@g.com");
        $utilisateur->setPassword($this->hasher->hashPassword($utilisateur, "azerty"));

        $manager->persist($utilisateur);

        $manager->flush();
    }
}
