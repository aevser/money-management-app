<?php

namespace App\Jobs\V1\Transaction;

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
        return \App\Models\Transaction::all();
    }
}
