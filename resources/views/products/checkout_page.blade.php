<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>i3 Store - Checkout</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }
        .container {
            width: 100%;
            max-width: 500px;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            font-size: 1.8rem;
            color: #0056b3;
            margin-bottom: 1rem;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        label {
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #333;
        }
        input, textarea, #card-element {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            background: #f9f9f9;
            transition: border-color 0.3s ease;
        }
        input:focus, textarea:focus, #card-element:focus {
            border-color: #0056b3;
            outline: none;
        }
        button {
            background-color: #0056b3;
            color: #fff;
            border: none;
            padding: 0.75rem;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #003f88;
        }
        #card-errors {
            color: #fa755a;
            font-size: 0.9rem;
            margin-top: -0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
            @csrf
            <input type="hidden" name="amount" value="{{ $product->price }}">

            <label for="name">Nome Completo:</label>
            <input type="text" id="name" name="name" placeholder="Digite seu nome completo" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email" required>

            <label for="address">Endereço:</label>
            <textarea id="address" name="address" placeholder="Digite seu endereço completo" required></textarea>

            <label for="card-element">Informações do Cartão:</label>
            <div id="card-element"></div>

            <div id="card-errors" role="alert"></div>

            <button type="submit" id="submit-button">Finalizar Compra</button>
        </form>
    </div>

    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();

        // Criação do card element
        const card = elements.create('card', {
            style: {
                base: {
                    color: '#32325d',
                    fontFamily: 'Arial, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            }
        });

        card.mount('#card-element');

        // Gerenciamento de erros
        card.addEventListener('change', function(event) {
            const displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Processar o pagamento
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            const { token, error } = await stripe.createToken(card);

            if (error) {
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else {
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
    </script>
</body>
</html>
