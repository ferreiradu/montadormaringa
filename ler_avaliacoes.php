<?php
header('Content-Type: application/json');

// Caminho do arquivo JSON
$arquivo = __DIR__ . '/data/avaliacoes.json';

// Lê avaliações ou retorna vazio
$avaliacoes = file_exists($arquivo) ? json_decode(file_get_contents($arquivo), true) : [];

// Retorna o JSON
echo json_encode($avaliacoes);
?>
