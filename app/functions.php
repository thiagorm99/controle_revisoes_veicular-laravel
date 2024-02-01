<?php

function verificar_registro($dados)
{
    if (!count($dados) >= 1) {
        echo "Sem dados no relatório";
        die;
    }
}