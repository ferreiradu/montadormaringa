<?php
header('Content-Type: application/json; charset=utf-8');

// ===== RECEBE E SANITIZA DADOS =====
$nome = isset($_POST['nome']) 
    ? htmlspecialchars(trim($_POST['nome']), ENT_QUOTES, 'UTF-8') 
    : '';

$comentario = isset($_POST['comentario']) 
    ? htmlspecialchars(trim($_POST['comentario']), ENT_QUOTES, 'UTF-8') 
    : '';

$nota = isset($_POST['nota']) ? intval($_POST['nota']) : 0;

// ===== VALIDAÇÕES =====
if ($nome === '' || $comentario === '') {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Preencha todos os campos.'
    ]);
    exit;
}

if ($nota < 1 || $nota > 5) {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Nota inválida. Selecione de 1 a 5 estrelas.'
    ]);
    exit;
}

// ===== CAMINHO DO ARQUIVO =====
$arquivo = __DIR__ . '/data/avaliacoes.json';

// ===== LÊ AVALIAÇÕES EXISTENTES =====
if (file_exists($arquivo)) {
    $avaliacoes = json_decode(file_get_contents($arquivo), true);
    if (!is_array($avaliacoes)) {
        $avaliacoes = [];
    }
} else {
    $avaliacoes = [];
}

// ===== NOVA AVALIAÇÃO =====
$novaAvaliacao = [
    'nome'       => $nome,
    'comentario' => $comentario,
    'nota'       => $nota,
    'data'       => date('c'), // ISO 8601
    'status'     => 'analise'  // aprovado | analise
];

// ===== ADICIONA AO ARRAY =====
$avaliacoes[] = $novaAvaliacao;

// ===== SALVA NO JSON =====
file_put_contents(
    $arquivo,
    json_encode($avaliacoes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

// ===== RETORNO =====
echo json_encode([
    'status' => 'sucesso',
    'mensagem' => 'Avaliação enviada com sucesso!'
]);
