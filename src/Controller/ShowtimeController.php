<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShowtimeController extends AbstractController
{
    /**
     * @Route("/showtime", name="showtime")
     */
    public function index()
    {
        return $this->render('showtime/index.html.twig', [
            'controller_name' => 'ShowtimeController',
        ]);
    }
}
