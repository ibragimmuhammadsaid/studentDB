<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(
        StudentRepository $studentRepository
    ): Response {
        $students = $studentRepository->findAll();

        # Render
        return $this->render('main/homepage.html.twig', [
            'info' => $students
        ]);
    }
}