<?php
/**
 * Troca o padrão da data para sql ou ptBr, dependendo do que for passado
 *
 * @param string $date
 * @return string Data invertida
 */
function dateSwap(string $date): string
{
    $data = explode(" ", $date)[0];
    if (preg_match_all('/^(\d{2})\/(\d{2})\/(\d{4})$/', $data)) { //Formato ptbr
        return implode('-', array_reverse(explode('/', $data)));
    } else if (preg_match_all('/^(\d{4})\-(\d{2})\-(\d{2})$/', $data)) { //Formato sql
        if (count(explode(" ", $date)) == 2) {//Se tiver hora, retorna junto
            return implode('/', array_reverse(explode('-', $data))) . " " . explode(" ", $date)[1];
        }
        return implode('/', array_reverse(explode('-', $data)));
    } else {
        die("<code>Formato de data inválido para a função dateSwap <i>$date</i></code>");
    }
}

function daysLeft(string $date) : string{
    $now = time();
    if (strtotime($date) < $now)
        return '<span class="text-danger">Vencido</span>';
    $timeleft = strtotime($date) - $now;
    return round((($timeleft/24)/60)/60) . " dias";
}
