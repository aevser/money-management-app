<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Transaction as Requests;
use App\Jobs\V1\Transaction as Jobs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Jobs\Index::dispatchSync();
        return response()->json(['transaction' => $transaction], Response::HTTP_OK);
    } // Все записи

    public function store(Request $request)
    {
        Jobs\Create::dispatchSync(
            user_id: Auth::id(),
            type: $request->type,
            amount: $request->amount,
            date: Carbon::parse($request->date)->format('Y-m-d'),
            description: $request->description
        );

        return response()->json('Транзакция добавлена', Response::HTTP_CREATED);
    } // Добавляем запись

    public function update(Requests\UpdateTransactionRequest $request, $id)
    {
        Jobs\Update::dispatchSync(
            transaction_id: $id,
            user_id: Auth::id(),
            type: $request->type,
            amount: $request->amount,
            date: Carbon::parse($request->date)->format('Y-m-d'),
            description: $request->description
        );

        return response()->json('Транзакция обновлена', Response::HTTP_OK);
    } // Обновляем запись по ID

    public function destroy($id)
    {
        Jobs\Delete::dispatchSync($id);
        return response()->json('Транзакция удалена', Response::HTTP_OK);
    } // Удаляем запись по ID

    public function search(Request $request)
    {
        $transaction = Jobs\Search::dispatchSync(
            start_date: $request->start_date,
            end_date: $request->end_date
        );

        return response()->json(['transaction' => $transaction], Response::HTTP_OK);
    } // Фильтр
}
