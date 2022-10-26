<?php

    $pagina = file_get_contents("./html/index.html");

    echo $pagina;

    date_default_timezone_set('America/Sao_Paulo');
    $dataAtual = date('d-m-Y');

    if (isset($_REQUEST['val_total_da_venda']) && isset($_REQUEST['quantidade_parcelas']) && isset($_REQUEST['quantidade_dias'])) {
        $valorTotalVenda = $_REQUEST['val_total_da_venda'];
        $quantidadeParcelas = $_REQUEST['quantidade_parcelas'];
        $quantidadeDias = $_REQUEST['quantidade_dias'];
        $cont = 0;
        $soma = 0;
        $diferenca = 0;

        if ($valorTotalVenda != '' && $quantidadeParcelas != '' && $quantidadeDias != '') {   
            $valorParcelas = 0;

            if ($valorTotalVenda > 0 && $quantidadeParcelas > 0) {
                $valorParcelas = floatval($valorTotalVenda/$quantidadeParcelas);
            }

            $valorParcelas = number_format((float)$valorParcelas, 2, '.', '');

            echo('<hr>');
            echo('<div class="text-center">');
            echo("<h3>Valor Da Venda: R$:$valorTotalVenda</h3>");
            echo("<h3>Quantidade De Parcelas: $quantidadeParcelas</h3>");
            echo("<h3>Quantidade De Dias: $quantidadeDias</h3>");
            echo("<h3>Valor Por Parcelas: R$:$valorParcelas  </h3>");
            echo("<h3>Data Atual: $dataAtual</h3>");

            $soma = $valorParcelas * $quantidadeParcelas;

            if($soma == $valorTotalVenda){
                for($i = 0; $i < $quantidadeParcelas; $i++){
                    $cont += $quantidadeDias;
                    $vencimento = date('d-m-Y', strtotime("$cont days"));
                    echo('Vencimento: '.$vencimento .' R$'.$valorParcelas.'<br>');
                }
            } else {
                $diferenca = $soma - $valorTotalVenda;
                $diferenca = number_format((float)$diferenca, 2, '.', '');
                $cont = $quantidadeDias;
                $vencimento = date('d-m-Y', strtotime("$cont days"));
                if($diferenca < 0){
                    echo('Vencimento: '.$vencimento .' R$'.number_format((float)($valorParcelas + $diferenca), 2, '.', '').'<br>');
                    for($i = 1; $i < $quantidadeParcelas; $i++){
                        $cont += $quantidadeDias;
                        $vencimento = date('d-m-Y', strtotime("$cont days"));
                        echo('Vencimento: '.$vencimento .' R$'.$valorParcelas.'<br>');
                    }
                }else{
                    echo('Vencimento: '.$vencimento .' R$'.number_format((float)($valorParcelas - $diferenca), 2, '.', '').'<br>');
                    for($i = 1; $i < $quantidadeParcelas; $i++){
                        $cont += $quantidadeDias;
                        $vencimento = date('d-m-Y', strtotime("$cont days"));
                        echo('Vencimento: '.$vencimento .' R$'.$valorParcelas.'<br>');
                    }
                }
            }
        } else {
            echo('<hr>');
            echo('<br><div class="text-center">Por favor, preencha os campos!</div><br><br>');
        }

    }

?>