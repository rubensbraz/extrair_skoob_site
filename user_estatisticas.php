<?php
  require_once('funcoes_elementos.php');
?>
<!doctype html>
<html lang="pt-br" class="h-100">
  <?php head(); ?>
  <body class="d-flex flex-column h-100">
    <?php hheader(); ?>
    <main class="flex-shrink-0">
      <div class="container">
        <br><br>
        <h1 class="mt-5">Exportador de livros do Skoob</h1>
        <br><br>
        <table id="tabela_livros_lidos" class="display responsive nowrap" style="width:100%">
          <thead>
            <tr>
              <th>Título</th>
              <th>Autor</th>
              <th>Editora</th>
              <th>Ano de lançamento</th>
              <th>Páginas</th>
              <th>Nota</th>
              <th>Data de leitura</th>
              <th>Ver capa</th>
              <th>Ver página Skoob</th>
            </tr>
          </thead>
          <tbody>
            <?php corpo_tabela_livros_user($_POST['link_perfil']); ?>
          </tbody>
        </table>
        <br><br>
      </div>
    </main>
    <?php footer(); ?>
    <?php datatable(); ?>
  </body>
</html>