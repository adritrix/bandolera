<?php

namespace App\Controller;

use App\Repository\RegistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;





class FullMessageInboxController extends AbstractController
{
    #[Route('/full/message/inbox/{regist}', name: 'full_message_inbox', defaults: ['ckUser' => '1'] )]
    public function index($regist, $ckUser, RegistRepository $registRepository, ManagerRegistry $doctrine ): Response
    {

        dump($regist,$ckUser,$_GET['ckUser']);
        $registV2=$registRepository->find($regist);
        $registV2->setIsread(true);
        $entityManager = $doctrine->getManager();
        dump($registV2);

        $entityManager->persist($registV2);
        $entityManager->flush();
        return $this->render('full_message_inbox/index.html.twig', [
            'controller_name' => 'FullMessageInboxController',
            'regist'=> $registV2,
            'ckUserId'=> $_GET['ckUser']
        ]);
    }
}
