<?php

function smarty_compiler_require($arrParams,  $smarty){
    $strName = $arrParams['name'];
    $src = isset($arrParams['src']) ? $arrParams['src'] : false;
    $type = isset($arrParams['type']) ? $arrParams['type'] : 'null';
    $async = 'false';

    if (isset($arrParams['async'])) {
    	$async = trim($arrParams['async'], "'\" ");
    	if ($async !== 'true') {
    		$async = 'false';
    	}
    }

    $strCode = '';
    if($strName || $src){
        $strResourceApiPath = preg_replace('/[\\/\\\\]+/', '/', dirname(__FILE__) . '/FISResource.class.php');
        $strCode .= '<?php if(!class_exists(\'FISResource\', false)){require_once(\'' . $strResourceApiPath . '\');}';
        if ($strName) {
            $strCode .= 'FISResource::load(' . $strName . ',$_smarty_tpl->smarty, '.$async.');';
        } else if (is_string($src)) {
            $strCode .= 'FISResource::addStatic(' . $src . ', ' . $type . ');';
        }
        $strCode .= '?>';
    }

    return $strCode;
}
