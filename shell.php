<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$command = "sudo -u www-data docker run --rm -v /root/solana:/solana-token -v /root/solana/solana-data:/root/.config/solana heysolana ls";
$output = shell_exec($command);

echo "<pre>Comando executado: $command</pre>";
echo "<pre>Saída do comando:\n$output</pre>";
?>
