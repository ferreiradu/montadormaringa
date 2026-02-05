// ================= GALERIA =================
const imagens = [
  "../Imagens/montagem (1).jpg",
  "../Imagens/montagem (2).jpg",
  "../Imagens/montagem (3).jpg"
];

let index = 0;
const slide = document.getElementById("slide");

function avancar() {
  index = (index + 1) % imagens.length;
  slide.src = imagens[index];
}

function voltar() {
  index = (index - 1 + imagens.length) % imagens.length;
  slide.src = imagens[index];
}

// ================= TEMPO (ESTILO GOOGLE) =================
function tempoAtras(data) {
  const diff = Math.floor((new Date() - new Date(data)) / 1000);

  if (diff < 60) return "agora mesmo";
  if (diff < 3600) return `${Math.floor(diff / 60)} minutos atrás`;
  if (diff < 86400) return `${Math.floor(diff / 3600)} horas atrás`;
  if (diff < 2592000) return `${Math.floor(diff / 86400)} dias atrás`;
  if (diff < 31536000) return `${Math.floor(diff / 2592000)} meses atrás`;
  return `${Math.floor(diff / 31536000)} anos atrás`;
}

// ================= AVALIAÇÃO POR ESTRELAS =================
let notaSelecionada = 0;
let estrelas = [];
let inputNota;

function iniciarEstrelas() {
  estrelas = document.querySelectorAll("#estrelas i");
  inputNota = document.getElementById("nota");

  if (!estrelas.length || !inputNota) return;

  estrelas.forEach(estrela => {
    estrela.addEventListener("click", () => {
      notaSelecionada = parseInt(estrela.dataset.valor);
      inputNota.value = notaSelecionada;

      estrelas.forEach(e => {
        e.classList.toggle("ativa", parseInt(e.dataset.valor) <= notaSelecionada);
      });
    });
  });
}

// ================= GERAR ESTRELAS VISUAIS =================
function gerarEstrelas(nota) {
  let html = "";
  for (let i = 1; i <= 5; i++) {
    html += i <= nota ? "★" : "☆";
  }
  return html;
}

// ================= ENVIAR AVALIAÇÃO =================
function enviarAvaliacao() {
  const nomeInput = document.getElementById("nomeCliente");
  const comentarioInput = document.getElementById("comentario");

  const nome = nomeInput.value.trim();
  const comentario = comentarioInput.value.trim();
  const nota = inputNota ? inputNota.value : 0;

  if (!nome || !comentario) {
    alert("Por favor, preencha todos os campos.");
    return;
  }

  if (nota < 1 || nota > 5) {
    alert("Selecione uma nota de 1 a 5 estrelas.");
    return;
  }

  fetch("../salvar_avaliacoes.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: `nome=${encodeURIComponent(nome)}&comentario=${encodeURIComponent(comentario)}&nota=${nota}`
  })
  
    .then(res => res.json())
    .then(data => {
      if (data.status === "sucesso") {
        nomeInput.value = "";
        comentarioInput.value = "";
        inputNota.value = 0;
        notaSelecionada = 0;

        estrelas.forEach(e => e.classList.remove("ativa"));

        listarAvaliacoes();
        alert("Avaliação enviada! Ela será exibida após análise.");
      } else {
        alert(data.mensagem || "Erro ao enviar avaliação.");
      }
    })
    .catch(() => {
      alert("Erro de conexão. Tente novamente.");
    });
}

// ================= LISTAR AVALIAÇÕES =================
function listarAvaliacoes() {
  fetch("../ler_avaliacoes.php")
    .then(res => res.json())
    .then(avaliacoes => {
      const container = document.getElementById("lista-avaliacoes");
      container.innerHTML = "";

      if (!avaliacoes.length) {
        container.innerHTML = "<p>Nenhuma avaliação ainda.</p>";
        return;
      }

      // Mais recentes primeiro
      avaliacoes.reverse();

      avaliacoes.forEach((av, index) => {
        const div = document.createElement("div");
        div.className = "comentario";

        // Oculta todos menos o mais recente
        if (index !== 0) {
          div.classList.add("oculto");
          div.style.display = "none";
        }
        
        const statusClasse =
        av.status === "aprovado" ? "verificado" : "analise";
      
      const statusTexto =
        av.status === "aprovado"
          ? "✔ Avaliação verificada"
          : "⏳ Avaliação em análise";
      
      div.innerHTML = `
        <strong>${av.nome}</strong><br>
        <span class="estrelas-view">${gerarEstrelas(av.nota || 5)}</span><br>
        ${av.comentario}<br>
        <small>${tempoAtras(av.data)}</small><br>
        <span class="status ${statusClasse}">${statusTexto}</span>
      `;
      
        

        container.appendChild(div);
      });

      // Se houver mais de uma avaliação, cria botão "Ver mais"
      if (avaliacoes.length > 1) {
        const btn = document.createElement("button");
        btn.className = "btn-ver-mais";
        btn.textContent = "Ver mais avaliações";

        let aberto = false;

        btn.onclick = () => {
          const ocultos = container.querySelectorAll(".comentario.oculto");

          ocultos.forEach(c => {
            c.style.display = aberto ? "none" : "block";
          });

          aberto = !aberto;
          btn.textContent = aberto
            ? "Ver menos avaliações"
            : "Ver mais avaliações";
        };

        container.appendChild(btn);
      }
    })
    .catch(() => {
      document.getElementById("lista-avaliacoes").innerHTML =
        "<p>Erro ao carregar avaliações.</p>";
    });
}


// ================= INICIALIZA =================
document.addEventListener("DOMContentLoaded", () => {
  listarAvaliacoes();
  iniciarEstrelas();
});
