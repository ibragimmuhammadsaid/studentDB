<?php

namespace App\Model;

use App\Model\studentStatusEnum;

class students
{
    public function __construct(
        private string $name, 
        private int $id, 
        private int $year, 
        private studentStatusEnum $status,
        ) {
        }

    public function getName(): string
        {
            return $this->name;
        }

    public function getID(): int
        {
            return $this->id;
        }

    public function getYear(): int
        {
            return $this->year;
        }
        
    public function getStatus(): studentStatusEnum
        {
            return $this->status;
        }

    public function getStatusString(): string
    {
        return $this->status->value;
    }

    public function getStatusImageFileName(): string
    {
        return match($this->status) {
            studentStatusEnum::STUDYING => 'images/student.png',
            studentStatusEnum::NOT_STUDYING => 'images/dropout.png',
            studentStatusEnum::PLANNING_TO_TRANSFER => 'images/transfer.png',
        };
    }
}