<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Model\students;
use App\Repository\StudentRepository;

class ApiController extends AbstractController
{
    #[Route('/api/students', methods: ['GET'])]
    public function getCollection(StudentRepository $repository): Response
    {
        $students = $repository->findAll();

        return $this->json($students);
    }

    #[Route('/api/students/{id}', methods: ['GET'])]
    public function get(int $id, StudentRepository $repository): Response
    {
        $students = $repository->find($id);

        if(!$students)
        {
            throw $this->createNotFoundException("ID was not found!");
        }

        return $this->json($students);
    }
}