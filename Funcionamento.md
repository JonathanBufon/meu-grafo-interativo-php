# Documentação Completa do Código: Grafo Interativo em PHP (`grafo.php`)

## 1. Visão Geral

O arquivo `grafo.php` é uma aplicação web autônoma que implementa uma estrutura de dados de grafo utilizando listas de adjacência em PHP. Ele fornece uma interface HTML interativa que permite aos usuários adicionar nós (vértices), criar arestas (conexões) entre esses nós (de forma direcionada ou não direcionada), visualizar a representação do grafo como uma lista de adjacência e resetar o grafo para um estado inicial. O estado do grafo é mantido entre as interações do usuário através do uso de sessões PHP.

## 2. Estrutura do Arquivo

O arquivo pode ser dividido nas seguintes seções principais:

1. **Definição da Classe `Grafo`**: Contém toda a lógica para representar e manipular o grafo.
2. **Gerenciamento de Sessão**: Código para iniciar a sessão e persistir o objeto grafo.
3. **Processamento de Formulários**: Lógica PHP para lidar com as submissões dos formulários HTML (adicionar nó, adicionar aresta, resetar).
4. **Estrutura HTML**: Código HTML que define a interface do usuário, incluindo os formulários e a área de exibição da lista de adjacência.

---

## 3. Classe `Grafo`

Esta classe é o núcleo da aplicação, responsável por definir a estrutura e o comportamento do grafo.

```php
/**
 * Classe para representar um Grafo usando Lista de Adjacência.
 */
class Grafo
{
    // ... corpo da classe ...
```

### 3.1. Propriedades

#### `private array $adjacencias = [];`

* **Objetivo:** Armazenar a estrutura do grafo em si.
* **Funcionamento:** É um array associativo PHP. Cada chave representa um identificador único de um nó. O valor é um array com os nós diretamente conectados a este.
* **Exemplo de Estrutura:** `['A' => ['B', 'C'], 'B' => ['A'], 'C' => ['A']]`
* **Visibilidade:** `private` para garantir encapsulamento.
* **Justificativa:** Representação eficiente para grafos esparsos.

### 3.2. Métodos

#### `public function adicionarNo(string|int $no): bool`

* Adiciona um novo vértice ao grafo se ele não existir.
* Verifica com `isset`, adiciona como array vazio se não existir.
* Retorna `true` se adicionado, `false` se já existir.

#### `public function adicionarAresta(string|int $no1, string|int $no2, bool $direcionado = false): bool`

* Cria uma aresta entre \$no1 e \$no2.
* Garante existência dos nós, evita duplicatas com `in_array`.
* Se não direcionado, adiciona em ambas direções.
* Retorna sempre `true`.

#### `public function obterListaAdjacencia(): array`

* Retorna a lista de adjacência do grafo como array.
* Usado para inspecionar ou processar a estrutura do grafo externamente.

#### `public function exibirListaAdjacencia(): string`

* Retorna uma string HTML com a representação da lista de adjacência.
* Usa `htmlspecialchars` para evitar XSS.
* Formata os dados para exibição em `<ul>`.

---

## 4. Lógica Principal do Script (Fora da Classe)

### 4.1. Gerenciamento de Sessão

* Usa `session_start()` para manter o grafo entre requisições.
* Se `$_SESSION['grafo']` não existir, cria novo `Grafo`.
* Guarda o objeto grafo atualizado em `$_SESSION` após cada operação.

### 4.2. Processamento de Formulários

#### Adicionar Nó

* Disparado com `isset($_POST['adicionar_no'])`
* Verifica se o nome do nó não está vazio, chama `adicionarNo()`.
* Retorna mensagem apropriada ao usuário.

#### Adicionar Aresta

* Disparado com `isset($_POST['adicionar_aresta'])`
* Coleta \$no1, \$no2 e se é direcionada.
* Verifica se ambos os nós estão preenchidos, chama `adicionarAresta()`.
* Exibe mensagem de sucesso ou erro.

#### Resetar Grafo

* Disparado com `isset($_POST['resetar_grafo'])`
* Substitui o objeto grafo atual por um novo.
* Exibe mensagem informando o reset.

---

## 5. Estrutura HTML

A porção final do `grafo.php` é composta por:

* `<head>`: charset UTF-8, título "TPE-II parte 2" e CSS para estilo básico.
* `<body>`: Formulários para adicionar nós, arestas e resetar.
* Saída da lista de adjacência com base em `exibirListaAdjacencia()`.

