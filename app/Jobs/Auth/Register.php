<?php

namespace App\Jobs\Auth;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Hash;

class Register
{
    use Dispatchable;

    /**
     * Создаем запись пользователя в БД
     * @param string $name - имя
     * @param string $email - E-mail
     * @param string $password - пароль
     */

    public function __construct(
        private string $name,
        private string $email,
        private string $password
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
        $user = \App\Models\User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        return $user;
    }
}
