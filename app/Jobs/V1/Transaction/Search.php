<?php

namespace App\Jobs\V1\Transaction;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class Search
{
    use Dispatchable;

    /**
     * Фильтрация транзакций по датам
     * @param string $start_date - начальная дата
     * @param string $end_date - конечная дата
     */

    public function __construct(
        private ?string $start_date,
        private ?string $end_date,
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $query = \App\Models\Transaction::query();

        if ($this->start_date && $this->end_date) {
            $query->byDate($this->start_date, $this->end_date);
        } elseif ($this->start_date) {
            $query->where('date', '>=', $this->start_date);
        } elseif($this->end_date) {
            $query->where('date', '<=', $this->end_date);
        }

        $transaction = $query->get();

        return \App\Http\Resources\V1\Transaction\Index::collection($transaction);
    }
}
