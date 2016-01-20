<?php

ob_start();
@session_start();

require_once('../model/DB.php');
require_once('../util/util.php');


// salvar
//echo "controller: ".$_REQUEST['acao'];

if ($_REQUEST['acao'] == "Salvar") {


    $_REQUEST['p']['excluido'] = "N";
    $_REQUEST['p']['perfil'] = "ATLETA";
    $_REQUEST['p']['ativo'] = "S";

    if ($_REQUEST['p']['data_nascimento']) {
        $_REQUEST['p']['data_nascimento'] = convertDataMysql($_REQUEST['p']['data_nascimento']);
    }

    if ($_REQUEST['p']['data']) {
        $_REQUEST['p']['data'] = convertDataMysql($_REQUEST['p']['data']);
    }

    if ($_REQUEST['p']['valor']) {
        $_REQUEST['p']['valor'] = str_replace(".", "", $_REQUEST['p']['valor']);
        $_REQUEST['p']['valor'] = str_replace(",", ".", $_REQUEST['p']['valor']);
    }

    //#####################################################################################################################################
    // ATUALIZA UM REGISTRO
    //#####################################################################################################################################

    if (DB::salvar("atleta", $_REQUEST['p'])) {

        $msg = "2";
    }

    header("location: ../pages/login.php?msg=" . $msg . "&" . $_REQUEST['retorno']);
}
?>