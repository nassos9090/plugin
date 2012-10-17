<?php
// {{{ requires
require_once CLASS_EX_REALDIR . 'page_extends/frontparts/bloc/LC_Page_FrontParts_Bloc_Ex.php';

/**
 * ランキングブロックのブロッククラス
 */
class LC_Page_FrontParts_Bloc_Ranking extends LC_Page_FrontParts_Bloc {
 
    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $bloc_file = 'ranking.tpl';
        $this->setTplMainpage($bloc_file);
    }
 
    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process() {
$objView = new SC_SiteView();
// ランキングの取得
$this->arrRanking = $this->getRanking();
$objView->assignobj($this);
$objView->display($this->tpl_mainpage);
//var_dump(getRanking());
}
 
    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }
 
    // ランキング検索
    function getRanking(){
    $objQuery = new SC_Query();
 
    $col = "T1.product_id, T1.product_name as name,COUNT(*) AS order_count ";
    $from = "dtb_order_detail AS T1
             INNER JOIN dtb_order AS T2 ON T1.order_id = T2.order_id
             INNER JOIN dtb_products AS T3 ON T1.product_id = T3.product_id";
    $objQuery->setgroupby("T1.product_id,T1.product_name");
    $objQuery->setorder("order_count DESC");
    $objQuery->setlimit(10);
 //var_dump($objQuery->setorder("order_count DESC"));
    return $objQuery->select($col, $from, 'T2.status = ?', array('5'));
    }
}