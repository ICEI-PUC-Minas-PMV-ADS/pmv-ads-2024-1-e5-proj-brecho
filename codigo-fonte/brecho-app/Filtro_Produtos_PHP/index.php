<?php
// Fictitious product data for demonstration
$produtos = array(
    array("nome" => "Produto 1", "marca" => "Marca A", "estado" => "Novo", "preco" => 100, "relevancia" => 4),
    array("nome" => "Produto 2", "marca" => "Marca B", "estado" => "Usado", "preco" => 50, "relevancia" => 3),
    array("nome" => "Produto 3", "marca" => "Marca C", "estado" => "Novo", "preco" => 200, "relevancia" => 5)
);

// Function to sort products by price (ascending or descending)
function compararPorPreco($a, $b) {
    if ($a['preco'] == $b['preco']) {
        return 0;
    }
    return ($a['preco'] < $b['preco']) ? -1 : 1;
}

// Process form data and filter products
$marcaSelecionada = isset($_GET['marca']) ? $_GET['marca'] : "";
$estadoSelecionado = isset($_GET['estado']) ? $_GET['estado'] : "";
$precoMin = isset($_GET['preco_min']) ? $_GET['preco_min'] : "";
$precoMax = isset($_GET['preco_max']) ? $_GET['preco_max'] : "";
$relevanciaSelecionada = isset($_GET['relevancia']) ? $_GET['relevancia'] : "";

$erroPrecoMin = "";
$erroPrecoMax = "";

$produtosFiltrados = array(); // Initializing the list of filtered products

// Input validation for minimum and maximum price
if (!empty($precoMin) && !is_numeric($precoMin)) {
    $erroPrecoMin = "Preço mínimo inválido.";
}

if (!empty($precoMax) && !is_numeric($precoMax)) {
    $erroPrecoMax = "Preço máximo inválido.";
}

// Filter products
foreach ($produtos as $produto) {
    $incluir = true;

    if (!empty($marcaSelecionada) && $produto['marca'] != $marcaSelecionada) {
        $incluir = false;
    }

    if (!empty($estadoSelecionado) && $produto['estado'] != $estadoSelecionado) {
        $incluir = false;
    }

    if (!empty($precoMin) && $produto['preco'] < $precoMin) {
        $incluir = false;
    }

    if (!empty($precoMax) && $produto['preco'] > $precoMax) {
        $incluir = false;
    }

    if ($incluir) {
        $produtosFiltrados[] = $produto;
    }
}

// Order products (if necessary)
if ($relevanciaSelecionada == 'preco_crescente') {
    usort($produtosFiltrados, 'compararPorPreco');
} elseif ($relevanciaSelecionada == 'preco_decrescente') {
    usort($produtosFiltrados, function($a, $b) {
        return compararPorPreco($b, $a);
    });
}

// Function to clear the search
function limparPesquisa() {
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?')); // Redirects to the same page without query parameters
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtro de Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fafafa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-end;
            background-color: #ccdee8; /* Light blue */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            flex: 0 0 calc(50% - 10px);
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        select, input[type="text"], .button {
            width: 100%; /* Overall width */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Added to include full width padding and border */
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .button {
            background-color: #28a745; /* Green color */
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #218838; /* Darker green color on hover */
        }

        .clear-button {
            background-color: #dc3545; /* Red color */
        }

        .clear-button:hover {
            background-color: #c82333; /* Darker red color on hover */
        }

        .products-container {
            margin-top: 30px;
        }

        .product {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .product-name {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-details p {
            margin: 10px 0; 
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Filtro de Produtos</h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
        <div class="form-group">
            <label for="marca">Marca:</label>
            <select id="marca" name="marca">
                <option value="">Todas</option>
                <option value="Marca A">Marca A</option>
                <option value="Marca B">Marca B</option>
                <option value="Marca C">Marca C</option>
            </select>
        </div>

        <div class="form-group">
            <label for="estado">Estado:</label>
            <select id="estado" name="estado">
                <option value="">Todos</option>
                <option value="Novo">Novo</option>
                <option value="Usado">Usado</option>
            </select>
        </div>

        <div class="form-group">
            <label for="preco_min">Preço Mínimo:</label>
            <input type="text" id="preco_min" name="preco_min" value="<?php echo htmlspecialchars($precoMin); ?>">
            <span class="error"><?php echo htmlspecialchars($erroPrecoMin); ?></span>
        </div>

        <div class="form-group">
            <label for="preco_max">Preço Máximo:</label>
            <input type="text" id="preco_max" name="preco_max" value="<?php echo htmlspecialchars($precoMax); ?>">
            <span class="error"><?php echo htmlspecialchars($erroPrecoMax); ?></span>
        </div>

        <div class="form-group">
            <label for="relevancia">Relevância:</label>
            <select id="relevancia" name="relevancia">
                <option value="">Mais Relevantes</option>
                <option value="preco_crescente">Preço Crescente</option>
                <option value="preco_decrescente">Preço Decrescente</option>
            </select>
        </div>

        <div class="button-container">
            <button type="submit" class="button">Filtrar</button>
            <button type="button" class="button clear-button" onclick="limparPesquisa()">Limpar</button>
        </div>
    </form>

    <div class="products-container">
        <?php if (!empty($produtosFiltrados)): ?>
            <?php foreach ($produtosFiltrados as $produto): ?>
                <div class="product">
                    <div class="product-name"><?php echo htmlspecialchars($produto['nome']); ?></div>
                    <div class="product-details">
                        <p>Marca: <?php echo htmlspecialchars($produto['marca']); ?></p>
                        <p>Estado: <?php echo htmlspecialchars($produto['estado']); ?></p>
                        <p>Preço: R$ <?php echo htmlspecialchars($produto['preco']); ?></p>
                        <p>Relevância: <?php echo htmlspecialchars($produto['relevancia']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum produto encontrado.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    function limparPesquisa() {
        window.location.href = window.location.pathname; // Redirects to the same page without query parameters
    }
</script>

</body>
</html>
