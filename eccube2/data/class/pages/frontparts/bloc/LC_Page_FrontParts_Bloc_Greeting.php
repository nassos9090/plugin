<?php
// {{{ requires
require_once CLASS_EX_REALDIR . 'page_extends/frontparts/bloc/LC_Page_FrontParts_Bloc_Ex.php';

/**
 * �ŋߍw�����ꂽ���i�u���b�N�̃u���b�N�N���X
 */
class LC_Page_FrontParts_Bloc_Greeting extends LC_Page_FrontParts_Bloc_EX {


    /**
     * ����������.
     *
     * @return void
     */
    function init() {
        parent::init();

    }

    /**
     * �v���Z�X.
     *
     * @return void
     */
    function process() {
        $this->action();
        $this->sendResponse();
    }

    /**
     * Page �̃A�N�V����.
     *
     * @return void
     */
    function action() {
        //�ŋߍw�����ꂽ���i��5���擾
        $this->arrPurchaseProducts = $this->getPurchaseProducts();
    }

    /**
     * �f�X�g���N�^.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

    /**
     * �ŋߍw�����ꂽ���i��5���擾����
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
