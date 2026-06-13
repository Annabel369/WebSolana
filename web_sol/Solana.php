<?php session_start(); if(!isset($_SESSION["usuario_logado"])){ header("Location: index.php?redirect=" . urlencode($_SERVER["REQUEST_URI"])); exit; } ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal SolanaDev - Web Sol</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: #1e293b;
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            max-width: 500px;
            width: 90%;
        }
        h1 {
            color: #38bdf8;
            margin-bottom: 2rem;
            font-size: 2rem;
        }
        .links {
            display: grid;
            gap: 1.5rem;
        }
        .card {
            background: #334155;
            padding: 1.5rem;
            border-radius: 0.75rem;
            text-decoration: none;
            color: white;
            transition: transform 0.2s, background 0.2s;
            border: 1px solid #475569;
        }
        .card:hover {
            transform: translateY(-5px);
            background: #475569;
            border-color: #38bdf8;
        }
        .card h2 {
            margin: 0;
            font-size: 1.25rem;
            color: #38bdf8;
        }
        .card p {
            margin: 0.5rem 0 0;
            font-size: 0.9rem;
            color: #94a3b8;
        }
        .logout {
            margin-top: 2rem;
            display: block;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.8rem;
        }
        .logout:hover {
            color: #38bdf8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Portal SolanaDev</h1>
        <div class="links">
            <a href="caixa/" class="card">
                <h2>📦 Caixa / Carteira</h2>
                <p>Gerenciamento de tokens e saldo do jogador.</p>
            </a>
            <a href="panda_full/" class="card">
                <h2>🐼 Panda Full</h2>
                <p>Sistema administrativo e integração completa.</p>
            </a>
        </div>
        <a href="logout.php" class="logout">Sair com Segurança (YubiKey)</a>
    </div>
</body>
</html>
