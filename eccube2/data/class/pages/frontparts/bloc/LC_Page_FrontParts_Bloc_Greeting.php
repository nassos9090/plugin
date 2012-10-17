<?php
// {{{ requires
require_once CLASS_EX_REALDIR . 'page_extends/frontparts/bloc/LC_Page_FrontParts_Bloc_Ex.php';

/**
 * 最近購入された商品ブロックのブロッククラス
 */
class LC_Page_FrontParts_Bloc_Greeting extends LC_Page_FrontParts_Bloc_EX {


    /**
     * 初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();

    }

    /**
     * プロセス.
     *
     * @return void
     */
    function process() {
        $this->action();
        $this->sendResponse();
    }

    /**
     * Page のアクション.
     *
     * @return void
     */
    function action() {
        //最近購入された商品を5件取得
        $this->arrPurchaseProducts = $this->getPurchaseProducts();
    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

    /**
     * 最近購入された商品を5件取得する
     */
    function getPurchaseProducts() {
$col = 'dtb_order_detail.product_id, dtb_order_detail.product_name,dtb_order.create_date';
$table = 'dtb_order_detail JOIN dtb_order ON dtb_order_detail.order_id = dtb_order.order_id';
$where = 'dtb_order.del_flg = 0';	
        $objQuery =& SC_Query_Ex::getSingletonInstance();
	$objQuery->setLimit(5);
        $objQuery->setOrder('dtb_order.create_date DESC');
        $arrPurchaseProducts = $objQuery->select($col,$table,$where);
        return $arrPurchaseProducts;
    }
}
