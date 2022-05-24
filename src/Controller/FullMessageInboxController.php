<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Regist;
use App\Form\NewMessage2Type;
use App\Repository\RegistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class FullMessageInboxController extends AbstractController
{
    #[Route('/full/message/inbox/{regist}', name: 'full_message_inbox', defaults: ['ckUser' => '1'])]
    public function index($regist, $ckUser, RegistRepository $registRepository, ManagerRegistry $doctrine, Request $request): Response
    {

        // dump($regist, $ckUser, $_GET['ckUser']);
        $registV2 = $registRepository->find($regist);
        $registV2->setIsread(true);
        $entityManager = $doctrine->getManager();
        dump($registV2);
        $user = $this->getUser();
        if ($user->getID() == $_GET['ckUser']) {
            $entityManager->persist($registV2);
            $entityManager->flush();

            $message= new Message();
            $form = $this->createForm(NewMessage2Type::class, $message);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $message->setSender($this->getUser());
                $message->setSubject("RE: ".$registV2->getMessage()->getSubject());
                $message->setBody($form->get('body')->getData());

                $entityManager->persist($message);

                $newRegist = new Regist;
                $newRegist->setMessage($message);
                $newRegist->setIsread(false);
                
                $newRegist->setReciver($registV2->getMessage()->getSender());
                $entityManager->persist($newRegist);
                $entityManager->flush();
                return  $this->redirectToRoute('inbox');


            }
            return $this->render('full_message_inbox/index.html.twig', [
                'controller_name' => 'FullMessageInboxController',
                'regist' => $registV2,
                'ckUserId' => $_GET['ckUser'],
                'messageForm' => $form->createView(),
            ]);
        } else {
            return  $this->redirectToRoute('inbox');
        }
        // $entityManager->persist($registV2);
        // $entityManager->flush();
        // return $this->render('full_message_inbox/index.html.twig', [
        //     'controller_name' => 'FullMessageInboxController',
        //     'regist'=> $registV2,
        //     'ckUserId'=> $_GET['ckUser']
        // ]);
    }
}
