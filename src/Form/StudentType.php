<?php

namespace App\Form;

use App\Enum\studentStatusEnum;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('id', TextType::class, ['label' => 'Student ID'])
            ->add('year', TextType::class)
            ->add('status', EnumType::class, ['class' => studentStatusEnum::class])
            ->add('submit', SubmitType::class);
    }
}