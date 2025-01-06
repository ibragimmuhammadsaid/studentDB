<?php

namespace App\Controller;

use App\Model\Weather;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ContactController extends AbstractController
{
    #[Route('/contacts', name: 'app_contacts')]
    public function contactInfo(Weather $weather): Response
    {
        # Contact Info
        $mobileNumber = '+998 97 701 66 12';
        $email = 'muhammadsaid.ibragim2004@gmail.com';
        $hoursOfWork = '14:00-20:00 Monday-Friday';

        # Render
        return $this->render('contacts.html.twig', [
            'mobile' => $mobileNumber,
            'email' => $email,
            'hours' => $hoursOfWork,
            'weather' => $weather,
        ]);
    }
}