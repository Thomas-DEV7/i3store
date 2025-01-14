<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Compra</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
        }
        .container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            font-size: 2rem;
            color: #0056b3;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        p {
            font-size: 1rem;
            margin-bottom: 1rem;
        }
        .order-detail {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background-color: #f9f9f9;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .order-detail p {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        a {
            display: block;
            text-align: center;
            background-color: #0056b3;
            color: #fff;
            text-decoration: none;
            padding: 0.75rem;
            border-radius: 5px;
            font-size: 1rem;
            margin-top: 1rem;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #003f88;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pagamento Realizado com Sucesso!</h1>
        <div class="order-detail">
            <p><strong>Nome:</strong> {{ session('order.name') }}</p>
            <p><strong>Email:</strong> {{ session('order.email') }}</p>
            <p><strong>Total:</strong> R$ {{ number_format(session('order.amount'), 2, ',', '.') }}</p>
        </div>
        <a href="/">Voltar à Loja</a>
    </div>
</body>
</html>