<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\ReportGeneration;

class ReportController extends Controller
{
    use ReportGeneration;

    /**
     * @param Request $request
     *
     * @return $this
     */
    public function monthly(Request $request)
    {
        setlocale(
            LC_MONETARY,
            'en_US'
        );

        $periods = [];
        $accountSummaries = [];

        $startDate = Carbon::now()
            ->startOfMonth();

        $accounts = Account::all();
        $summaryAmount = 0.00;
        $accounts->each(
            function (Account &$account) use (&$startDate, &$summaryAmount, &$accountSummaries) {
                $accountSummaries[$account->name] = 0;
                $accountBalance = $account->accountBalances()
                    ->first();

                if ($accountBalance) {
                    $summaryAmount += $accountBalance->balance;
                    $accountSummaries[$account->name] = $accountBalance->balance;

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
                $summaryAmount,
                $accountSummaries
            );

            $periods[] = [
                'startDate' => $periodStartDate,
                'endDate' => $periodEndDate,
                'transactions' => $periodTransactions,
                'changeAmount' => $summaryAmount - $previousSummary,
                'summaryAmount' => $summaryAmount,
                'accountSummaries' => $accountSummaries,
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

    /**
     * @param Request $request
     *
     * @return $this
     */
    public function weekly(Request $request)
    {
        setlocale(
            LC_MONETARY,
            'en_US'
        );

        $periods = [];
        $accountSummaries = [];

        $startDate = Carbon::now()
            ->startOfMonth();

        $accounts = Account::all();
        $summaryAmount = 0.00;
        $accounts->each(
            function (Account &$account) use (&$startDate, &$summaryAmount, &$accountSummaries) {
                $accountSummaries[$account->name] = 0;
                $accountBalance = $account->accountBalances()
                    ->first();

                if ($accountBalance) {
                    $summaryAmount += $accountBalance->balance;
                    $accountSummaries[$account->name] = $accountBalance->balance;

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
                'weekly',
                $startDate,
                $endDate
            );

            $previousSummary = $summaryAmount;

            $periodTransactions = $this->computeTransactionsForPeriod(
                $periodStartDate,
                $periodEndDate,
                $summaryAmount,
                $accountSummaries
            );

            $periods[] = [
                'startDate' => $periodStartDate,
                'endDate' => $periodEndDate,
                'transactions' => $periodTransactions,
                'changeAmount' => $summaryAmount - $previousSummary,
                'summaryAmount' => $summaryAmount,
                'accountSummaries' => $accountSummaries,
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

    /**
     * @param Request $request
     *
     * @return $this
     */
    public function biWeekly(Request $request)
    {
        setlocale(
            LC_MONETARY,
            'en_US'
        );

        $periods = [];
        $accountSummaries = [];

        $startDate = Carbon::now()
            ->startOfMonth();

        $accounts = Account::all();
        $summaryAmount = 0.00;
        $accounts->each(
            function (Account &$account) use (&$startDate, &$summaryAmount, &$accountSummaries) {
                $accountSummaries[$account->name] = 0;
                $accountBalance = $account->accountBalances()
                    ->first();

                if ($accountBalance) {
                    $summaryAmount += $accountBalance->balance;
                    $accountSummaries[$account->name] = $accountBalance->balance;

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
                'bi-weekly',
                $startDate,
                $endDate
            );

            $previousSummary = $summaryAmount;

            $periodTransactions = $this->computeTransactionsForPeriod(
                $periodStartDate,
                $periodEndDate,
                $summaryAmount,
                $accountSummaries
            );

            $periods[] = [
                'startDate' => $periodStartDate,
                'endDate' => $periodEndDate,
                'transactions' => $periodTransactions,
                'changeAmount' => $summaryAmount - $previousSummary,
                'summaryAmount' => $summaryAmount,
                'accountSummaries' => $accountSummaries,
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
}
