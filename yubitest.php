<?php
// Teste de interface para Chave de Segurança (FIDO2/WebAuthn)
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste de Hardware YubiKey</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; text-align: center; padding: 50px; }
        .box { background: white; padding: 20px; border-radius: 8px; display: inline-block; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        button { padding: 10px 20px; font-size: 16px; cursor: pointer; background: #0078d4; color: white; border: none; border-radius: 4px; }
        #status { margin-top: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Teste de Comunicação FIDO2</h2>
        <p>Clique no botão e insira sua YubiKey quando solicitado.</p>
        <button onclick="testKey()">Testar Minha Chave</button>
        <div id="status"></div>
    </div>

    <script>
        async function testKey() {
            const status = document.getElementById('status');
            status.innerText = "Verificando suporte...";

            if (!window.PublicKeyCredential) {
                status.innerText = "Erro: Este navegador não suporta WebAuthn.";
                return;
            }

            // Simulação de um desafio (Challenge) enviado pelo servidor
            const challenge = new Uint8Array(32);
            window.crypto.getRandomValues(challenge);

            const options = {
                publicKey: {
                    challenge: challenge,
                    rp: { name: "Teste Local" },
                    user: {
                        id: Uint8Array.from("1234", c => c.charCodeAt(0)),
                        name: "amauri@teste",
                        displayName: "Amauri"
                    },
                    pubKeyCredParams: [{ alg: -7, type: "public-key" }], // ES256
                    timeout: 60000,
                    attestation: "direct"
                }
            };

            try {
                status.innerText = "Aguardando toque na YubiKey...";
                const credential = await navigator.credentials.create(options);
                status.style.color = "green";
                status.innerText = "Sucesso! A chave respondeu corretamente.";
                console.log(credential);
            } catch (err) {
                status.style.color = "red";
                status.innerText = "Erro no teste: " + err.message;
            }
        }
    </script>
</body>
</html>
