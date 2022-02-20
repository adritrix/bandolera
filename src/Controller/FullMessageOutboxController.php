<?php

namespace App\Controller;

use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FullMessageOutboxController extends AbstractController
{
    #[Route('/full/message/outbox/{message_id}', name: 'full_message_outbox')]
    public function index($message_id,MessageRepository $messageRepository): Response
    {
        $message=$messageRepository->find($message_id);
        return $this->render('full_message_outbox/index.html.twig', [
            'controller_name' => 'FullMessageOutboxController',
            'message'=> $message
        ]);
    }
}
