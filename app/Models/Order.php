<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'payment_method',
        'amount',
        'stripe_charge_id',
    ];
    
    public function confirm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'payment' => 'required|string',
        ]);

        // Criar o pedido
        Order::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'payment' => $validated['payment'],
            'product_id' => $request->query('product_id'),
        ]);

        return redirect()->route('checkout.show')->with('success', 'Compra realizada com sucesso!');
    }
}
