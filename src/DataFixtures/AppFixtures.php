<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Libelle;
use App\Entity\Produit;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class AppFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $tableauImage = ["boat1.jpg", "boat2.jpg", "boat3.jpg", "boat4.jpg", "boat5.jpg", "boat6.jpg", "boat7.jpg", "boat8.jpg", "boat9.jpg", "boat10.jpg", "boat11.jpg", "boat12.jpg", "boat13.jpg", "boat14.jpg", "boat15.jpg"];


        // ----------------------------CREATION USERS----------------------

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


        // --------------------------CREATION CATEGORIE----------------------------

        $categorie = new Categorie();
        $categorie->setType('voilier');
        $manager->persist($categorie);

        $categorie = new Categorie();
        $categorie->setType('semi-rigide');
        $manager->persist($categorie);

        $categorie = new Categorie();
        $categorie->setType('vedette');
        $manager->persist($categorie);


        // ----------------------création des libellés ----------------------

        $libellePromotion = new Libelle();
        $libellePromotion->setNom("Promo");
        $libellePromotion->setCouleur("FF0000");

        $manager->persist($libellePromotion);

        $libelleEco = new Libelle();
        $libelleEco->setNom("Eco-responsable");
        $libelleEco->setCouleur("57CC57");

        $manager->persist($libelleEco);

        $libelleBestSeller = new Libelle();
        $libelleBestSeller->setNom("Best seller");
        $libelleBestSeller->setCouleur("FF8800");

        $manager->persist($libelleBestSeller);

        $listeLibelle = [$libellePromotion, $libelleEco, $libelleBestSeller];

        // ----------------------------CREATION PRODUIT-------------------------------

        for ($i = 0; $i < 18; $i++) {

            $produit = new Produit();
            $produit->setNom('bateau "' . $faker->sentence(3) . '"')
                ->setDescription($faker->text(1000))
                ->setPrix($faker->randomFloat(2, 10000, 250000))
                ->setPhoto($faker->randomElement($tableauImage))
                ->setCategorie($categorie);

            $nombreDeLibelle = $faker->numberBetween(0, 3);

            for ($j = 0; $j < $nombreDeLibelle; $j++) {
                $libellePrisAuHasard = $faker->randomElement($listeLibelle);
                $produit->addLibelle($libellePrisAuHasard);
            }

            $manager->persist($produit);
        }

        $manager->flush();
    }
}
