<?php

declare(strict_types=1);

namespace App\Enums;

// How an expense transaction was paid; see docs/business/transactions.md.
enum PaymentMethod: string
{
    case Pix = 'pix';
    case DebitCard = 'debit_card';
    case Cash = 'cash';
    case Boleto = 'boleto';
}
