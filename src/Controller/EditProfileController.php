<?php

namespace App\Controller;

use App\Form\EditProfileType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditProfileController extends AbstractController
{
    #[Route('/edit/profile', name: 'edit_profile')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserRepository $ur): Response
    {

        $yo =  $this->getUser();
        $form = $this->createForm(EditProfileType::class, $yo);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $yo->setFirtsname($form->get('firtsname')->getData());
            $yo->setSecondname($form->get('secondname')->getData());
            $yo->setEmail($form->get('email')->getData());
            $yo->setAddress($form->get('address')->getData());
            $yo->setAge($form->get('age')->getData());
            $entityManager->persist($yo);
            $entityManager->flush();
        }
        return $this->render('edit_profile/index.html.twig', [
            'controller_name' => 'EditProfileController',
            'profileForm' => $form->createView(),
        ]);
    }
}
