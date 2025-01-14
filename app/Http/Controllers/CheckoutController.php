<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Stripe\Charge;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        Log::info('Página de checkout acessada.');

        $productId = $request->query('product_id');
        $product = Product::findOrFail($productId);

        return view('products.checkout_page', compact('product'));
    }


    public function confirm(Request $request)
    {
        Log::info('Entrou no método confirm.');

        // Recupera os dados do pedido da sessão
        $order = $request->session()->get('order');

        if (!$order) {
            Log::warning('Nenhum pedido encontrado na sessão.');
            return redirect()->route('checkout.show')->withErrors(['error' => 'Nenhum pedido encontrado.']);
        }

        Log::info('Pedido encontrado na sessão.', ['order' => $order]);

        // Exibe a view de confirmação
        return view('products.confirm_checkout_page', compact('order'));
    }




    public function process(Request $request)
    {
        // Configurar o Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Criar cobrança
            $charge = Charge::create([
                'amount' => $request->input('amount') * 100, // Em centavos
                'currency' => 'brl',
                'source' => $request->input('stripeToken'),
                'description' => 'Pagamento do Produto',
            ]);

            // Salvar o pedido no banco
            Order::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'payment_method' => 'Stripe',
                'amount' => $request->input('amount'),
                'stripe_charge_id' => $charge->id,
            ]);

            // Redirecionar para a página de confirmação
            return redirect()->route('checkout.confirm')->with('success', 'Pagamento realizado com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
