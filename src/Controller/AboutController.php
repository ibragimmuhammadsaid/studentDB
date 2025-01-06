<?php

namespace App\Controller;

use App\Model\weather;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'app_about')]
    public function about(weather $weather,): Response
    {
        # About Text
        $about = "This is a student database! It is surely incomplete, and I am not sure it will ever be completed, as I lack a lot of data about students. I wish I could do it better, but not now. Thank You!";

        # Render
        return $this->render('about.html.twig', [
            'about' => $about,
            'weather' => $weather,
        ]);
    }
}
