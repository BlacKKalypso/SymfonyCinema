<?php

namespace App\Controller;

use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    /**
     * @Route("/room", name="room")
     */
    public function index(RoomRepository $roomRepository)
    {
        $rooms = $roomRepository->findAll();
        return $this->render('room/index.html.twig', [
            'rooms' => $rooms,
        ]);
    }
}
