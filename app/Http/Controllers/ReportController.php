<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use test\last;

class ReportController extends Controller
{
    public function monthly(Request $request)
    {
        setlocale(
            LC_MONETARY,
            'en_US'
        );

        $periods = [];

        $startDate = Carbon::now()
            ->startOfMonth();

        $accounts = Account::all();
        $summaryAmount = 0.00;
        $accounts->each(
            function (Account &$account) use (&$startDate, &$summaryAmount) {
                $accountBalance = $account->accountBalances()
                    ->first();

                if ($accountBalance) {
                    $summaryAmount += $accountBalance->balance;

                    if ($startDate->greaterThan($accountBalance->posted_at)) {
                        $startDate = $accountBalance->posted_at->copy()
                            ->startOfMonth();
                    }
                }
            }
        );

        $endDate = $startDate->copy()
            ->addYear()
            ->endOfMonth();

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

            $previousSummary = $summaryAmount;

            $periodTransactions = $this->computeTransactionsForPeriod(
                $periodStartDate,
                $periodEndDate,
                $summaryAmount
            );

            $periods[] = [
                'startDate' => $periodStartDate,
                'endDate' => $periodEndDate,
                'transactions' => $periodTransactions,
                'changeAmount' => $summaryAmount - $previousSummary,
                'summaryAmount' => $summaryAmount,
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

    public function computeTransactionsForPeriod(Carbon $startDate, Carbon $endDate, float &$summaryAmount)
    {
        $periodTransactions = [];

        // add Once transactions
        $this->getOnceTransactions(
            $startDate,
            $endDate,
            $summaryAmount,
            $periodTransactions
        );

        // add weekly Transactions
        $this->getWeeklyTransactions(
            $startDate,
            $endDate,
            $summaryAmount,
            $periodTransactions
        );

        // add Bi-weekly Transactions
        $this->getBiWeeklyTransactions(
            $startDate,
            $endDate,
            $summaryAmount,
            $periodTransactions
        );

        // add Monthly Transactions
        $this->getMonthlyTransactions(
            $startDate,
            $endDate,
            $summaryAmount,
            $periodTransactions
        );

        $periodTransactions = collect($periodTransactions)
            ->sortBy('occurred_at')
            ->values()
            ->all();

        return $periodTransactions;
    }

    /**
     * This function grabs the once transactions for this period
     *
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @param float  $summaryAmount
     * @param array  $periodTransactions
     */
    public function getOnceTransactions(
        Carbon $startDate,
        Carbon $endDate,
        float &$summaryAmount,
        array &$periodTransactions
    ) {
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
            $summaryAmount += $onceTransaction->amount;
        }
    }

    /**
     * This function grabs the weekly transactions for this period
     *
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @param float  $summaryAmount
     * @param array  $periodTransactions
     */
    public function getWeeklyTransactions(
        Carbon $startDate,
        Carbon $endDate,
        float &$summaryAmount,
        array &$periodTransactions
    ) {
        $frequency = Transaction\Frequency::whereName('weekly')
            ->first();
        $this->getTransactions(
            $frequency,
            $startDate,
            $endDate,
            $summaryAmount,
            $periodTransactions,
            function (Carbon $date) {
                return $date->addWeek();
            }
        );
    }

    /**
     * This function grabs the bi-weekly transactions for this period
     *
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @param float  $summaryAmount
     * @param array  $periodTransactions
     */
    public function getBiWeeklyTransactions(
        Carbon $startDate,
        Carbon $endDate,
        float &$summaryAmount,
        array &$periodTransactions
    ) {
        $frequency = Transaction\Frequency::whereName('bi-weekly')
            ->first();
        $this->getTransactions(
            $frequency,
            $startDate,
            $endDate,
            $summaryAmount,
            $periodTransactions,
            function (Carbon $date) {
                return $date->addWeeks(2);
            }
        );
    }

    /**
     * This function grabs the monthly transactions for this period
     *
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @param float  $summaryAmount
     * @param array  $periodTransactions
     */
    public function getMonthlyTransactions(
        Carbon $startDate,
        Carbon $endDate,
        float &$summaryAmount,
        array &$periodTransactions
    ) {
        $frequency = Transaction\Frequency::whereName('monthly')
            ->first();

        $this->getTransactions(
            $frequency,
            $startDate,
            $endDate,
            $summaryAmount,
            $periodTransactions,
            function (Carbon $date) {
                return $date->addMonth();
            }
        );
    }

    /**
     * This function computes how many times the transaction appears in the period
     *
     * @param Transaction\Frequency $frequency
     * @param Carbon                $startDate
     * @param Carbon                $endDate
     * @param float                 $summaryAmount
     * @param array                 $periodTransactions
     * @param Closure               $dateIncrementFunction
     */
    public function getTransactions(
        Transaction\Frequency $frequency,
        Carbon $startDate,
        Carbon $endDate,
        float &$summaryAmount,
        array &$periodTransactions,
        Closure $dateIncrementFunction
    ) {
        $transactions = $frequency->transactions()
            ->get();

        foreach ($transactions as $transaction) {
            $repeatingStartDate = $transaction->repeat_start_at;
            $repeatingEndDate = $transaction->repeat_end_at;
            if (is_null($repeatingEndDate)) {
                $repeatingEndDate = $endDate;
            }

            $currentDate = $transaction->occurred_at;

            $trig = true;

            while ($trig) {
                $repeatingCondition = $currentDate->between(
                    $repeatingStartDate,
                    $repeatingEndDate
                );

                $periodCondition = $currentDate->between(
                    $startDate,
                    $endDate
                );

                if (!$repeatingCondition && !$periodCondition) {
                    $trig = false;
                }

                if ($repeatingCondition && $periodCondition) {
                    $transaction->occurred_at = $currentDate;

                    $periodTransactions[] = $transaction;
                    $summaryAmount += $transaction->amount;

                    $currentDate = $dateIncrementFunction($currentDate);

                    continue;
                }

                $currentDate = $dateIncrementFunction($currentDate);
            }
        }
    }

    /**
     * This function checks if the current period fits within the repeating period
     *
     * @param Carbon      $repeatingStartDate
     * @param Carbon|null $repeatingEndDate
     * @param Carbon      $startDate
     * @param Carbon      $endDate
     *
     * @return bool
     */
    public function checkRepeatingPeriod(
        Carbon $repeatingStartDate,
        $repeatingEndDate,
        Carbon $startDate,
        Carbon $endDate
    ) {
        // check if repeating start date is before the start date
        if ($repeatingStartDate->lessThan($startDate)) {
            if (!is_null($repeatingEndDate)) {
                // has repeating period ended
                if ($repeatingEndDate->lessThan($startDate)) {
                    return false;
                }

                return true;
            }

            return true;
        }

        // the transaction should start repeating outside of the period
        if ($repeatingStartDate->greaterThan($endDate)) {
            return false;
        }

        return true;
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

        if ($periodEndDate->greaterThan($endDate)) {
            $periodEndDate = $endDate;
        }

        return [
            $periodStartDate,
            $periodEndDate,
        ];
    }
}
