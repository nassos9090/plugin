<?php
/*
 * VideoPlayer
 * Copyright(c) 2012 .  Student.
 *
 * http://xoops.ec-cube.net/
 * 
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */
 
// {{{ requires
require_once CLASS_EX_REALDIR . 'page_extends/admin/LC_Page_Admin_Ex.php';

/**
 * 新着商品の設定クラス
 *
 * @package VideoPlayer
 * @author  Inc.
 * @version $Id: $
 */
class LC_Page_Plugin_VideoPlayer_Config extends LC_Page_Admin_Ex {
    
    var $arrForm = array();

    /**
     * 初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = PLUGIN_UPLOAD_REALDIR ."VideoPlayer/templates/config.tpl";
        $this->tpl_subtitle = "埋め込み型プレイヤー設定";
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
        $objFormParam = new SC_FormParam_Ex();
        $this->lfInitParam($objFormParam);
        $objFormParam->setParam($_POST);
        $objFormParam->convParam();
        
        $arrForm = array();
        
        switch ($this->getMode()) {
        case 'edit':
            $arrForm = $objFormParam->getHashArray();
            $this->arrErr = $objFormParam->checkError();
            // エラーなしの場合にはデータを更新
            if (count($this->arrErr) == 0) {
                // データ更新
                $this->arrErr = $this->updateData($arrForm);
                if (count($this->arrErr) == 0) {
                    $this->tpl_onload = "alert('登録が完了しました。');";
                    $this->tpl_onload .= 'window.close();';
                }
            }
            break;
        default:
            // プラグイン情報を取得.
            $plugin = SC_Plugin_Util_Ex::getPluginByPluginCode("VideoPlayer");
            $arrForm['product_id']  = $plugin['product_id'];
            $arrForm['video_url']   = $plugin['video_url'];
            $arrForm['disp_width']  = $plugin['disp_width'];
            $arrForm['disp_height'] = $plugin['disp_height'];

            break;
        }
        $this->arrForm = $arrForm;
        $this->setTemplate($this->tpl_mainpage);
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
     * パラメーター情報の初期化
     *
     * @param object $objFormParam SC_FormParamインスタンス
     * @return void
     */
    function lfInitParam(&$objFormParam) {

        $objFormParam->addParam('参照商品id', 'product_id', INT_LEN, 'n', array('EXIST_CHECK','NO_SPTAB', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('動画URL', 'video_url', URL_LEN, 'n', array('URL_CHECK','SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('幅', 'disp_width', ZIP01_LEN, 'n', array('NUM_CHECK','NO_SPTAB','NUM_COUNT_CHECK'));
        $objFormParam->addParam('高さ', 'disp_height', ZIP01_LEN, 'n', array('NUM_CHECK','NO_SPTAB','NUM_COUNT_CHECK'));
//	var_dump($objFormParam);
//	exit;
    }

    /**
     *
     * @param type $arrData
     * @return type 
     */
    function updateData($arrData) {
        $arrErr = array();
        
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $objQuery->begin();
        // UPDATEする値を作成する。
        $sqlval = array();
        $sqlval['product_id'] = $arrData['product_id'];
        $sqlval['video_url'] = $arrData['video_url'];
        $sqlval['disp_width'] = $arrData['disp_width'];
        $sqlval['disp_height'] = $arrData['disp_height'];

        
        //dbのproduct_id検索
        $teble = "dtb_videoplayer "; //テーブル名
        $where = "";
        $product_id = array();
        $list_id = $objQuery->getCol('product_id',$teble,$where);

        // UPDATEの実行
        if(LC_Page_Plugin_VideoPlayer_Config::Search($list_id,$arrData['product_id'])){
            $searchId = $arrData['product_id'];
            $where = "product_id = $searchId";//
            $objQuery->update($teble, $sqlval, $where);

        }
        else{
            //dbのid検索+1
            $where = "";
            $max_id = $objQuery->max('id',$teble,$where);
            $sqlval['id'] = $max_id + 1;
            $objQuery->insert($teble, $sqlval);
        }

        $objQuery->commit();
        return $arrErr;
    }

    //DB検索 値取得
    function Search($arrData , $searchValue){
        foreach($arrData as $value){
            if($value == $searchValue){
                return ture;
            }
        }
        return false;//
    }

    /*　URL形式の判定　*/
    //　URLを正規表現で判定する。デフォルトでhttp://があってもOK
    //  value[0] = 項目名 value[1] = 判定対象URL
    function URL_CHECK2($value) {
        if (isset($this->arrErr[$value[1]])) {
            return;
        }
        if (strlen($this->arrParam[$value[1]]) > 0 && !preg_match("@^https?://+($|[a-zA-Z0-9_~=:&\?\.\/-])+$@i", $this->arrParam[$value[1]])) {
            $this->arrErr[$value[1]] = '※ ' . $value[0] . 'を正しく入力してください。<br />';
        }else if(strlen($this->arrParam[$value[1]]) > 0){
            $warningText = '※ 動画が表示できませんでした。URLをもう一度ご確認ください。<br />';
            /* yotubeURL判別 */ 
            //"@^https?://.*youtu.*v=([a-zA-Z0-9]+).*@i","@^https?://.*youtu.*be.([a-zA-Z0-9]+).*@i","@^https?://.*youtu.*embed.([a-zA-Z0-9]+).*@i"
            if(preg_match('/youtu/', $this->arrParam[$value[1]])){
                if(preg_match('/\?v=/', $this->arrParam[$value[1]])){
                    $this->arrErr[$value[1]] = $warningText;
                }
                else if(preg_match('/\.be/', $this->arrParam[$value[1]])){
                    $this->arrErr[$value[1]] = $warningText;
                }
                else if (preg_match('/embed/', $this->arrParam[$value[1]])){
                    $this->arrErr[$value[1]] = $warningText;
                }
            }
            /* niconicoURL判別 */ //"@^https?://.*nico.*([s|n]m[0-9]+).*@i"
            else if (preg_match('/nico/', $this->arrParam[$value[1]])){
                $this->arrErr[$value[1]] = $warningText;
            }
        }
    }

}
?>
