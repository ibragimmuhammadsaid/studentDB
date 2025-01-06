<?php

namespace App\Controller;

use App\Model\Weather;
use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Enum\studentStatusEnum;
use App\Form\StudentType;

class StudentController extends AbstractController
{
    #[Route('/student/{id}', name: 'students_show')]
    public function show(
        EntityManagerInterface $entityManager,
        int $id,
        Weather $weather,
        Request $request,
    ) {
        $student = $entityManager->getRepository(Student::class)->find($id);

        # Student Deletion Button
        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => false])
            ->setMethod('POST')
            ->getForm();
        $form->handleRequest($request);

        # Deletion Form Check
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->remove($student);
            $entityManager->flush();

            return $this->redirectToRoute('app_homepage');
        }

        # Render
        return $this->render('show.html.twig', [
            'student' => $student,
            'weather' => $weather,
            'form' => $form,
        ]);
    }

    #[Route('/student-create', name: 'create_student')]
    public function createStudent(
        EntityManagerInterface $entityManager,
        Weather $weather,
        Request $request,
    ): Response {
        # Object initialization and Form
        $student = new Student();

        $form = $this->createForm(StudentType::class, $student);

        # Pattern requires TextType, but I invert back to int just in case
        $id = (int) $form->get('id')->getData();
        $year = (int) $form->get('year')->getData();

        # Form Submission and Redirection
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('app_homepage');
        }

        # Render
        return $this->render('createstudent.html.twig', [
            'weather' => $weather,
            'form' => $form,
        ]);
    }

    #[Route('/student/{id}/edit', name: 'edit_student')]
    public function editStudent(
        EntityManagerInterface $entityManager,
        Weather $weather,
        Request $request,
        int $id,
    ): Response {
        $student = $entityManager->getRepository(Student::class)->find($id);

        $form = $this->createForm(StudentType::class, $student);

        # Pattern requires TextType, but I invert back to int just in case
        $id = (int) $form->get('id')->getData();
        $year = (int) $form->get('year')->getData();

        # Form Submission and Redirection
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('app_homepage');
        }

        # Render
        return $this->render('editstudent.html.twig', [
            'weather' => $weather,
            'form' => $form,
            'student' => $student,
        ]);
    }
}