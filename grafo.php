<?php

/**
 * Classe para representar um Grafo usando Lista de Adjacência.
 */
class Grafo
{
    /**
     * @var array $adjacencias A lista de adjacência para armazenar o grafo.
     * A chave é o nó e o valor é um array de seus vizinhos.
     * Exemplo: ['A' => ['B', 'C'], 'B' => ['A'], 'C' => ['A']]
     */
    private array $adjacencias = [];

    /**
     * Adiciona um nó ao grafo.
     *
     * @param string|int $no O nó a ser adicionado.
     * @return bool Retorna true se o nó foi adicionado, false se já existir.
     */
    public function adicionarNo(string|int $no): bool
    {
        // Verifica se o nó já existe
        if (!isset($this->adjacencias[$no])) {
            $this->adjacencias[$no] = []; // Inicializa a lista de adjacência para este nó como vazia
            return true;
        }
        return false; // Nó já existe
    }

    /**
     * Adiciona uma aresta entre dois nós.
     * Se o grafo não for direcionado, a aresta é adicionada nos dois sentidos.
     *
     * @param string|int $no1 O primeiro nó.
     * @param string|int $no2 O segundo nó.
     * @param bool $direcionado Se o grafo é direcionado (padrão: false).
     * @return bool Retorna true se a aresta foi adicionada, false caso contrário (ex: nós não existem).
     */
    public function adicionarAresta(string|int $no1, string|int $no2, bool $direcionado = false): bool
    {
        // Garante que ambos os nós existam antes de adicionar a aresta
        $this->adicionarNo($no1);
        $this->adicionarNo($no2);

        // Adiciona a aresta de no1 para no2
        if (!in_array($no2, $this->adjacencias[$no1])) {
            $this->adjacencias[$no1][] = $no2;
        }

        // Se o grafo não for direcionado, adiciona a aresta de no2 para no1 também
        if (!$direcionado) {
            if (!in_array($no1, $this->adjacencias[$no2])) {
                $this->adjacencias[$no2][] = $no1;
            }
        }
        return true;
    }

    /**
     * Retorna a lista de adjacência.
     *
     * @return array A representação da lista de adjacência do grafo.
     */
    public function obterListaAdjacencia(): array
    {
        return $this->adjacencias;
    }

    /**
     * Exibe a lista de adjacência de forma legível.
     *
     * @return string A representação textual da lista de adjacência.
     */
    public function exibirListaAdjacencia(): string
    {
        $output = "<h2>Lista de Adjacência:</h2><ul>";
        if (empty($this->adjacencias)) {
            $output .= "<li>O grafo está vazio.</li>";
        } else {
            foreach ($this->adjacencias as $no => $vizinhos) {
                $output .= "<li><strong>" . htmlspecialchars((string)$no) . ":</strong> ";
                if (empty($vizinhos)) {
                    $output .= "Nenhum vizinho";
                } else {
                    $output .= htmlspecialchars(implode(', ', array_map('strval', $vizinhos)));
                }
                $output .= "</li>";
            }
        }
        $output .= "</ul>";
        return $output;
    }
}

// Inicia a sessão para persistir o grafo entre as requisições
session_start();

// Se não existir um grafo na sessão, cria um novo
if (!isset($_SESSION['grafo'])) {
    $_SESSION['grafo'] = new Grafo();
}

/** @var Grafo $meuGrafo */
$meuGrafo = $_SESSION['grafo'];
$mensagem = '';

// Processa o formulário para adicionar nó
if (isset($_POST['adicionar_no'])) {
    $no = trim($_POST['no']);
    if (!empty($no)) {
        if ($meuGrafo->adicionarNo($no)) {
            $mensagem = "<p style='color:green;'>Nó '" . htmlspecialchars($no) . "' adicionado com sucesso!</p>";
        } else {
            $mensagem = "<p style='color:orange;'>Nó '" . htmlspecialchars($no) . "' já existe.</p>";
        }
    } else {
        $mensagem = "<p style='color:red;'>Por favor, insira um nome para o nó.</p>";
    }
    // Atualiza o grafo na sessão
    $_SESSION['grafo'] = $meuGrafo;
}

// Processa o formulário para adicionar aresta
if (isset($_POST['adicionar_aresta'])) {
    $no1 = trim($_POST['no1']);
    $no2 = trim($_POST['no2']);
    $direcionado = isset($_POST['direcionado']); // Verifica se a checkbox foi marcada

    if (!empty($no1) && !empty($no2)) {
        if ($meuGrafo->adicionarAresta($no1, $no2, $direcionado)) {
            $mensagem = "<p style='color:green;'>Aresta entre '" . htmlspecialchars($no1) . "' e '" . htmlspecialchars($no2) . "' adicionada com sucesso!</p>";
        } else {
            // Esta condição pode precisar de lógica mais específica se adicionarAresta retornar false em outros cenários
            $mensagem = "<p style='color:red;'>Erro ao adicionar aresta.</p>";
        }
    } else {
        $mensagem = "<p style='color:red;'>Por favor, insira os nomes para ambos os nós da aresta.</p>";
    }
    // Atualiza o grafo na sessão
    $_SESSION['grafo'] = $meuGrafo;
}

// Processa o formulário para resetar o grafo
if (isset($_POST['resetar_grafo'])) {
    $_SESSION['grafo'] = new Grafo();
    $meuGrafo = $_SESSION['grafo']; // Garante que a variável local também seja atualizada
    $mensagem = "<p style='color:blue;'>Grafo resetado com sucesso!</p>";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>TPE-II parte 2</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1, h2 { color: #333; }
        form { margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; border-radius: 4px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="submit"], button {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"], button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border-color: #007bff;
        }
        input[type="submit"]:hover, button:hover {
            background-color: #0056b3;
        }
        .reset-button { background-color: #dc3545; border-color: #dc3545; }
        .reset-button:hover { background-color: #c82333; }
        ul { list-style-type: none; padding-left: 0; }
        li { background-color: #e9e9e9; margin-bottom: 5px; padding: 8px; border-radius: 3px; }
        p { margin-top: 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Adjacência Interativa by Jonathan Bufon</h1>

        <?php if (!empty($mensagem)) echo $mensagem; ?>

        <h2>Adicionar Nó</h2>
        <form method="post" action="">
            <label for="no">Nome do Nó:</label>
            <input type="text" id="no" name="no" required>
            <input type="submit" name="adicionar_no" value="Adicionar Nó">
        </form>

        <h2>Adicionar Aresta</h2>
        <form method="post" action="">
            <label for="no1">Nó de Origem:</label>
            <input type="text" id="no1" name="no1" required>
            <br>
            <label for="no2">Nó de Destino:</label>
            <input type="text" id="no2" name="no2" required>
            <br>
            <input type="checkbox" id="direcionado" name="direcionado" value="1">
            <label for="direcionado" style="display: inline;">Aresta Direcionada?</label>
            <br><br>
            <input type="submit" name="adicionar_aresta" value="Adicionar Aresta">
        </form>

        <?php
        // Exibe a lista de adjacência atual
        echo $meuGrafo->exibirListaAdjacencia();
        ?>

        <h2>Opções</h2>
        <form method="post" action="">
            <input type="submit" name="resetar_grafo" value="Resetar Grafo" class="reset-button" onclick="return confirm('Tem certeza que deseja resetar o grafo?');">
        </form>
    </div>
</body>
</html>