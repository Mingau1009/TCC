<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calculadora de IMC</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />

    <script src="js/scripts.js" defer>
    </script>

  </head>
  <body>
    <div class="container">
      <div id="calc-container">
        <h2>Calculadora de IMC</h2>
        <form id="imc-form">
          <div class="form-inputs">
            <div class="form-control">

              <label for="height">Digite sua altura:</label>
              <input
                type="text"
                name="height"
                id="height"
                placeholder="Exemplo 1,70"
                required
              />

            </div>
            <div class="form-control">
              <label for="weight">Digite seu peso:</label>
              <input
                type="text"
                name="weight"
                id="weight"
                placeholder="Exemplo 70,5"
              />

            </div>
          </div>
          <div class="action-control">
            <button id="calc-btn">Calcular</button>
            <button id="clear-btn">Limpar</button>
          </div>
        </form>
      </div>

      <div id="result-container" class="hide">
        <p id="imc-number">Seu IMC: <span></span></p>
        <p id="imc-info">Situação atual: <span></span></p>
        <h3>Confira as classificações</h3>
        <div id="imc-table">
          <div class="table-header">
            <h4>IMC</h4>
            <h4>Classificação</h4>
            <h4>Obesidade</h4>
          </div>

        </div>
        <button id="back-btn">Voltar</button>
      </div>
    </div>
  </body>
</html>
