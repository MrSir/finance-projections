<?php
/**
 * Created by PhpStorm.
 * User: MrSir
 * Date: 12/5/2015
 * Time: 1:05 PM
 */

namespace App\Http\Controllers;

use App\Account;
use App\Category;
use App\Http\Requests\Home\Index as RequestIndex;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index(RequestIndex $request)
    {
        // instantiate the pipe
        $pipeline = new Index();
        $pipeline->fill($request);

        // flush the pipe
        $result = $pipeline->flush();

        // handle the response
        return response()
            ->json($result)
            ->setStatusCode($result['code']);



        $startDate = new Carbon(env('START_DATE'));
        $endDate = $startDate->copy()->addYear(2);

        $currentStart = $startDate->copy();
        $currentEnd = $currentStart->copy()->addWeeks(2)->subDay(1);

        $checkingAccount = Account::where('name','=','Checking')->orderBy('id', 'DESC')->first();
        $savingsAccount = Account::where('name','=','Savings')->orderBy('id', 'DESC')->first();
        $rrspAccount = Account::where('name','=','RRSP')->orderBy('id', 'DESC')->first();

        $periods = $this->generatePeriods(
            $currentStart,
            $currentEnd,
            $startDate,
            $endDate,
            2,
            $transactions,
            $checkingAccount->balance,
            $savingsAccount->balance,
            $rrspAccount->balance
        );

        return View::make('site.index')->with(
            [
                'activeTab' => 'current',
                'categories' => $categories,
                'periods' => $periods
            ]
        );
    }

    /**
     * @param $transactions
     * @param Carbon $currentStart
     * @param Carbon $currentEnd
     * @param $checkingBalance
     * @param $savingsBalance
     * @return array
     */
    private function computeBiWeeklyTransactions(
        $transactions,
        Carbon $currentStart,
        Carbon $currentEnd,
        &$checkingBalance,
        &$savingsBalance,
        &$rrspBalance
    ){
        $result = [];

        foreach($transactions as $transaction)
        {
            $transactionRepeatStart = new Carbon($transaction->repeat_start);
            if($transaction->repeat_end){
                $transactionRepeatEnd = new Carbon($transaction->repeat_end);
            }

            if($transactionRepeatStart->diff($currentStart)->invert > -1 && $transactionRepeatStart->diff($currentEnd)->invert < 1){
                $result[] = $this->generateTransaction($checkingBalance, $savingsBalance, $rrspBalance, $transaction);
            }
        }

        return $result;
    }

    /**
     * @param $transactions
     * @param Carbon $currentStart
     * @param Carbon $currentEnd
     * @param $checkingBalance
     * @param $savingsBalance
     * @return array
     */
    private function computeMonthlyTransactions(
        $transactions,
        Carbon $currentStart,
        Carbon $currentEnd,
        &$checkingBalance,
        &$savingsBalance,
        &$rrspBalance
    ){
        $result = [];

        foreach($transactions as $transaction)
        {
            $transactionDate = new Carbon($transaction->date);
            $transactionRepeatStart = new Carbon($transaction->repeat_start);
            if($transaction->repeat_end){
                $transactionRepeatEnd = new Carbon($transaction->repeat_end);
            }

            if($currentStart->day > $currentEnd->day){
                if($transactionDate->day >= $currentStart->day || $transactionDate->day <= $currentEnd->day){
                    $dayCheck = true;
                }else{
                    $dayCheck = false;
                }
            }else{
                if($transactionDate->day >= $currentStart->day && $transactionDate->day <= $currentEnd->day){
                    $dayCheck = true;
                }else{
                    $dayCheck = false;
                }
            }

            if($transactionRepeatStart->diff($currentStart)->invert > -1 && $transactionRepeatStart->diff($currentEnd)->invert < 1){
                if($dayCheck){
                    $result[] = $this->generateTransaction($checkingBalance, $savingsBalance, $rrspBalance, $transaction);
                }
            }
        }

        return $result;
    }

    /**
     * @param $transactions
     * @param Carbon $currentStart
     * @param Carbon $currentEnd
     * @param $checkingBalance
     * @param $savingsBalance
     * @return array
     */
    private function computeOnceTransactions(
        $transactions,
        Carbon $currentStart,
        Carbon $currentEnd,
        &$checkingBalance,
        &$savingsBalance,
        &$rrspBalance
    ){
        $result = [];

        foreach($transactions as $transaction)
        {
            $transactionDate = new Carbon($transaction->date);

            if($transactionDate->between($currentStart,$currentEnd)){
                $result[] = $this->generateTransaction($checkingBalance, $savingsBalance, $rrspBalance, $transaction);
            }
        }

        return $result;
    }


    /**
     * @param $transactions
     * @param Carbon $currentStart
     * @param Carbon $currentEnd
     * @param $checkingBalance
     * @param $savingsBalance
     * @return array
     */
    private function computeAnnualTransactions(
        $transactions,
        Carbon $currentStart,
        Carbon $currentEnd,
        &$checkingBalance,
        &$savingsBalance,
        &$rrspBalance
    ){
        $result = [];

        foreach($transactions as $transaction)
        {
            $transactionDateCurrentYear = new Carbon(date('Y').date('-m-d',strtotime($transaction->date)));
            $transactionDateNextYear = new Carbon(date('Y', strtotime('+ 1 Year')).date('-m-d',strtotime($transaction->date)));
            $transactionRepeatStart = new Carbon($transaction->repeat_start);
            if($transaction->repeat_end){
                $transactionRepeatEnd = new Carbon($transaction->repeat_end);
            }

            if($transactionRepeatStart->diff($currentStart)->invert > -1 && $transactionRepeatStart->diff($currentEnd)->invert < 1) {
                if ($transactionDateCurrentYear->between($currentStart, $currentEnd) || $transactionDateNextYear->between($currentStart, $currentEnd)) {
                    $result[] = $this->generateTransaction($checkingBalance, $savingsBalance, $rrspBalance, $transaction);
                }
            }
        }

        return $result;
    }


    /**
     * @param Carbon $currentStart
     * @param Carbon $currentEnd
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @param $interval
     * @param array $transactions
     * @param $checkingBalance
     * @param $savingsBalance
     * @return array
     */
    private function
    generatePeriods(
        Carbon $currentStart,
        Carbon $currentEnd,
        Carbon $startDate,
        Carbon $endDate,
        $interval,
        array $transactions,
        $checkingBalance,
        $savingsBalance,
        $rrspBalance
    )
    {
        $result = [];
        $trigger = true;
        $period['change'] = 0;

        while($trigger){
            if($currentStart->diff($endDate)->invert < 1 && $currentEnd->diff($endDate)->invert < 1){

                if(!isset($period['checkingBalance'])){
                    $period['checkingBalance'] = 0;
                }

                $period['change'] = $checkingBalance-$period['checkingBalance'];

                if($period['change']==0){
                    $period['changeArrow'] = '';
                    $period['changeType'] = '';
                }elseif($period['change']<0){
                    $period['changeArrow'] = 'glyphicon-arrow-down';
                    $period['changeType'] = 'text-danger';
                }elseif($period['change']>0){
                    $period['changeArrow'] = 'glyphicon-arrow-up';
                    $period['changeType'] = 'text-success';
                }

                $period['label'] =  $currentStart->format('F j, Y').' - '.$currentEnd->format('F j, Y');
                $period['checkingBalance'] = $checkingBalance;
                $period['savingsBalance'] = $savingsBalance;
                $period['rrspBalance'] = $rrspBalance;

                //once transactions
                $once_transactions = $this->computeOnceTransactions(
                    $transactions['once'],
                    $currentStart,
                    $currentEnd,
                    $checkingBalance,
                    $savingsBalance,
                    $rrspBalance
                );

                //monthly transactions
                $monthly_transactions = $this->computeMonthlyTransactions(
                    $transactions['monthly'],
                    $currentStart,
                    $currentEnd,
                    $checkingBalance,
                    $savingsBalance,
                    $rrspBalance
                );

                //annual transactions
                $annual_transactions = $this->computeAnnualTransactions(
                    $transactions['annual'],
                    $currentStart,
                    $currentEnd,
                    $checkingBalance,
                    $savingsBalance,
                    $rrspBalance
                );

                //bi-weekly transactions
                $biweekly_transactions = $this->computeBiWeeklyTransactions(
                    $transactions['biweekly'],
                    $currentStart,
                    $currentEnd,
                    $checkingBalance,
                    $savingsBalance,
                    $rrspBalance
                );



                $period['transactions'] = array_merge(
                    $once_transactions,
                    $monthly_transactions,
                    $annual_transactions,
                    $biweekly_transactions
                );

                $result[] = $period;

                $currentStart->addWeeks(2);
                $currentEnd->addWeeks(2);
            }else{
                $trigger = false;
            }
        }

        return $result;
    }

    /**
     * @param $checkingBalance
     * @param $savingsBalance
     * @param $transaction
     * @return array
     */
    private function generateTransaction(&$checkingBalance, &$savingsBalance, &$rrspBalance, $transaction)
    {
        $item = [];

        $item['rowClass'] = $transaction->type == 'saving' ? 'success' : '';
        $item['name'] = $transaction->name;

        if ($transaction->type == 'saving') {
            if ($transaction->category_id == 3) { //Savings category
                $item['checkingAmount'] = -$transaction->amount;
                $item['savingsAmount'] = $transaction->amount;

                $checkingBalance -= $transaction->amount;
                $savingsBalance += $transaction->amount;
            } elseif ($transaction->category_id == 4) { //Savings category
                $item['checkingAmount'] = -$transaction->amount;
                $item['rrspAmount'] = $transaction->amount;

                $checkingBalance -= $transaction->amount;
                $rrspBalance += $transaction->amount;
            } else {
                $item['checkingAmount'] = $transaction->amount;
                $checkingBalance += $transaction->amount;
            }
        } else {
            $item['checkingAmount'] = -$transaction->amount;
            $checkingBalance -= $transaction->amount;
        }

        return $item;
    }
}
