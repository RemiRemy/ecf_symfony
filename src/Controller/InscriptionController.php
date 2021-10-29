<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'inscription')]
    public function inscription(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();
        $formulaire = $this->createFormBuilder($user)
            ->add(
                'nom',
                null,
                [
                    'attr' => [
                        'placeholder' => 'Votre nom',
                    ],
                ]
            )
            ->add(
                'prenom',
                null,
                [
                    'attr' => [
                        'placeholder' => 'Votre prenom',
                    ],
                ]
            )
            ->add(
                'email',
                null,
                [
                    'attr' => [
                        'placeholder' => 'Votre e-mail',
                    ],
                ]
            )
            ->add(
                'password',
                PasswordType::class,
                [
                    'attr' => [
                        'placeholder' => 'Votre password',
                    ],
                ]
            )
            ->add(
                'save',
                SubmitType::class,
                [
                    'label' => 'Enregistrer',
                ]
            )
            ->getForm();

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            // Penser a cripter le mot de passe 
            $motDePasseEnClair = $user->getPassword();
            $motDePasseCrypte = $hasher->hashPassword($user, $motDePasseEnClair);
            $user->setPassword($motDePasseCrypte);

            $manager->persist($user);
            $manager->flush();
            return $this->redirect('/');
        }






        $vueFormulaire = $formulaire->createView();



        return $this->render('inscription/index.html.twig', [
            'produit' => $user,
            'vueFormulaire' => $vueFormulaire
        ]);
    }
}
