<?php

namespace App\Enum;

enum studentStatusEnum: string
{
    case STUDYING = 'studying';
    case NOT_STUDYING = 'not studying';
    case PLANNING_TO_TRANSFER = 'plans to transfer';
}