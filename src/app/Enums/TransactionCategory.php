<?php

declare(strict_types=1);

namespace App\Enums;

// Fixed list; see docs/business/transaction-categories.md.
enum TransactionCategory: string
{
    case Housing = 'housing';
    case Food = 'food';
    case Transportation = 'transportation';
    case Health = 'health';
    case Leisure = 'leisure';
    case Education = 'education';
    case Subscriptions = 'subscriptions';
    case Other = 'other';
}
