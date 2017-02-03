<?php
/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 03/02/2017
 * Time: 14:02
 */

/* $fqn = MagicMonkey/MiniJournal/Article par exemple */
function autoload($fqn)
{
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $fqn);
    $fullPath = APP_BASEFILE . DIRECTORY_SEPARATOR . $path . '.php';
    include($fullPath);
}
