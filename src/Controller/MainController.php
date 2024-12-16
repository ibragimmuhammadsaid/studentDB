<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/')]
    public function homepage(): Response
    {
        $myName = 'Muhammad Said';

        $studentInfo = ['ID' => 220299,
        'Year' => 3,
        'Status' => 'studying'];

        return $this->render('main/homepage.html.twig', [
            'name' => $myName,
            'studentInfo' => $studentInfo,
        ]);
    }
}
