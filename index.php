<?php require_once "funcoes_elementos.php"; ?>

<!doctype html>
<html lang="pt-br" class="h-100">
  <?php head(); ?>
  <body class="d-flex flex-column h-100">
    <?php hheader(); ?>
    <main class="flex-shrink-0">
      <div class="container">
        <br><br>
        <h1 class="mt-5">Exportador de livros do Skoob</h1>
        <br>
        <form action="https://rubensbraz.com/exportador_skoob/user_estatisticas.php" method="POST">
          <div class="form-group">
            <label for="link_perfil">Insira o link do seu perfil</label>
            <input type="text" class="form-control" id="link_perfil" name="link_perfil" placeholder="https://www.skoob.com.br/usuario/156458" required>
          </div>
          <button type="submit" name="action" class="btn btn-primary" value="ver">Ver meus livros do Skoob</button>
        </form>
        <br><br>
      </div>
    </main>
    <?php footer(); ?>
  </body>
</html>