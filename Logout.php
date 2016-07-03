<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("includes/autoload.inc.php");
if(isset($_POST["uscita"]))
{$session=new USession();
$session->fineSessione();
echo "finish";
}
