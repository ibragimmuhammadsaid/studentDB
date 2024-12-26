<?php

namespace App\Controller;

use App\Model\weather;
use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Enum\studentStatusEnum;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

class StudentController extends AbstractController
{
    #[Route('/student/{id}', name: 'students_show')]
    public function show(
        EntityManagerInterface $entityManager,
        int $id,
        weather $weather,
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
        weather $weather,
        Request $request,
    ): Response {
        # Object init and Form
        $student = new Student();
        $form = $this->createFormBuilder($student)
            ->add('name', TextType::class)
            ->add('id', TextType::class)
            ->add('year', TextType::class)
            ->add('status', EnumType::class, ['class' => studentStatusEnum::class])
            ->add('submit', SubmitType::class)
            ->getForm();

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

    #[Route('/student/{id}/edit', name:'edit_student')]
    public function editStudent(
        EntityManagerInterface $entityManager,
        Weather $weather,
        Request $request,
        int $id,
    ): Response
    {
        $student = $entityManager->getRepository(Student::class)->find($id);

        $form = $this->createFormBuilder($student)
            ->add('name', TextType::class)
            ->add('id', TextType::class)
            ->add('year', TextType::class)
            ->add('status', EnumType::class, ['class' => studentStatusEnum::class])
            ->add('submit', SubmitType::class)
            ->getForm();

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