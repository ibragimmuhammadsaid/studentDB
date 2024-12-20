<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\StudentRepository;

class StudentsController extends AbstractController
{
    #[Route('/students/{id}', name: 'students_show')]
    public function show(int $id, StudentRepository $repository): Response
    {
        $student = $repository->find($id);

        return $this->render('show.html.twig', [
            'student' => $student
        ]);
    }
}