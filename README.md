# WebSolana

WebSolana is an integrated web platform for managing assets, tokens, and command automation on the Solana network (Devnet), featuring advanced security support via WebAuthn (YubiKey) and Docker environment integration.

<img width="1914" height="1006" alt="image" src="https://github.com/user-attachments/assets/e65376fc-4d97-4b73-9cc5-efc48ba56e0f" />


## 🚀 Overview

This project serves as a centralized hub to administer servers (Minecraft, CS2, etc.) and manage an economy based on Solana tokens. It utilizes PHP for the web frontend/backend and Docker to isolate the Solana CLI, allowing for secure execution of blockchain commands.

## 📂 Project Structure

Below is a detailed explanation of each main folder and file:

### 📁 Root (`/`)
*   **`index.php`**: Main dashboard acting as a hub for different panels (Minecraft, CS2, Admin Control, and Solana).
*   **`shell.php`**: Script responsible for executing commands via PHP that interact directly with the Solana Docker container.
*   **`consulta.php`**: Endpoint for quick system or blockchain queries via API Key.
*   **`yubitest.php`**: Test script for validating YubiKey security key integration.
*   **`LICENSE`**: Project license file.

### 📁 `web_sol/` (Main Solana Portal)
Central folder for the Solana management interface.
*   **`index.php` / `Solana.php`**: Entry and landing page of the portal, protected by authentication. Now supports automatic language detection (EN, PT, ES) based on visitor IP.
*   **`lang_detector.php`**: Core script for automatic language detection using GeoIP API.
*   **`languages/`**: Folder containing translation files (`en.php`, `pt.php`, `es.php`).
*   **`process.php`**: Backend logic for the WebAuthn protocol (Registration and Login with YubiKey).
*   **`db.php`**: Main database connection configuration.
*   **`install.sh`**: Comprehensive automation script that installs Docker, Rust, Solana CLI, configures Apache2, and sets security permissions.
*   **`api_key.php`**: API key management and validation.

#### 📁 `web_sol/panda_full/` (Administrative System & Minecraft Integration)
Module focused on player administration and the "Panda" economy.
*   **`panda.php`**: Central panel of the Panda system.
*   **`jogadores.php`**: User/player listing and management.
*   **`buy.php`**: Processing of token or item purchases.
*   **`BANCO.js`**: **Minecraft Integration (Mineflayer)**. A bot that connects the Minecraft server to the database and the Solana network, allowing players to use in-game commands to manage their economies.
*   **`panda_full_db.sql`**: Database schema for this module.
*   **`connection.php` / `mysql.php`**: Connection scripts with SSL support for the MariaDB database.

#### 📁 `web_sol/caixa/` (Wallet Management & Cash Book)
Financial module for tracking transactions on the Solana network.
*   **`index.php`**: "Cash Book" interface for viewing transactions (refunds, transfers, purchases).
*   **`carteira.php`**: View of balance and wallet addresses.
*   **`transfer.php` / `transferi_p.php`**: Logic for token transfers between wallets.
*   **`db_connection.php`**: Specific connection for the financial module.
*   **`solanaLogo.74d35f7a.svg`**: Solana visual asset.

---

## 🎮 Minecraft Integration (AMAURI BOT)

The `BANCO.js` file contains a bot developed with **Mineflayer** that acts as an automated banker within the game.

**In-game Features:**
*   `!createpandawallet`: Creates a Solana wallet (Panda Full) for the player.
*   `!pandabalance`: Checks Panda Full token balance via Docker/Solana CLI.
*   `!solana`: Checks SOL balance (Devnet).
*   `!balance`: Verifies the balance in the server's internal bank.
*   `!buyapple`, `!buypickaxe`, etc.: Allows purchasing items (Enchanted Apple, Netherite Pickaxe) using the bank balance.
*   **Interest and Investment System**: The bot automatically manages investment growth and applies interest to debts at regular intervals.

---

## 🛠️ Technologies Used

*   **Languages**: PHP 8.x, JavaScript (Node.js/Vanilla), SQL, Bash.
*   **Blockchain**: Solana CLI (Devnet).
*   **Game Integration**: Mineflayer (Minecraft Bot).
*   **Infrastructure**: Docker (CLI Containerization), Apache2 (Web Server).
*   **Security**: WebAuthn / FIDO2 (YubiKey), MariaDB with SSL, API Key, GeoIP Detection.
*   **Support Languages**: Rust (required for Solana tools).

---

## ⚙️ Configuration and Installation

### 1. Prerequisites
The system is designed to run on Linux environments (Ubuntu/Debian).

### 2. Automatic Installation
The `web_sol/install.sh` file contains all necessary steps:
```bash
cd web_sol
chmod +x install.sh
./install.sh
```

**What the script does:**
1. Installs Docker and Docker Compose.
2. Creates a custom Docker image (`heysolana`) based on Debian, containing Rust and Solana CLI.
3. Configures Apache2 to allow overrides.
4. Sets permissions for the `www-data` user to execute Docker commands via `sudo` without a password (required for PHP-Solana integration).

### 3. Database
Import the provided `.sql` files in their respective modules:
*   `web_sol/panda_full/panda_full_db.sql`
*   Connection settings (IP, user, password) should be adjusted in `db.php`, `connection.php`, and `db_connection.php`.

### 4. Solana Security (Devnet)
The system uses the Devnet for testing. You can obtain free SOL for your wallet at:
[https://faucet.solana.com/](https://faucet.solana.com/)

---

## 🔒 Security

*   **WebAuthn**: Portal login is reinforced by hardware (YubiKey), making it immune to traditional phishing attacks.
*   **Sudoers**: Apache's access to Docker is restricted to the specific container command, minimizing privilege escalation risks.
*   **SSL MariaDB**: Support for encrypted connections between the web server and the database.
*   **IP-Based i18n**: Automatic language selection (English, Portuguese, Spanish) based on the user's region via GeoIP.

## 📝 Notes
This project is intended for fun, learning economic concepts, and experimenting with the Solana blockchain. The **SolanaDev** token used has no real financial value.
