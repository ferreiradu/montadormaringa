<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Eduardo - Montador de Móveis em Maringá</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="description" content="Montador de móveis em Maringá e região. Mais de 15 anos de experiência. Orçamento rápido pelo WhatsApp.">

  <!-- CSS -->
  <link rel="stylesheet" href="perfil.css">

  <!-- Fontes e Ícones -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<nav class="nav-topo">
  <a href="../index.html" class="voltar-home">
    <i class="fas fa-arrow-left"></i> Voltar para a página inicial
  </a>
</nav>

<!-- PERFIL -->
<section class="perfil">
  <img src="../Imagens/eduardo.png" alt="Eduardo Montador de Móveis" class="perfil-foto">

  <h1>Eduardo</h1>
  <p class="profissao">Montador Profissional de Móveis</p>

  <div class="info">
    <p><strong>Experiência:</strong> Desde 2009.</p>
    <p><strong>Serviços Executados:</strong> Montagem de móveis residenciais, corporativos, planejados, desmontagem e remontagem.</p>
    <p><strong>Área de atendimento:</strong> Maringá, Sarandí, Paiçandu, Marialva, Floriano, Floresta e região.</p>
  </div>

  <h3>Redes sociais</h3>

  <div class="redes">
    <a href="https://www.instagram.com/montadordemoveismaringa/" target="_blank" title="Instagram">
      <i class="fab fa-instagram"></i>
    </a>

    <a href="https://www.facebook.com/Montadormaringa" target="_blank" title="Facebook">
      <i class="fab fa-facebook-f"></i>
    </a>

    <a href="https://wa.me/message/E2F2BD5UIQKTN1?text=Ol%C3%A1%21%20Encontrei%20seu%20contato%20pelo%20site%20Montadores%20de%20M%C3%B3veis%20Maring%C3%A1%20e%20gostaria%20de%20solicitar%20um%20or%C3%A7amento."
       target="_blank"
       title="WhatsApp">
      <i class="fab fa-whatsapp"></i>
    </a>
  </div>
</section>

<!-- GALERIA -->
<section>
  <h2 class="titulo">Trabalhos Realizados</h2>

  <div class="slider">
    <button class="nav prev" onclick="voltar()">❮</button>
    <img id="slide" src="../Imagens/montagem (1).jpg" alt="Trabalho realizado">
    <button class="nav next" onclick="avancar()">❯</button>
  </div>
</section>

<!-- CTA -->
<section class="cta-orcamento">
  <a href="https://wa.me/message/E2F2BD5UIQKTN1?text=Ol%C3%A1%21%20Encontrei%20seu%20contato%20pelo%20site%20Montadores%20de%20M%C3%B3veis%20Maring%C3%A1%20e%20gostaria%20de%20solicitar%20um%20or%C3%A7amento."
     target="_blank"
     class="btn-orcamento">
    Solicitar Orçamento
  </a>
</section>

<!-- AVALIAÇÕES -->
<section class="avaliacoes">
  <h2 class="titulo">Avaliações dos Clientes</h2>

  <div class="avaliar">
    <input type="text" id="nomeCliente" name="nome" placeholder="Seu nome e sobrenome">

    <div class="estrelas" id="estrelas">
      <i class="fa-solid fa-star" data-valor="1"></i>
      <i class="fa-solid fa-star" data-valor="2"></i>
      <i class="fa-solid fa-star" data-valor="3"></i>
      <i class="fa-solid fa-star" data-valor="4"></i>
      <i class="fa-solid fa-star" data-valor="5"></i>
    </div>

    <input type="hidden" id="nota" value="0">

    <textarea id="comentario" name="comentario" placeholder="Conte como foi sua experiência"></textarea>

    <button onclick="enviarAvaliacao()">Enviar Avaliação</button>
  </div>

  <div id="lista-avaliacoes"></div>
</section>

<footer>
  © 2026 - Perfil Profissional
</footer>

<script src="perfil.js"></script>

</body>
</html>
