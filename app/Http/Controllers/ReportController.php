<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use test\last;

class ReportController extends Controller
{
    public function monthly(Request $request)
    {
        $periods = [];

        $startDate = Carbon::now()
            ->startOfMonth();

        $accounts = Account::all();
        $accounts->each(
            function (Account &$account) use (&$startDate) {
                $accountBalance = $account->accountBalances;

                if ($accountBalance) {
                    //if ($startDate->greaterThan($accountBalance->posted_at)) {
                    //
                    //    $startDate = $accountBalance->posted_at;
                    //}
                }
            }
        );

        $endDate = $startDate->copy()
            ->addYear()
            ->endOfMonth();

        $transactions = Transaction::all()
            ->load(
                [
                    'account',
                    'category',
                    'frequency',
                ]
            );

        $isLastPeriod = false;

        while (!$isLastPeriod) {
            /**
             * @var Carbon $periodStartDate
             * @var Carbon $periodEndDate
             */
            list($periodStartDate, $periodEndDate) = $this->computePeriodDates(
                'monthly',
                $startDate,
                $endDate
            );

            $periodTransactions = $this->computeTransactionsForPeriod(
                $periodStartDate,
                $periodEndDate
            );

            $periods[] = [
                'startDate' => $periodStartDate,
                'endDate' => $periodEndDate,
                'transactions' => $periodTransactions,
            ];

            $startDate = $periodEndDate->copy()
                ->addDay();

            if ($periodEndDate->equalTo($endDate)) {
                $isLastPeriod = true;
            }
        }

        return response()
            ->json($periods)
            ->setStatusCode(200);
    }

    public function computeTransactionsForPeriod(Carbon $startDate, Carbon $endDate)
    {
        $periodTransactions = [];

        // add Once transactions
        $onceFrequency = Transaction\Frequency::whereName('once')
            ->first();
        $onceTransactions = Transaction::query()
            ->where(
                'transaction_frequency_id',
                '=',
                $onceFrequency->id
            )
            ->where(
                'occurred_at',
                '>=',
                $startDate
            )
            ->where(
                'occurred_at',
                '<=',
                $endDate
            )
            ->get();
        foreach ($onceTransactions as $onceTransaction) {
            $periodTransactions[] = $onceTransaction;
        }

        // add Monthly Transactions
        $monthlyFrequency = Transaction\Frequency::whereName('monthly')
            ->first();
        $monthlyTransactions = Transaction::query()
            ->where(
                'transaction_frequency_id',
                '=',
                $monthlyFrequency->id
            )
            ->get();

        foreach ($monthlyTransactions as $monthlyTransaction) {
            $periodCheck = $this->checkRepeatingPeriod(
                $monthlyTransaction->repeat_start_at,
                $monthlyTransaction->repeat_end_at,
                $startDate,
                $endDate
            );

            if ($periodCheck) {
                $periodTransactions[] = $monthlyTransaction;
            }
        }

        return $periodTransactions;
    }

    /**
     * This function checks if the current period fits within the repeating period
     *
     * @param Carbon      $repeatingStartDate
     * @param Carbon|null $repeatingEndDate
     * @param Carbon      $starDate
     * @param Carbon      $endDate
     *
     * @return bool
     */
    public function checkRepeatingPeriod(
        Carbon $repeatingStartDate,
        $repeatingEndDate,
        Carbon $starDate,
        Carbon $endDate
    ) {
        $startDateCondition = $starDate->greaterThan($repeatingStartDate);

        $endDateCondition = true;

        if (!is_null($repeatingEndDate)) {
            $startDateCondition = $starDate->between(
                $repeatingStartDate,
                $repeatingEndDate
            );

            $endDateCondition = $endDate->between(
                $repeatingStartDate,
                $repeatingEndDate
            );
        }

        return $startDateCondition && $endDateCondition;
    }

    /**
     * This function computes the periods for a year ahead
     *
     * @param string $type
     * @param Carbon $startDate
     * @param Carbon $endDate
     *
     * @return array
     */
    public function computePeriodDates(string $type, Carbon $startDate, Carbon $endDate)
    {
        /** @var Carbon $periodStartDate */
        $periodStartDate = $startDate;
        $periodEndDate = $startDate->copy();

        switch ($type) {
            case 'monthly':
                $periodEndDate->endOfMonth();

                break;
        }

        if ($periodEndDate > greaterThan($endDate)) {
            $periodEndDate = $endDate;
        }

        return [
            $periodStartDate,
            $periodEndDate,
        ];
    }
}
