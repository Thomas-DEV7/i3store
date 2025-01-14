<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>i3 Store - Produtos</title>
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
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        header {
            background-color: #0056b3;
            color: #fff;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            font-size: 1.8rem;
        }
        header nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 1rem;
            font-size: 1rem;
        }
        header nav a:hover {
            text-decoration: underline;
        }

        .carousel {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            gap: 1rem;
            padding: 1rem 0;
            margin-bottom: 2rem;
        }
        .carousel-item {
            flex: 0 0 80%;
            scroll-snap-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            text-align: center;
        }
        .carousel-item img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .carousel-item h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #0056b3;
        }
        .carousel-item p {
            margin-bottom: 0.5rem;
            color: #555;
        }
        .carousel-item button {
            background-color: #0056b3;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .carousel-item button:hover {
            background-color: #003f88;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        .product-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-card .content {
            padding: 1rem;
        }
        .product-card h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #333;
        }
        .product-card p {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.5rem;
        }
        .product-card .price {
            font-size: 1.1rem;
            color: #0056b3;
            margin-bottom: 1rem;
        }
        .product-card button {
            background-color: #0056b3;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .product-card button:hover {
            background-color: #003f88;
        }

        footer {
            background-color: #0056b3;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }
        footer span {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Cabeçalho -->
    <header>
        <div class="container">
            <h1>i3 Store</h1>
            <nav>
                <a href="/">Home</a>
                <a href="/login">Login</a>
                <a href="/register">Registrar</a>
            </nav>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <main class="container">
        <!-- Destaques -->
        <section>
            <h2 class="text-2xl font-bold mb-4">Destaques</h2>
            <div class="carousel">
                @foreach ($featuredProducts as $product)
                    <div class="carousel-item">
                        <img src="https://m.media-amazon.com/images/I/71kC+AiZBbL.jpg" alt="{{ $product->name }}">
                        <h2>{{ $product->name }}</h2>
                        <p>{{ $product->description }}</p>
                        <p class="price">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                        <button>Ver Produto</button>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Todos os Produtos -->
        <section>
            <h2 class="text-2xl font-bold mb-4">Nossos Produtos</h2>
            <div class="product-grid">
                @foreach ($products as $product)
                    <div class="product-card">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQnOpQTpqkFN4331Oh7IQo2zr8vf2QMIN30Ew&s" alt="{{ $product->name }}">
                        <div class="content">
                            <h3>{{ $product->name }}</h3>
                            <p>{{ $product->description }}</p>
                            <p class="price">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                            <button>Adicionar ao Carrinho</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    <!-- Rodapé -->
    <footer>
        <p>&copy; {{ date('Y') }} i3 Store. Todos os direitos reservados.</p>
        <span>Desenvolvido com ❤️ pela equipe i3 Store</span>
    </footer>
</body>
</html>
