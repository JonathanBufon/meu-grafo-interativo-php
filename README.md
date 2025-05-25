# Lista de Adjacência Interativa - Jonathan Bufon (TPE-II Parte 2)

Este projeto implementa uma lista de adjacência em PHP e HTML para a representação interativa de grafos. A interface web permite ao usuário adicionar nós, criar arestas (direcionadas ou não direcionadas) e visualizar a estrutura do grafo em tempo real. Desenvolvido como Trabalho Prático Escolar II (TPE-II), Parte 2, este trabalho foi realizado durante o 3º semestre do curso de Ciência da Computação na Unochapecó (Universidade Comunitária da Região de Chapecó).

## Pré-requisitos

Para utilizar esta aplicação, você precisará de:

1.  **PHP Instalado:** Certifique-se de que o PHP (versão 5.4 ou superior para o servidor embutido) está instalado na sua máquina e acessível através da linha de comando.
2.  Um navegador web (Ex: Chrome, Firefox, Edge, Safari).

## Configuração e Inicialização

Existem duas maneiras principais de executar este projeto:

**Opção 1: Usando um Servidor Web Tradicional (XAMPP, WAMP, MAMP, etc.)**

1.  **Obtenha o Código:** Certifique-se de ter o arquivo PHP contendo o código da aplicação (geralmente salvo como `grafo.php` ou o nome que você deu ao script principal).
2.  **Mova para o Diretório do Servidor:** Coloque o arquivo PHP em um diretório que seja servido pelo seu servidor web (por exemplo, `htdocs` no XAMPP, `www` no WAMP).
3.  **Inicie o Servidor Web:** Se ainda não estiver rodando, inicie o seu servidor Apache (ou similar) através do painel de controle do XAMPP/WAMP/MAMP.
4.  **Acesse via Navegador:** Abra seu navegador e acesse a URL correspondente ao local do arquivo.
    * Se você colocou diretamente na raiz do servidor (ex: `htdocs`): `http://localhost/nome_do_seu_arquivo.php`
    * Se você criou uma subpasta (ex: `htdocs/meu_projeto_grafo/`): `http://localhost/meu_projeto_grafo/nome_do_seu_arquivo.php`

**Opção 2: Usando o Servidor Web Embutido do PHP (Recomendado para desenvolvimento simples)**

Se você tem o PHP instalado e adicionado ao PATH do seu sistema, esta é uma forma rápida de rodar a aplicação.

1.  **Obtenha o Código:** Salve o arquivo PHP (ex: `grafo.php`) em uma pasta no seu computador (por exemplo, `C:\projetos\meu_grafo\` ou `~/projetos/meu_grafo/`).
2.  **Abra o Terminal/Prompt de Comando:**
    * No Windows: Abra o Prompt de Comando (cmd) ou PowerShell.
    * No macOS/Linux: Abra o Terminal.
3.  **Navegue até a Pasta do Projeto:** Use o comando `cd` para navegar até o diretório onde você salvou o arquivo `grafo.php`.
    * Exemplo: `cd C:\projetos\meu_grafo\`
    * Exemplo: `cd ~/projetos/meu_grafo/`
4.  **Inicie o Servidor Embutido:** Dentro da pasta do projeto, execute o seguinte comando:
    ```bash
    php -S localhost:8000
    ```
    * Você pode escolher outra porta se a `8000` estiver em uso (ex: `php -S localhost:8080`).
    * O terminal indicará que o servidor foi iniciado (ex: `PHP ... Development Server (http://localhost:8000) started`). Não feche esta janela do terminal enquanto estiver usando a aplicação, pois ela é o servidor.
5.  **Acesse via Navegador:** Abra seu navegador e acesse a URL:
    ```
    http://localhost:8000/nome_do_seu_arquivo.php
    ```
    (Substitua `nome_do_seu_arquivo.php` pelo nome real do seu arquivo, por exemplo, `http://localhost:8000/grafo.php`). Se o seu arquivo PHP se chamar `index.php`, você pode acessar apenas `http://localhost:8000/`.

Ao acessar a página, você verá a interface da aplicação com o título da aba do navegador como **"TPE-II parte 2"** e o título principal na página como **"Lista de Adjacência Interativa by Jonathan Bufon"**.

## Como Utilizar a Interface HTML

A página é dividida em algumas seções principais:

* **Título da Aba:** "TPE-II parte 2"
* **Título Principal na Página:** "Lista de Adjacência Interativa by Jonathan Bufon"
* **Mensagens:** Uma área onde mensagens de sucesso ou erro são exibidas após cada ação.
* **Formulário "Adicionar Nó":** Para criar novos nós no seu grafo.
* **Formulário "Adicionar Aresta":** Para conectar os nós existentes (ou criar novos nós e conectá-los).
* **"Lista de Adjacência:":** Exibe a estrutura atual do grafo.
* **Seção "Opções":** Contém o botão para resetar o grafo.

### 1. Adicionando um Nó

Os nós são os elementos fundamentais do seu grafo.

1.  Vá para o formulário **"Adicionar Nó"**.
2.  No campo **"Nome do Nó:"**, digite o identificador único para o seu nó (ex: `A`, `Vertice1`, `10`).
3.  Clique no botão **"Adicionar Nó"**.
4.  Uma mensagem de confirmação (ou erro, se o nó já existir ou o nome for inválido) aparecerá.
5.  O novo nó será exibido na **"Lista de Adjacência:"**, inicialmente sem vizinhos.
    * Exemplo: `A: Nenhum vizinho`

### 2. Adicionando uma Aresta

As arestas conectam os nós. Elas podem ser não direcionadas (uma conexão mútua) ou direcionadas (uma conexão em um único sentido).

1.  Vá para o formulário **"Adicionar Aresta"**.
2.  No campo **"Nó de Origem:"**, digite o nome de um nó existente (ou um novo nó que será criado).
3.  No campo **"Nó de Destino:"**, digite o nome de outro nó existente (ou um novo nó que será criado).
4.  **Para uma aresta não direcionada (padrão):** Deixe a caixa de seleção **"Aresta Direcionada?"** desmarcada.
    * Isso significa que se você criar uma aresta de `A` para `B`, `B` também estará conectado a `A`.
5.  **Para uma aresta direcionada:** Marque a caixa de seleção **"Aresta Direcionada?"**.
    * Isso significa que se você criar uma aresta de `A` para `B`, a conexão é apenas de `A` para `B`, não o contrário (a menos que você crie explicitamente uma aresta de `B` para `A`).
6.  Clique no botão **"Adicionar Aresta"**.
7.  Uma mensagem de confirmação (ou erro) aparecerá.
8.  A **"Lista de Adjacência:"** será atualizada para refletir a nova conexão.
    * Exemplo (aresta não direcionada entre A e B):
        ```
        A: B
        B: A
        ```
    * Exemplo (aresta direcionada de A para C):
        ```
        A: B, C  (Se A já tinha B como vizinho)
        B: A
        C: Nenhum vizinho (ou outros vizinhos se já os tivesse)
        ```

    *Nota: Se você tentar adicionar uma aresta para nós que ainda não existem, eles serão automaticamente criados e adicionados ao grafo.*

### 3. Visualizando a Lista de Adjacência

A seção **"Lista de Adjacência:"** é atualizada automaticamente após cada operação bem-sucedida. Ela mostra cada nó do grafo e, ao lado dele, uma lista dos nós aos quais ele está conectado (seus vizinhos).

* **Formato:** `NÓ: Vizinho1, Vizinho2, ...`
* Se um nó não tem conexões, será exibido: `NÓ: Nenhum vizinho`
* Se o grafo estiver completamente vazio, será exibido: `O grafo está vazio.`

### 4. Resetando o Grafo

Se você quiser limpar o grafo atual e começar do zero:

1.  Vá para a seção **"Opções"**.
2.  Clique no botão **"Resetar Grafo"**.
3.  Uma caixa de diálogo de confirmação aparecerá no seu navegador. Clique em "OK" (ou equivalente) para confirmar.
4.  Uma mensagem "Grafo resetado com sucesso!" será exibida.
5.  A **"Lista de Adjacência:"** mostrará "O grafo está vazio."

## Persistência de Dados

O estado atual do seu grafo é armazenado usando sessões PHP. Isso significa que:

* Enquanto você mantiver a janela/aba do navegador aberta e a sessão PHP ativa (e o servidor embutido rodando, se for o caso), o grafo permanecerá como você o construiu, mesmo que você recarregue a página.
* Se você fechar o navegador e abri-lo novamente, ou se a sessão PHP expirar (ou o servidor embutido for parado e reiniciado), o grafo será perdido e você começará com um grafo vazio na próxima vez que acessar a página (a menos que o cookie de sessão ainda seja válido e a sessão não tenha expirado no servidor).

## Exemplo de Uso

1.  **Adicionar Nós:**
    * Adicione o nó `EstacaoA`.
    * Adicione o nó `ParadaB`.
    * Adicione o nó `DestinoC`.
2.  **Adicionar Arestas:**
    * Crie uma aresta não direcionada entre `EstacaoA` e `ParadaB`.
    * Crie uma aresta direcionada de `ParadaB` para `DestinoC`.
3.  **Visualizar:**
    A lista de adjacência deverá mostrar algo como:
    ```
    EstacaoA: ParadaB
    ParadaB: EstacaoA, DestinoC
    DestinoC: Nenhum vizinho
    ```

Divirta-se construindo seus grafos!
