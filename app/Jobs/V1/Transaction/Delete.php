<?php

namespace App\Jobs\V1\Transaction;

use Illuminate\Foundation\Bus\Dispatchable;

class Delete
{
    use Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $transaction_id
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return \App\Models\Transaction::destroy($this->transaction_id);
    }
}
