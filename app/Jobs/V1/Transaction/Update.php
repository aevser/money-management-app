<?php

namespace App\Jobs\V1\Transaction;

use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable;

    /**
     * Обновить запись транзакции по ID
     * @param int $transaction_id - ID транзакции
     * @param int $user_id - ID пользователя
     * @param string $type - тип транзакции
     * @param string $amount - сумма
     * @param string $date - дата транзакции
     * @param string $description - описание транзакции
     */
    public function __construct(
        private int $transaction_id,
        private int $user_id,
        private string $type,
        private string $amount,
        private string $date,
        private ?string $description
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Загружаем запись по ID и обновляем данные
        $transaction = \App\Models\Transaction::findOrFail($this->transaction_id);
        $transaction->update([
            'user_id' => $this->user_id,
            'type' => $this->type,
            'amount' => $this->amount,
            'date' => $this->date,
            'description' => $this->description
        ]);

        return $transaction;
    }
}
