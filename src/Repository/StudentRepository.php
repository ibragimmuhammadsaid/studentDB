<?php

namespace App\Repository;

use Psr\Log\LoggerInterface;
use App\Model\students;
use App\Model\studentStatusEnum;

class StudentRepository
{
    public function __construct(
        private LoggerInterface $logger,
    ) {

    }

    public function findAll(): array
    {
        $this->logger->info('Name');

        return $students = 
        [
            new students(
                'Muhammad Said Ibragim',
                220299,
                3,
                studentStatusEnum::STUDYING,
            ),
            new students(
                'Abdullokh Rakhimjonov',
                220333,
                3,
                studentStatusEnum::STUDYING,
            ),
            new students(
                'Mahmudbek Sultonmuratov',
                220222,
                3,
                studentStatusEnum::NOT_STUDYING,
            ),
            new students(
                'Shaxzodbek Safarov',
                220978,
                3,
                studentStatusEnum::NOT_STUDYING
            ),
            new students(
                'Abror Musaxanov',
                220763,
                2,
                studentStatusEnum::NOT_STUDYING
            ),
            new students(
                'Artem Say',
                220748,
                3,
                studentStatusEnum::STUDYING
            ),
            new students(
                'Hamas XXX',
                230558,
                2,
                studentStatusEnum::PLANNING_TO_TRANSFER
            ),
            new students(
                'Karina Asanova',
                220585,
                3,
                studentStatusEnum::STUDYING
            ),
            new students(
                'Usman Inogamov',
                220937,
                3,
                studentStatusEnum::NOT_STUDYING
            ),
            new students(
                'Alsu Khabibullina',
                220878,
                3,
                studentStatusEnum::STUDYING
            ),
            new students(
                'Mikhail Kim',
                220800,
                3,
                studentStatusEnum::STUDYING
            )
        ];
    }

    public function find(int $id): ?students
    {
        foreach ($this->findAll() as $student) {
            if($student->getID() == $id) {
                return $student; 
            }
        }
        return null;
    }
}