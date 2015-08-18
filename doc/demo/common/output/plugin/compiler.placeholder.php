<?php

function smarty_compiler_placeholder($arrParams,  $smarty){
    $strCode = '<?php ';
    $strType = $arrParams['type'];
    $strResourceApiPath = preg_replace('/[\\/\\\\]+/', '/', dirname(__FILE__) . '/FISResource.class.php');
    $strCode .= 'if(class_exists(\'FISResource\', false)){';
    $strCode .= 'echo FISResource::placeHolder(' . $strType .');}';
    $strCode .= '?>';
    return $strCode;
}