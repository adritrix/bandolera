<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Message;
use App\Entity\Regist;
use App\Form\NewMessageType;
use App\Repository\MessageRepository;
use App\Repository\RegistRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewMessageController extends AbstractController
{
    #[Route('/new/message', name: 'new_message')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserRepository $ur): Response
    {
        $usersList=$ur->findAll();
        
        $message = new Message();
        $form = $this->createForm(NewMessageType::class, $message);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // dump($_POST['posibleRecivers']);

            $message->setSender($this->getUser());
            $message->setSubject($form->get('subject')->getData());
            $message->setBody($form->get('body')->getData());
            // dump($message);


            $entityManager->persist($message);
            // $var1 = [$form->get('sender')->getData(), $this->getUser()];
            $var1 = $_POST['posibleRecivers'];
            // dump($var1);
            for ($i = 0; $i < count($var1); $i++) {
                $regist = new Regist;
                $regist->setMessage($message);
                $regist->setIsread(false);
                
                $regist->setReciver($ur->find($var1[$i]));
                $entityManager->persist($regist);
                $entityManager->flush();

            }
            return  $this->redirectToRoute('inbox');

            // $regist = new Regist;
            // $regist->setMessage($message);
            // $regist->setIsread(false);
            // $regist->setReciver($ur->find(13));
            // $regist->setReciver($form->get('sender')->getData());
            // $entityManager->persist($regist);

            // dump($request);

            // dump($form->get('sender')->getData());
            // $entityManager->flush();

            // // generate a signed url and email it to the user
            // $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            //     (new TemplatedEmail())
            //         ->from(new Address('maltratoerf.n@gmail.com', 'MaltratoNavarro'))
            //         ->to($user->getEmail())
            //         ->subject('Please Confirm your Email')
            //         ->htmlTemplate('registration/confirmation_email.html.twig')
            // );
            // // do anything else you need here, like send an email

            // return $userAuthenticator->authenticateUser(
            //     $user,
            //     $authenticator,
            //     $request
            // );
        }


        return $this->render('new_message/index.html.twig', [
            'controller_name' => 'NewMessageController',
            'messageForm' => $form->createView(),
            'usersList' => $usersList,
        ]);
    }
}
