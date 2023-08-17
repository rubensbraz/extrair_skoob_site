<?php

function pega_livros_user($link_perfil){
    $user_id = preg_replace("/[^0-9]/", "", $link_perfil);
    $jsonurl =
        "https://www.skoob.com.br/v1/bookcase/books/" .
        $user_id .
        "/shelf_id:0/page:1/limit:200/";
    $json = file_get_contents($jsonurl);
    $livros = json_decode($json, true);

    return $livros["response"];
}

function corpo_tabela_livros_user($link_perfil){
    $todos_livros = pega_livros_user($link_perfil);

    if ($todos_livros == []) {
        echo "<b>Seu usuário não foi encontrado! Verifique o link do seu perfil e tente novamente.</b><br><br>";
    } else {
        foreach ($todos_livros as $livro) {
            $paginas =
                $livro["paginas"] == ""
                    ? $livro["edicao"]["paginas"]
                    : $livro["paginas"];

            echo "<tr>" .
                "<td>" .
                $livro["edicao"]["titulo"] .
                "</td>" .
                "<td>" .
                $livro["edicao"]["autor"] .
                "</td>" .
                "<td>" .
                $livro["edicao"]["editora"] .
                "</td>" .
                "<td>" .
                $livro["edicao"]["ano"] .
                "</td>" .
                "<td>" .
                $paginas .
                "</td>" .
                "<td>" .
                $livro["ranking"] .
                "</td>" .
                "<td>" .
                substr($livro["dt_leitura"], 0, -9) .
                "</td>" .
                "<td><a target='_blank' href='" .
                $livro["edicao"]["capa_grande"] .
                "'>Link para capa</a></td>" .
                "<td><a target='_blank' href='https://skoob.com.br" .
                $livro["edicao"]["url"] .
                "'>Link para Skoob</a></td>" .
                "</tr>";
        }
    }
}

function pega_isbn($url){
    $meta = file_get_contents("https://skoob.com.br/" . $url);
    //$re = '/<meta property="books:isbn" content="(\d+)" \/>/s';
    //preg_match($re, $meta, $matches, PREG_OFFSET_CAPTURE, 0);
    //$isbn = $matches[1][0];
    $re = '/isbn" content="(\d+)"/';
    preg_match($re, $meta, $matches);
    $isbn = $matches[1];

    return $isbn;
}

function csv_goodreads($link_perfil, $email){
    $todos_livros = pega_livros_user($link_perfil);

    $header_csv =
        "Title, Author, ISBN, My Rating, Average Rating, Publisher, Binding, Year Published, Original Publication Year, Date Read, Date Added, Bookshelves, My Review\n";

    $nome_csv = tempnam("/tmp", "FOO");
    $handle = fopen($nome_csv, "w");

    fwrite($handle, $header_csv);

    foreach ($todos_livros as $livro) {
        $titulo = str_replace(",", ";", $livro["edicao"]["titulo"]);
        $autor = str_replace(",", ";", $livro["edicao"]["autor"]);
        $editora = str_replace(",", ";", $livro["edicao"]["editora"]);
        $isbn = pega_isbn($livro["edicao"]["url"]);

        fwrite(
            $handle,
            $titulo .
                "," .
                $autor .
                "," .
                $isbn .
                "," .
                $livro["ranking"] .
                "," .
                "," .
                $editora .
                "," .
                "," .
                $livro["edicao"]["ano"] .
                "," .
                "," .
                substr($livro["dt_leitura"], 0, -9) .
                "," .
                "," .
                "," .
                "," .
                "\n"
        );
    }

    fclose($handle);

    envia_email($email, $nome_csv);

    unlink($nome_csv);
}
