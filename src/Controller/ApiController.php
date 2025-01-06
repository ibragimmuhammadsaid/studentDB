<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Model\Student;
use App\Repository\StudentRepository;

class ApiController extends AbstractController
{
    #[Route('/api/students', methods: ['GET'])]
    public function getCollection(StudentRepository $repository): Response
    {
        $student = $repository->findAll();

        return $this->json($student);
    }

    #[Route('/api/students/{id}', methods: ['GET'])]
    public function get(int $id, StudentRepository $repository): Response
    {
        $student = $repository->find($id);

        if(!$student)
        {
            throw $this->createNotFoundException(message: "ID was not found!");
        }

        return $this->json($student);
    }
}