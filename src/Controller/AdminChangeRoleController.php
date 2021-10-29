<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminChangeRoleController extends AbstractController
{
    #[Route('/admin/change-role/{id}/{checked}', name: 'change_role')]
    public function index($id, $checked, UserRepository $repo, EntityManagerInterface $manager): Response
    {
        $user = $repo->find($id);
        if ($checked == 1) {
            $user->addRole("ROLE_ADMIN");
        } else {
            $user->removeRole("ROLE_ADMIN");
        }
        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('admin_user');
    }
}
