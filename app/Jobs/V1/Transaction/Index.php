<?php

namespace App\Jobs\V1\Transaction;

use App\Models\Transaction;
use Illuminate\Foundation\Bus\Dispatchable;

class Index
{
    use Dispatchable;

    /**
     * Получаем все записи транзакций из БД
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $transaction = Transaction::all();
        return \App\Http\Resources\V1\Transaction\Index::collection($transaction);
    }
}
