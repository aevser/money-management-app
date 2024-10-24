<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Transaction as Requests;
use App\Jobs\V1\Transaction as Jobs;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Jobs\Index::dispatchSync();
        return response()->json(['transaction' => $transaction], Response::HTTP_OK);
    } // Все записи

    public function store(Requests\CreateTransactionRequest $request)
    {
        Jobs\Create::dispatchSync(
            user_id: $request->user_id,
            type: $request->type,
            amount: $request->amount,
            date: $request->date,
            description: $request->description
        );

        return response()->json('Транзакция добавлена', Response::HTTP_CREATED);
    } // Добавляем запись

    public function update(Requests\UpdateTransactionRequest $request, $id)
    {
        Jobs\Update::dispatchSync(
            transaction_id: $id,
            user_id: $request->user_id,
            type: $request->type,
            amount: $request->amount,
            date: $request->date,
            description: $request->description
        );

        return response()->json('Транзакция обновлена', Response::HTTP_OK);
    } // Обновляем запись по ID

    public function destroy($id)
    {
        Jobs\Delete::dispatchSync($id);
        return response()->json('Транзакция удалена', Response::HTTP_OK);
    } // Удаляем запись по ID
}
