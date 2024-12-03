<?php include("../Classe/Conexao.php") ?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMF77I0n4h/jV+YjDgbU6euj4AkTW8nKmJmMy" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@latest/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/af6fbadd15.js" crossorigin="anonymous"></script>
    <title>Área de Cadastro de Exercício</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <section class="p-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="col-4">
                <button class="btn btn-success newUser " data-bs-toggle="modal" data-bs-target="#userForm">
                    <i class='bx bx-edit' style='font-size:20px'></i> Montar Ficha 
                </button>
            </div>
        </div>
    </section>

    <br>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover mt-3 text-center table-bordered">
                <thead>
                    <tr>
                        <th>Aluno</th>
                        <th>Nome da Ficha</th>
                        <th>Ajustes</th>
                    </tr>
                </thead>
                <tbody id="data">
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de Cadastro de Exercício -->
    <div class="modal fade" id="userForm" tabindex="-1" aria-labelledby="userFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userFormLabel">Cadastrar Nova Ficha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="myForm" >
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nomeAluno" class="form-label">Aluno</label>
                            <input type="text" class="form-control" id="nomeAluno" required>
                        </div>
                        <div class="mb-3">
                            <label for="nomeFicha" class="form-label">Nome da Ficha</label>
                            <input type="text" class="form-control" id="nomeFicha" required>
                        </div>
                        <div class="mb-3">
                            <label for="diaTreino" class="form-label">Dia do Treino</label>
                            <select class="form-control" id="diaTreino" required>
                                <option value="">Selecione o dia</option>
                                <option value="Segunda">Segunda</option>
                                <option value="Terça">Terça</option>
                                <option value="Quarta">Quarta</option>
                                <option value="Quinta">Quinta</option>
                                <option value="Sexta">Sexta</option>
                                <option value="Sábado">Sábado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nomeExercicio" class="form-label">Nome do Exercício</label>
                            <select name="categoriaExercicio" class="form-control" id="nomeExercicio" onchange="mostrarCampos()">
                                <option value="">Selecione o exercício</option>
                                <?php
                                    $query = $conexao->query("SELECT id, nome FROM exercicio ORDER BY nome ASC");
                                    $exercicios = $query->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($exercicios as $option) {
                                ?>
                                    <option value="<?php echo $option['id'] ?>"><?php echo htmlspecialchars($option['nome']) ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div id="campoSeries" class="mb-3" style="display: none;">
                            <label for="numeroSeries" class="form-label">Número de Séries</label>
                            <input type="number" class="form-control" id="numeroSeries" min="2" max="5" required>
                        </div>

                        <div id="campoRepeticoes" class="mb-3" style="display: none;">
                            <label for="numeroRepeticoes" class="form-label">Número de Repetições</label>
                            <input type="number" class="form-control" id="numeroRepeticoes" min="7" max="30" required>
                        </div>

                        <div id="campoDescanso" class="mb-3" style="display: none;">
                            <label for="tempoDescanso" class="form-label">Tempo de Descanso</label>
                            <input type="number" class="form-control" id="tempoDescanso" min="7" max="30" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success submit">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    
    
</body>
</html>
