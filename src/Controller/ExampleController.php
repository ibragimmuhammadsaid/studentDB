<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExampleController extends AbstractController
{
    #[Route('/example', name: 'app_example')]
    public function show(): Response
    {
        

        return $this->render('example.html.twig',[
            
        ]);
    }
}