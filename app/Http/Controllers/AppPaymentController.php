<?php
namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\AppPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppPaymentController extends Controller
{
    public function index()
    {
        try {
            $payments = AppPayment::where('active',false)->get();
            return response()->json($payments);
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao listar APP de Pagamentos'], 404);
        }
    }

    public function create(PaymentRequest $request)
    {
        try {
        
            $payment = AppPayment::create($request->validated());
            return response()->json($payment, 201);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => 'Falha no banco de dados', 'message' => $e->getMessage()], 500);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao criar APP de pagamento'], 500);
        }
    }

    public function show($id)
    {
        try {
            $payment = AppPayment::where('active',false)
            ->where('id',$id)
            ->get();

            return response()->json($payment,201);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'APP de pagamento não encontrado'], 404);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao listar APP de pagamento'], 500);
        }
    }

    public function update(PaymentRequest $request, $id)
    {
        try {
            $payment = AppPayment::findOrFail($id);
            $payment->update($request->validated());

            return response()->json($payment,204);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => 'Falha no banco de dados'], 500);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao atualizar APP de pagamento'], 500);
        }
    }

    public function destroy($id)
    {
        try {
         
            AppPayment::where('id',$id)
                ->update(['active'=>1]);

            return response()->json(['message' => 'APP de pagamento deletado com sucesso'],204);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'APP de pagamento não encontrado'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Falha ao deletar APP de pagamento'], 500);
        }
    }
}
