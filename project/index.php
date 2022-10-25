<?php

    $pagina = file_get_contents("./html/index.html");

    echo $pagina;

    date_default_timezone_set('America/Sao_Paulo');
    $dataAtual = date('d-m-y h:i:s');

    if (isset($_REQUEST['val_total_da_venda']) && isset($_REQUEST['quantidade_parcelas']) && isset($_REQUEST['quantidade_dias'])) {
        $valorTotalVenda = $_REQUEST['val_total_da_venda'];
        $quantidadeParcelas = $_REQUEST['quantidade_parcelas'];
        $quantidadeDias = $_REQUEST['quantidade_dias'];

        if ($valorTotalVenda != '' && $quantidadeParcelas != '' && $quantidadeDias != '') {
            $vencimentoParcelas = [];
            $valorParcelas = 0;

            if ($valorTotalVenda > 0 && $quantidadeParcelas > 0) {
                $valorParcelas = floatval($valorTotalVenda/$quantidadeParcelas);
            }

            $valorParcelas = number_format((float)$valorParcelas, 2, '.', '');

            echo($valorTotalVenda);
            echo($quantidadeParcelas);
            echo($quantidadeDias);
            echo('valorParcelas: ' . $valorParcelas . '<br>');
            echo($valorParcelas . '<br>');
            echo('data atual: ' . $dataAtual . '<br>');

            // echo('<br>');
            // echo('<div class="text-center">');
            // echo('<p>Quantidade de combustível: <b>' . $quantidadeCombustivelInicial . '</b></p>');
            // echo('<p>Quantidade consumida a cada 15.376 Km:  <b>' . $quantidadeConsumidaInicial . '</b></p>');
            // echo('<hr>');
            // echo('<br>');

            // for ($i = 0; $i < count($quantidadeArray); $i++) {
            //     if ($quantidadeArray[$i] > 0) {
            //         echo('Quantidade de combustível restante no tanque: <b>' . $quantidadeArray[$i] . '</b><br>');
            //     }
            // }

            // echo('</div>');

        } else {
            echo('<br><div class="text-center">Por favor, preencha os campos!</div>');
        }

    }

?>