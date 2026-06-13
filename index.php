<?php
// Prevent unauthorized caching to ensure users always see the latest dashboard
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Control Dashboard</title>
    <!-- Google Fonts for premium typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Premium Dark Theme Colors */
            --bg-color: #0f172a;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.08);
            --glass-hover: rgba(255, 255, 255, 0.06);
            --primary-gradient: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            --mc-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --cs-gradient: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
            --other-gradient: linear-gradient(135deg, #64748b 0%, #475569 100%);
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(139, 92, 246, 0.15) 0px, transparent 50%);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            overflow-x: hidden;
        }

        /* Floating background ambient lights */
        .ambient-glow {
            position: fixed;
            width: 40vw;
            height: 40vw;
            border-radius: 50%;
            filter: blur(100px);
            z-index: -1;
            opacity: 0.3;
            pointer-events: none;
            animation: float 20s infinite alternate cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glow-1 { top: -20%; left: -10%; background: rgba(59, 130, 246, 0.4); }
        .glow-2 { bottom: -20%; right: -10%; background: rgba(139, 92, 246, 0.3); animation-delay: -5s; }

        .header {
            text-align: center;
            margin-bottom: 4rem;
            animation: fadeInDown 1s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .header h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
            letter-spacing: -1.5px;
        }

        .header p {
            font-size: clamp(1rem, 2vw, 1.25rem);
            color: var(--text-secondary);
            font-weight: 400;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            width: 100%;
            max-width: 1100px;
            animation: fadeInUp 1s cubic-bezier(0.4, 0, 0.2, 1) 0.2s forwards;
            opacity: 0;
        }

        .card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 2.5rem 2rem;
            text-decoration: none;
            color: var(--text-primary);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, rgba(255,255,255,0.06) 0%, rgba(255,255,255,0) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .card:hover {
            transform: translateY(-8px) scale(1.02);
            background: var(--glass-hover);
            border-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
        }

        .card:hover::after {
            opacity: 1;
        }

        .card-icon {
            width: 80px;
            height: 80px;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.3);
            transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 1;
        }

        .card:hover .card-icon {
            transform: translateY(-5px) scale(1.1) rotate(5deg);
        }

        .icon-mc { background: var(--mc-gradient); }
        .icon-cs { background: var(--cs-gradient); }
        .icon-panel { background: var(--primary-gradient); }
        .icon-admin { background: var(--other-gradient); }

        .card h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            z-index: 1;
            letter-spacing: -0.5px;
        }

        .card p {
            font-size: 0.95rem;
            color: var(--text-secondary);
            z-index: 1;
            line-height: 1.5;
        }

        .svg-icon {
            width: 40px;
            height: 40px;
            fill: #ffffff;
        }

        /* Animations */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, 50px) scale(1.1); }
            100% { transform: translate(-30px, 20px) scale(0.9); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            .card {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="ambient-glow glow-1"></div>
    <div class="ambient-glow glow-2"></div>

    <div class="header">
        <h1>Central de Servidores</h1>
        <p>Acesse rapidamente os painéis administrativos, configure seus servidores e gerencie recursos com facilidade.</p>
    </div>

    <div class="dashboard-grid">
        <!-- Minecraft Button -->
        <a href="/PanelMinecraft-main/" class="card">
            <div class="card-icon icon-mc">
                <svg class="svg-icon" viewBox="0 0 24 24"><path d="M2.5 10.5L12 4.5L21.5 10.5V13.5L12 19.5L2.5 13.5V10.5M12 6.5L4.5 11.2V12.8L12 17.5L19.5 12.8V11.2L12 6.5Z"/></svg>
            </div>
            <h2>Minecraft Panel</h2>
            <p>Gerenciamento completo para servidores e plugins do Minecraft.</p>
        </a>

        <!-- CS2 Button -->
        <a href="/PanelCS2_PHP_RCON2-main/" class="card">
            <div class="card-icon icon-cs">
                <svg class="svg-icon" viewBox="0 0 24 24"><path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M12,6A6,6 0 0,0 6,12A6,6 0 0,0 12,18A6,6 0 0,0 18,12A6,6 0 0,0 12,6M12,8A4,4 0 0,1 16,12A4,4 0 0,1 12,16A4,4 0 0,1 8,12A4,4 0 0,1 12,8Z"/></svg>
            </div>
            <h2>CS2 Panel</h2>
            <p>Administração RCON avançada para Counter-Strike 2.</p>
        </a>

        <!-- Index 22 Button -->
        <a href="/index22.php" class="card">
            <div class="card-icon icon-panel">
                <svg class="svg-icon" viewBox="0 0 24 24"><path d="M13,3V9H21V3M13,21H21V11H13M3,21H11V15H3M3,13H11V3H3V13Z"/></svg>
            </div>
            <h2>Painel OGP / Index 22</h2>
            <p>Acesse as configurações do painel antigo e sistemas base.</p>
        </a>

        <!-- Admin Control Button -->
        <a href="/AdminControl_PHP_PAINEL-main/" class="card">
            <div class="card-icon icon-admin">
                <svg class="svg-icon" viewBox="0 0 24 24"><path d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M12,3.19L19,6.3V11C19,15.52 16.09,19.7 12,20.93C7.91,19.7 5,15.52 5,11V6.3L12,3.19M11,7V13H13V7H11M11,15V17H13V15H11Z"/></svg>
            </div>
            <h2>Admin Control</h2>
            <p>Gerenciamento de usuários e controle geral da máquina.</p>
        </a>

        <!-- Solana Web Button -->
        <a href="/web_sol/" class="card">
            <div class="card-icon" style="background: linear-gradient(135deg, #9945FF 0%, #14F195 100%);">
                <svg class="svg-icon" viewBox="0 0 24 24"><path d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.41,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.59,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z"/></svg>
            </div>
            <h2>Solana Web Portal</h2>
            <p>Gerenciamento de tokens, carteiras e integração com Minecraft.</p>
        </a>
    </div>
</body>
</html>
