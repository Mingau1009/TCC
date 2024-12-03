<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Menu principal</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMF77I0n4h/jV+YjDgbU6euj4AkTW8nKmJmMy" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/af6fbadd15.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <div> 
      <div class="sidebar">
        <div class="logo-details">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="logo_name">MF academia</span>
        </div>

        <ul class="nav-links">
          <li>
            <a href="#" class="active">
              <i class="bx bx-grid-alt"></i>
              <span class="links_name">Dashboard</span>
            </a>
          </li>
          
          <li>
            <a href="../Matricula/Crud/index.php">
              <i class="bx bx-user">            
              </i>
              <span class="links_name">Cadastro do aluno</span>
            </a>
          </li>
          
          <li>
            <a href="../exercicio/index.php">
              <i class='bx bx-dumbbell'></i>
              <span class="links_name">Cadastro de exercício</span>
            </a>
          </li>

          <li>
            <a href="../Funcionario/index.php">
              <i class="bx bx-body"></i>
              <span class="links_name">Cadastro de funcionário</span>
            </a>
          </li>
          
          <li>
            <a href="../Ficha/index.php">
              <i class="bx bx-edit"></i>
              <span class="links_name">Consulte sua ficha</span>
            </a>
          </li>
          
          <li>
            <a href="../evolução/index.php">
              <i class="bi bi-file-earmark-pdf" style="font-size:17px"></i>
              </i>
              <span class="links_name">Evolução dos Alunos</span>
            </a>
          </li>

          <li>
            <a href="../Financeiro/index.php">
              <i class="fas fa-chart-line" style="font-size:17px"></i>
              </i>
              <span class="links_name">Controle Financeiro</span>
            </a>
          </li>
          
          <li>
            <a href="../IMC/index.php">
              <i class="bi bi-calculator" style="font-size:17px"></i>
              </i>
              <span class="links_name">Calcule seu IMC</span>
            </a>
          </li>

          <li class="log_out">
            <a href="../login/index.php">
              <i class="bx bx-log-out"></i>
              <span  class="links_name">Tela de Login</span>
            </a>
          </li>
        </ul>
      </div>
</div>

<section class="home-section">
<nav class="navbar">
<div class="navbar-container">
    <ul class="navbar-menu">
    <li><a href="../profissionais/index.php">Conheça nosso time</a></li>
    <li><a href="#">Quem somos nós</a></li>
    <li><a href="../Matricula/index.php">Conheça nossos planos</a></li>
    </ul>
</div>
</nav>
