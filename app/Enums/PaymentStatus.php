<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'Pending';
    case SUCCESSFUL = 'Successful';
    case PROCESSING = 'Processing';
    case CANCELED = 'Cancel';
    case FAILED = 'Failed';
}
