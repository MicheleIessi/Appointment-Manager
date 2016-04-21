<?php 
require_once ('View/View.php');
require ('Foundation/FProfessionista.php');
require ('Entity/EProfessionista.php');

$index=new View();

$fp=new FProfessionista();
$p=$fp->caricaProfessionistaDaDb('1');
$index->assign('elenco',$p);
$index->display('templates/index.tpl');

