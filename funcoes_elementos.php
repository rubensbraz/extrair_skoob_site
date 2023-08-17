<?php

require_once "funcoes_leitor_skoob.php";

function head(){
    echo '
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Jamelabs">
        <title>Exportador Skoob</title>
        
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="https://rubensbraz.com/exportador_skoob/favicon.png">
        <link rel="stylesheet" type="text/css" href="https://rubensbraz.com/exportador_skoob/style.css">
        
        <!-- Folhas de estilo -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
        
        <!-- Scripts JS fundamentais (carregamento imediato) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <meta name="theme-color" content="#7952b3">
      </head>
    ';
}

function hheader(){
    echo '
      <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
          <div class="container-fluid">
            <a class="navbar-brand">Exportador Skoob</a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="https://rubensbraz.com/exportador_skoob">Início</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://rubensbraz.com">Sobre o desenvolvedor</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
    ';
}

function footer(){
    $year = date("Y");
    echo '
      <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
          <p>' . $year . '. <a href="https://rubensbraz.com">Rubens Braz</a></p>
        </div>
      </footer>
      
      <!-- Scripts JS fundamentais (carregamento posterior) -->
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    ';
}

function datatable(){
    echo '
      <script>
        $(document).ready( function () {
            $("#tabela_livros_lidos").DataTable({
                dom: "Bfrtip",
                buttons: [
                    "colvis",
                    "copyHtml5",
                    "excelHtml5",
                    "csvHtml5"
                ],
                "pageLength": 35,
                "language": {
                                "decimal":        "",
                                "emptyTable":     "Nada para mostrar",
                                "info":           "Mostrando _START_ de _END_. Total: _TOTAL_ livros",
                                "infoEmpty":      "Mostrando 0 de 0",
                                "infoFiltered":   "(de um total de _MAX_ livros)",
                                "infoPostFix":    "",
                                "thousands":      ",",
                                "lengthMenu":     "Mostrando _MENU_ livros",
                                "loadingRecords": "Carregando...",
                                "processing":     "Processando...",
                                "search":         "Pesquisar:",
                                "zeroRecords":    "Nenhum livro foi encontrado de acordo com a busca",
                                "paginate": {
                                    "first":      "Primeira",
                                    "last":       "Última",
                                    "next":       "Próxima",
                                    "previous":   "Anterior"
                                },
                                "aria": {
                                    "sortAscending":  ": activate to sort column ascending",
                                    "sortDescending": ": activate to sort column descending"
                                },
                                "buttons": {
                                    "copy": "Copiar",
                                    "excelHtml5": "Excel",
                                    "csvHtml5": "CSV",
                                    "colvis": "Escolher colunas visíveis",
                                    
                                    copyTitle: "Deu certo! Aperte Control+V para colar os dados.",
                                    copySuccess: {
                                        _: "%d livros copiados",
                                        1: "1 livro copiados"
                                    }
                                }
                            }
            });
        } );

        (function(){
          function removeAccents (data) { if (data.normalize){ return data +" "+ data.normalize("NFD").replace(/[\u0300-\u036f]/g, "");} return data;}
          var searchType = jQuery.fn.DataTable.ext.type.search;
          searchType.string = function (data) { return ! data ? "" : typeof data === "string" ? removeAccents(data) : data;};
          searchType.html = function (data) { return ! data ? "" : typeof data === "string" ? removeAccents( data.replace(/<.*?>/g, "" )) : data;}; }()
      );
      </script>
    ';
}
