<?php

declare(strict_types=1);

namespace App\Services\Transactions;

use App\Enums\TransactionCategory;
use App\Models\User;

class ShowAnnualSummaryService
{
    /**
     * Income and expenses per month (all twelve, in order) and expenses per category with
     * any spending, highest first. Expenses are positive cents.
     *
     * @return array{
     *     months: list<array{month: string, income_cents: int, expenses_cents: int}>,
     *     categories: list<array{category: string, expenses_cents: int}>
     * }
     */
    public function execute(User $user, int $year): array
    {
        $months = [];

        foreach (range(1, 12) as $monthNumber) {
            $month = sprintf('%04d-%02d', $year, $monthNumber);
            $months[$month] = ['month' => $month, 'income_cents' => 0, 'expenses_cents' => 0];
        }

        $categories = array_fill_keys(array_column(TransactionCategory::cases(), 'value'), 0);

        $transactions = $user->transactions()
            ->whereBetween('transaction_date', ["{$year}-01-01", "{$year}-12-31"])
            ->get(['amount_cents', 'transaction_date', 'category']);

        foreach ($transactions as $transaction) {
            $month = $transaction->transaction_date->format('Y-m');

            if ($transaction->amount_cents > 0) {
                $months[$month]['income_cents'] += $transaction->amount_cents;

                continue;
            }

            $months[$month]['expenses_cents'] -= $transaction->amount_cents;
            $categories[$transaction->category->value] -= $transaction->amount_cents;
        }

        arsort($categories);

        $spentCategories = array_filter($categories, fn (int $expensesCents): bool => $expensesCents > 0);

        return [
            'months' => array_values($months),
            'categories' => array_map(
                fn (string $category, int $expensesCents): array => ['category' => $category, 'expenses_cents' => $expensesCents],
                array_keys($spentCategories),
                array_values($spentCategories),
            ),
        ];
    }
}
