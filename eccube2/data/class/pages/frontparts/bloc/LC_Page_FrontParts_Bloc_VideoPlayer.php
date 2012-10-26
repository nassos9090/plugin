<?php
/*
* VideoPlayer
* Copyright (C) 2012/10/25 katube
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
require_once CLASS_EX_REALDIR . 'page_extends/frontparts/bloc/LC_Page_FrontParts_Bloc_Ex.php';

/**
 * 新着商品ブロックのブロッククラス
 */
class LC_Page_FrontParts_Bloc_VideoPlayer extends LC_Page_FrontParts_Bloc_Ex {

     // {{{ properties

     /* youtubeのURLリンク */
     var $youtube_url = 'http://www.youtube.com/embed/';

     /* niconicoのURLリンク */
     var $nico_url = 'http://ext.nicovideo.jp/thumb_watch/';

     /* 動画の横幅 */
     var $video_width;

     /* 動画の高さ */
     var $video_height;

     /* 動画判別用 */
     var $view_id;

     // }}} properties

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

        // パラメーター管理クラス
        $this->objFormParam = new SC_FormParam_Ex();
        // パラメーター情報の初期化
        $this->arrForm = $this->lfInitParam($this->objFormParam);
        // プロダクトIDの正当性チェック
        $this->product_id = $this->objFormParam->getValue('product_id');
	// 現在のURLからproduct_idを取得
	$this -> lfGetURL();
        // 動画プレイヤー設定情報取得
        $this->arrVideoPlayer = $this->lfGetVideoPlayer();

	//$this->lfGetURL;

//echo $this->arrVideo['disp_width'];
//echo $this->arrVideo['disp_height'];
        
	if ($this->arrVideo['disp_width'] <= 50 && $this->arrVideo['disp_height'] <= 50){
	    $this->arrVideo['disp_width'] = 100;
	    $this->arrVideo['disp_height'] = 100;
        }

	/* アスペクト比の計算 */
	if ($this->arrVideo['disp_width'] <= 50){
           $this->arrVideo['disp_width'] = $this->arrVideo['disp_height'] / 9 * 16;
	}
	if ($this->arrVideo['disp_height'] <= 50){
            $this->arrVideo['disp_height'] = $this->arrVideo['disp_width'] / 16 * 9;
	}

//echo $this->arrVideo['disp_width'];
//echo $this->arrVideo['disp_height'];

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
     * 動画プレイヤー設定情報取得
     *
     * @return array
     */
    function lfGetVideoPlayer(){
	$objQuery = new SC_Query();
	$col = '*'; //カラム
	$table = 'dtb_videoplayer'; //テーブル名
	$arrVideos = $objQuery->select($col,$table);
	// youtube検索パターン
	$youtube_pattern1 = '/^https?.*youtu.*v=([\d\w-]{11}).*/';
	$youtube_pattern2 = '/.*\.be.([\d\w-]{11})/';
	$youtube_pattern3 = '/.*.embed.([\d\w-]{11}).*/';
	// niconico検索パターン
	$niconico_pattern = '/^https?.*nicovideo.*([s|n]m[\d]+)/';

	/* yotubeURL判別 */
	if (preg_match('/youtu/', $this->arrVideo['video_url'])){
	    if (preg_match('/\?v=/', $this->arrVideo['video_url'])){
		$this->view_id = 'youtube';
		$this->youtube_id = preg_replace($youtube_pattern1,'$1',$this->arrVideo['video_url']);
	    }
	    if (preg_match('/\.be/', $this->arrVideo['video_url'])){
		$this->view_id = 'youtube';
		$this->youtube_id = preg_replace($youtube_pattern2,'$1',$this->arrVideo['video_url']);
	    }
	    if (preg_match('/embed/', $this->arrVideo['video_url'])){
		$this->view_id = 'youtube';
		$this->youtube_id = preg_replace($youtube_pattern3,'$1',$this->arrVideo['video_url']);
	    }
	    else{
	        $this->view_id = 'get url failed';
	    }
	}
	/* niconicoURL判別 */
	else if (preg_match('/nico/', $this->arrVideo['video_url'])){
		$this->niconico_id = preg_replace($niconico_pattern,'$1',$this->arrVideo['video_url']);
		$this->view_id = 'niconico';
	}
	else {
	     $this->  view_id = 'get url failed';
	}
        return $arrVideoPlayer;
    }


    function lfGetURL(){
	$objQuery = new SC_Query();
	$list_id = array();
	$list_id = $objQuery->getCol('product_id', 'dtb_videoplayer');
        foreach($list_id as $value){
	    if($value == $this->product_id){
		$this->arrVideo = $objQuery->getRow('video_url,disp_width,disp_height', 'dtb_videoplayer', 'product_id = ?', array($this->product_id));
	        //var_dump($this->video_url);
	    }
	}
	
    }

    /* パラメーター情報の初期化 */
    function lfInitParam(&$objFormParam) {
        $objFormParam->addParam('商品ID', 'product_id', INT_LEN, 'n', array('EXIST_CHECK', 'ZERO_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        // 値の取得
        $objFormParam->setParam($_REQUEST);
        // 入力値の変換
        $objFormParam->convParam();
        // 入力情報を渡す
        return $objFormParam->getFormParamList();
    }
}