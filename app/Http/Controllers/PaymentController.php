<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        Log::info('Processando o pagamento...', $request->all());

        // Configurar o Stripe
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Criar a cobrança no Stripe
            $charge = \Stripe\Charge::create([
                'amount' => $request->input('amount') * 100, // Stripe trabalha com centavos
                'currency' => 'brl',
                'source' => $request->input('stripeToken'),
                'description' => 'Pagamento do Produto',
            ]);

            // Salvar os dados do pedido na sessão
            $order = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'amount' => $request->input('amount'),
                'stripe_charge_id' => $charge->id,
            ];

            $request->session()->put('order', $order);

            Log::info('Pedido salvo na sessão.', ['order' => $order]);

            // Redirecionar para a página de confirmação
            return redirect()->route('checkout.confirm')->with('success', 'Pagamento realizado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao processar o pagamento: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Erro ao processar o pagamento.']);
        }
    }
}
