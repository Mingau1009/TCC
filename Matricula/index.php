<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Cadastro de Aluno</title>
    <link rel="stylesheet" href="style.css">
    
    <style>
.btn-custom {
    background-color: #198754; /* Cor verde para os filtros */
    color: white; /* Cor do texto */
    border: none; /* Remove a borda padrão */
    padding: 10px 15px; /* Ajusta o padding */
    border-radius: 5px; /* Arredonda os cantos */
    cursor: pointer; /* Muda o cursor ao passar o mouse */
}

.btn-custom:hover,
.btn-custom:active,
.btn-custom:focus {
    background-color: #198754; /* Mantém a mesma cor verde no hover */
    outline: none; /* Remove o contorno padrão ao clicar */
}

.pdf-button {
    background-color: #dc3545; /* Cor vermelha para o botão de gerar PDF */
    color: white; /* Cor do texto */
    border: none; /* Remove a borda padrão */
    padding: 10px 15px; /* Ajusta o padding */
    border-radius: 5px; /* Arredonda os cantos */
    cursor: pointer; /* Muda o cursor ao passar o mouse */
    margin-left: 10px; /* Margem esquerda para espaçamento */
}

.pdf-button:hover,
.pdf-button:active,
.pdf-button:focus {
    background-color: #dc3545; /* Tom mais escuro de vermelho para hover */
    outline: none; /* Remove o contorno padrão ao clicar */
}

/* Estilo para o fundo das opções do filtro */
.filtro-opcoes {
    background-color: white; /* Define o fundo como branco */
    border-radius: 10px; /* Arredonda os cantos, se desejado */
    padding: 15px; /* Adiciona espaçamento interno */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Adiciona sombra para destaque */
}

    </style>
</head>
<body>
<?php include("../Classe/Conexao.php") ?>
    <section class="p-3">
        <div class="row mb-3">
            <div class="col-6 text-start">
                <button class="btn btn-success newUser" data-bs-toggle="modal" data-bs-target="#userForm">Matricular Aluno <i class="bi bi-people"></i></button>
            </div>
        </div>

<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">
      <i class="bi bi-search"></i> 
    </span>
    <input type="text" class="form-control search-input short-input" placeholder="Buscar por aluno..." aria-label="Buscar por aluno..." aria-describedby="basic-addon1">
  </div>
  
  <style>
  
  .short-input {
    width: 200px !important; 
    max-width: 100%; 
  }
  
  .input-group {
    max-width: 545px; 
  }

  </style>
          
          <div class="row mb-3">
            <div class="col-12 text-end">
                <div class="d-inline">
                    <button class="btn btn-secondary btn-custom pdf-button" onclick="generatePDF()" style="margin-right: 5px;">
                        <i class="bi bi-file-earmark-pdf"></i> Gerar PDF
                    </button>
                </div>
                <div class="d-inline">
                    <div class="dropdown d-inline">
                        <button class="btn btn-secondary btn-custom dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Filtrar Alunos
                        </button>
                        <ul class="dropdown-menu filtro-opcoes" aria-labelledby="filterDropdown">
                            <li style="margin-bottom: 10px;"><a class="dropdown-item btn-custom" href="#" onclick="filterStudents('recent')">Últimos Alunos</a></li>
                            <li style="margin-bottom: 10px;"><a class="dropdown-item btn-custom" href="#" onclick="filterStudents('oldest')">Primeiros Alunos</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
    
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover mt-3 text-center table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Nome Completo</th>
                        <th>Data de Nascimento</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                        <th>Frequência</th>
                        <th>Objetivo</th>
                        <th>Data da matrícula</th>
                        <th>Ajustes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $alunos = Db::conexao()->query("SELECT * FROM `aluno`")->fetchAll(PDO::FETCH_OBJ); ?>
                    <?php foreach ($alunos as $aluno) { ?>
                        <tr>
                            <td><?php echo $aluno->nome; ?></td>
                            <td>
                                <?php if($aluno->data_nascimento) { ?>
                                    <?php echo date('d/m/Y', strtotime($aluno->data_nascimento)); ?>
                                <?php } else { ?>
                                    --
                                <?php } ?>
                            </td>
                            <td><?php echo $aluno->telefone; ?></td>
                            <td><?php echo $aluno->endereco; ?></td>
                            <td><?php echo $aluno->frequencia; ?></td>
                            <td><?php echo $aluno->objetivo; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($aluno->data_matricula)); ?></td>
                        </tr>
                    <?php } ?>
            </table>
        </div>
    </div>
</section>

<form method="POST" action="cadastrar.php">
    <div class="modal fade" id="userForm">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ficha de Matrícula do Aluno</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="inputField">
                        <div>
                            <label for="name">Nome Completo:</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div>
                            <label for="sdate">Data de Nascimento:</label>
                            <input type="date" name="sdate" id="sdate" required>
                        </div>
                        <div>
                            <label for="telefone">Telefone:</label>
                            <input type="text" name="telefone" id="telefone" required>
                        </div>
                        <div>
                            <label for="address">Endereço:</label>
                            <input type="text" name="address" id="address" required>
                        </div>
                        <div>
                            <label for="frequency">Frequência:</label>
                            <input type="number" name="frequency" id="frequency" min="2" max="6" required>
                        </div>
                        <div>
                            <label for="Objective">Objetivo:</label>
                            <input type="text" name="Objective" id="Objective" required>
                        </div>
                        <div>
                            <label for="sDate">Data de Início:</label>
                            <input type="date" name="sDate" id="sDate" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success submit">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="readData">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Matrícula do Aluno</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="profileForm">
                    <div class="card imgholder">
                        <img src="./image/Profile Icon.webp" alt="" width="200" height="200" class="showImg">
                    </div>
                    <div class="inputField">
                        <div>
                            <label for="showName">Nome Completo:</label>
                            <input type="text" name="" id="showName" disabled>
                        </div>
                        <div>
                            <label for="showDate">Data de Nascimento:</label>
                            <input type="text" name="" id="showDate" disabled>
                        </div>
                        <div>
                            <label for="showPhone">Telefone:</label>
                            <input type="text" name="" id="showPhone" disabled>
                        </div>
                        <div>
                            <label for="showAddress">Endereço:</label>
                            <input type="text" name="" id="showAddress" disabled>
                        </div>
                        <div>
                            <label for="showFrequency">Frequência:</label>
                            <input type="number" name="" id="showFrequency" disabled>
                        </div>
                        <div>
                            <label for="showObjective">Objetivo:</label>
                            <input type="text" name="" id="showObjective" disabled>
                        </div>
                        <div>
                            <label for="showStartDate">Data de Início:</label>
                            <input type="text" name="" id="showStartDate" disabled>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tableBody = document.getElementById('data');
        let draggedRow = null;

        // Adicione o evento de início de arrasto
        tableBody.querySelectorAll('tr').forEach(row => {
            row.setAttribute('draggable', 'true');

            row.addEventListener('dragstart', (e) => {
                draggedRow = e.target;
                e.target.style.opacity = 0.5;
            });

            row.addEventListener('dragend', (e) => {
                e.target.style.opacity = 1;
                draggedRow = null;
            });

            row.addEventListener('dragover', (e) => {
                e.preventDefault();
                e.target.style.borderTop = "2px solid #007bff"; // Indica a posição de inserção
            });

            row.addEventListener('dragleave', (e) => {
                e.target.style.borderTop = ""; // Remove a indicação quando o arrasto sai da área
            });

            row.addEventListener('drop', (e) => {
                e.preventDefault();
                e.target.style.borderTop = ""; // Remove a indicação visual de borda

                if (draggedRow && draggedRow !== e.target) {
                    // Verifica se o elemento de drop é um `<tr>`, caso contrário sobe na hierarquia até encontrar
                    let dropTarget = e.target;
                    while (dropTarget.tagName !== 'TR' && dropTarget !== tableBody) {
                        dropTarget = dropTarget.parentElement;
                    }

                    if (dropTarget !== tableBody) {
                        const draggedRowIndex = Array.from(tableBody.children).indexOf(draggedRow);
                        const targetRowIndex = Array.from(tableBody.children).indexOf(dropTarget);

                        // Troca a posição dos elementos arrastados
                        if (draggedRowIndex > targetRowIndex) {
                            tableBody.insertBefore(draggedRow, dropTarget);
                        } else {
                            tableBody.insertBefore(draggedRow, dropTarget.nextSibling);
                        }
                    }
                }
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="script.js"></script>
</body>
</html>
