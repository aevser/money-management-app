<?php

namespace App\Jobs\V1\Transaction;

use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable;

    /**
     * Создаем запись транзакции в БД
     * @param int $user_id - ID пользователя
     * @param string $type - тип транзакции
     * @param string $amount - сумма
     * @param string $date - дата транзакции
     * @param string $description - описание транзакции
     */

    public function __construct(
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
        // Записываем данные в БД
        $transaction = \App\Models\Transaction::create([
            'user_id' => $this->user_id,
            'type' => $this->type,
            'amount' => $this->amount,
            'date' => $this->date,
            'description' => $this->description
        ]);

        return $transaction;
    }
}
