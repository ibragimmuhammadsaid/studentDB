<?php

namespace App\Entity;

use App\Enum\studentStatusEnum;
use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column(enumType: studentStatusEnum::class)]
    private ?studentStatusEnum $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getStatus(): ?studentStatusEnum
    {
        return $this->status;
    }

    public function setStatus(studentStatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function statusToString(): string
    {
        return $this->status->value;
    }

    public function isStudying(): bool
    {
        return $this->status === studentStatusEnum::STUDYING;
    }

    public function isNotStudying(): bool
    {
        return $this->status === studentStatusEnum::NOT_STUDYING;
    }

    public function isPlanningToTransfer(): bool
    {
        return $this->status === studentStatusEnum::PLANNING_TO_TRANSFER;
    }

}
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//
