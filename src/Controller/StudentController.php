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
    ) {
        $student = $entityManager->getRepository(Student::class)->find($id);

        return $this->render('show.html.twig', [
            'student' => $student,
            'weather' => $weather
        ]);
    }

    #[Route('/student-create', name: 'create_student')]
    public function createStudent(
        EntityManagerInterface $entityManager,
        weather $weather,
        Request $request,
    ): Response {
        $student = new Student();
        $form = $this->createFormBuilder($student)
            ->add('name', TextType::class)
            ->add('id', IntegerType::class)
            ->add('year', IntegerType::class)
            ->add('status', EnumType::class, ['class' => studentStatusEnum::class])
            ->add('submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('app_homepage');
        }

        

        return $this->render('createstudent.html.twig', [
            'weather' => $weather,
            'form' => $form,
        ]);
    }

    // #[Route('/student/{id}/edit', name:'edit_student')]
    // public function editStudent(
    //     EntityManagerInterface $entityManager,
    //     weather $weather,
    //     Request $request,
    //     int $id,
    //     ): Response
    // {
    //     $editStudent = $entityManager->getRepository(Student::class)->find($id);

    //     $student = new Student();
    //     $form = $this->createFormBuilder($student)
    //         ->add('name', TextType::class)
    //         ->add('id', IntegerType::class)
    //         ->add('year', IntegerType::class)
    //         ->add('status', EnumType::class, ['class' => studentStatusEnum::class])
    //         ->add('submit', SubmitType::class)
    //         ->getForm();

    //     $form->handleRequest($request);
        
    //     if ($form->isSubmitted() && $form->isValid()) {

    //         return $this->redirectToRoute('students_show');
    //     }

    //     return $this->render('editstudent.html.twig', [
    //         'weather' => $weather,
    //         'form' => $form,
    //         ]);
    // }

    public function deleteStudent()
    {

    }
}