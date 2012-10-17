<?php
// {{{ requires
require_once realpath(dirname(__FILE__)) . '/../../require.php';
require_once CLASS_EX_REALDIR . 'page_extends/frontparts/bloc/LC_Page_FrontParts_Bloc_VideoPlayer_Ex.php';

// }}}
// {{{ generate page

$objPage = new LC_Page_FrontParts_Bloc_VideoPlayer_Ex();
$objPage->blocItems = $params['items'];
register_shutdown_function(array($objPage, "destroy"));
$objPage->init();
$objPage->process();
?>
