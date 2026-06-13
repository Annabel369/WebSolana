# WebSolana

WebSolana é uma plataforma web integrada para gerenciamento de ativos, tokens e automação de comandos na rede Solana (Devnet), com suporte avançado a segurança via WebAuthn (YubiKey) e integração com ambientes Docker.

## 🚀 Visão Geral

Este projeto serve como um hub centralizado para administrar servidores (Minecraft, CS2, etc.) e gerenciar uma economia baseada em tokens Solana. Ele utiliza PHP para o frontend/backend web e Docker para isolar a CLI da Solana, permitindo execuções seguras de comandos de blockchain.

## 📂 Estrutura do Projeto

Abaixo está a explicação detalhada de cada pasta e arquivo principal:

### 📁 Raiz (`/`)
*   **`index.php`**: Dashboard principal que atua como hub para diferentes painéis (Minecraft, CS2, Admin Control e Solana).
*   **`shell.php`**: Script responsável por executar comandos via PHP que interagem diretamente com o container Docker da Solana.
*   **`consulta.php`**: Endpoint para consultas rápidas ao sistema ou blockchain via API Key.
*   **`yubitest.php`**: Script de teste para validação da integração com chaves de segurança YubiKey.
*   **`LICENSE`**: Arquivo de licença do projeto.

### 📁 `web_sol/` (Portal Solana Principal)
Pasta central para a interface de gerenciamento Solana.
*   **`index.php` / `Solana.php`**: Página de entrada e landing page do portal, protegida por autenticação.
*   **`process.php`**: Lógica de backend para o protocolo WebAuthn (Registro e Login com YubiKey).
*   **`db.php`**: Configuração de conexão com o banco de dados principal.
*   **`install.sh`**: Script de automação completo que instala Docker, Rust, Solana CLI, configura Apache2 e define permissões de segurança.
*   **`api_key.php`**: Gerenciamento e validação de chaves de API.

#### 📁 `web_sol/panda_full/` (Sistema Administrativo e Integração Minecraft)
Módulo focado na administração de jogadores e economia "Panda".
*   **`panda.php`**: Painel central do sistema Panda.
*   **`jogadores.php`**: Listagem e gerenciamento de usuários/jogadores.
*   **`buy.php`**: Processamento de compras de tokens ou itens.
*   **`BANCO.js`**: **Integração Minecraft (Mineflayer)**. Um bot que conecta o servidor Minecraft ao banco de dados e à rede Solana, permitindo que jogadores usem comandos in-game para gerenciar suas economias.
*   **`panda_full_db.sql`**: Esquema do banco de dados para este módulo.
*   **`connection.php` / `mysql.php`**: Scripts de conexão com suporte a SSL para o banco MariaDB.

#### 📁 `web_sol/caixa/` (Gestão de Carteira e Livro Caixa)
Módulo financeiro para rastreio de transações na rede Solana.
*   **`index.php`**: Interface do "Livro Caixa" para visualizar transações (reembolsos, transferências, compras).
*   **`carteira.php`**: Visualização de saldo e endereços de carteira.
*   **`transfer.php` / `transferi_p.php`**: Lógica para transferência de tokens entre carteiras.
*   **`db_connection.php`**: Conexão específica para o módulo financeiro.
*   **`solanaLogo.74d35f7a.svg`**: Ativo visual da Solana.

---

## 🎮 Integração Minecraft (BOT AMAURI)

O arquivo `BANCO.js` contém um bot desenvolvido com **Mineflayer** que atua como um banqueiro automatizado dentro do jogo.

**Funcionalidades in-game:**
*   `!createpandawallet`: Cria uma carteira Solana (Panda Full) para o jogador.
*   `!pandabalance`: Consulta o saldo de tokens Panda Full via Docker/Solana CLI.
*   `!solana`: Consulta o saldo de SOL (Devnet).
*   `!balance`: Verifica o saldo no banco interno do servidor.
*   `!buyapple`, `!buypickaxe`, etc.: Permite a compra de itens (Maçã Encantada, Picareta de Netherite) usando o saldo do banco.
*   **Sistema de Juros e Investimentos**: O bot gerencia automaticamente o crescimento de investimentos e a aplicação de juros em dívidas a cada intervalo de tempo.

---

## 🛠️ Tecnologias Utilizadas

*   **Linguagens**: PHP 8.x, JavaScript (Node.js/Vanilla), SQL, Bash.
*   **Blockchain**: Solana CLI (Devnet).
*   **Integração Game**: Mineflayer (Bot de Minecraft).
*   **Infraestrutura**: Docker (Containerização da CLI), Apache2 (Servidor Web).
*   **Segurança**: WebAuthn / FIDO2 (YubiKey), MariaDB com SSL, API Key.
*   **Linguagens de Suporte**: Rust (necessário para ferramentas Solana).

---

## ⚙️ Configurações e Instalação

### 1. Pré-requisitos
O sistema foi desenhado para rodar em ambientes Linux (Ubuntu/Debian).

### 2. Instalação Automática
O arquivo `web_sol/install.sh` contém todos os passos necessários:
```bash
cd web_sol
chmod +x install.sh
./install.sh
```

**O que o script faz:**
1. Instala o Docker e Docker Compose.
2. Cria uma imagem Docker customizada (`heysolana`) baseada em Debian, contendo Rust e Solana CLI.
3. Configura o Apache2 para permitir overrides.
4. Define permissões para o usuário `www-data` executar comandos Docker via `sudo` sem senha (necessário para a integração PHP-Solana).

### 3. Banco de Dados
Importe os arquivos `.sql` fornecidos nos respectivos módulos:
*   `web_sol/panda_full/panda_full_db.sql`
*   As configurações de conexão (IP, usuário, senha) devem ser ajustadas em `db.php`, `connection.php` e `db_connection.php`.

### 4. Segurança Solana (Devnet)
O sistema utiliza a Devnet para testes. Você pode obter SOL gratuito para sua carteira em:
[https://faucet.solana.com/](https://faucet.solana.com/)

---

## 🔒 Segurança

*   **WebAuthn**: O login no portal Solana é reforçado por hardware (YubiKey), tornando-o imune a ataques de phishing tradicionais.
*   **Sudoers**: O acesso do Apache ao Docker é restrito ao comando específico do container, minimizando riscos de escalada de privilégio.
*   **SSL MariaDB**: Suporte a conexões criptografadas entre o servidor web e o banco de dados.

## 📝 Notas
Este projeto é voltado para diversão, aprendizado de conceitos econômicos e experimentação com a blockchain Solana. O token **SolanaDev** utilizado não possui valor financeiro real.
