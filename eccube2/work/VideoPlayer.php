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
class VideoPlayer extends SC_Plugin_Base {
 
    /**
     * コンストラクタ
     *
     */
    public function __construct(array $arrSelfInfo) {
        parent::__construct($arrSelfInfo);
    }
 
    /**
     * インストール
     * installはプラグインのインストール時に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin plugin_infoを元にDBに登録されたプラグイン情報(dtb_plugin)
     * @return void
     */
    function install($arrPlugin) {
        // ファイルコピー
        if(copy(PLUGIN_UPLOAD_REALDIR . "VideoPlayer/logo.png", PLUGIN_HTML_REALDIR . "VideoPlayer/logo.png") === false);
        if(copy(PLUGIN_UPLOAD_REALDIR . "VideoPlayer/VideoPlayer.php", PLUGIN_HTML_REALDIR . "VideoPlayer/VideoPlayer.php") === false);

        // ブロック
        if(copy(PLUGIN_UPLOAD_REALDIR . "VideoPlayer/templates/default/plg_videoplayer.tpl", TEMPLATE_REALDIR . "frontparts/bloc/plg_videoplayer.tpl") === false);
        if(copy(PLUGIN_UPLOAD_REALDIR . "VideoPlayer/bloc/plg_videoplayer.php", HTML_REALDIR . "frontparts/bloc/plg_videoplayer.php") === false);
        if(copy(PLUGIN_UPLOAD_REALDIR . "VideoPlayer/bloc/LC_Page_FrontParts_Bloc_VideoPlayer.php", CLASS_REALDIR . "pages/frontparts/bloc/LC_Page_FrontParts_Bloc_VideoPlayer.php") === false);
        if(copy(PLUGIN_UPLOAD_REALDIR . "VideoPlayer/bloc/LC_Page_FrontParts_Bloc_VideoPlayer_Ex.php", CLASS_EX_REALDIR . "page_extends/frontparts/bloc/LC_Page_FrontParts_Bloc_VideoPlayer_Ex.php") === false);

        //config
//        if(copy(PLUGIN_UPLOAD_REALDIR . "VideoPlayer/config.php", PLUGIN_HTML_REALDIR . "VideoPlayer/config.php") === false);

        // 初期設定値を挿入
        VideoPlayer::insertFreeField();
    }
 
    /**
     * アンインストール
     * uninstallはアンインストール時に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function uninstall($arrPlugin) {
        VideoPlayer::uninsertFreeField();
        // ファイル削除
        if(SC_Helper_FileManager_Ex::deleteFile(PLUGIN_HTML_REALDIR . "VideoPlayer/logo.png") === false); print_r("失敗");
        if(SC_Helper_FileManager_Ex::deleteFile(PLUGIN_HTML_REALDIR . "VideoPlayer/VideoPlayer.php") === false); print_r("失敗");

        if(SC_Helper_FileManager_Ex::deleteFile(TEMPLATE_REALDIR . "frontparts/bloc/plg_videoplayer.tpl") === false); print_r("失敗");
        if(SC_Helper_FileManager_Ex::deleteFile(HTML_REALDIR . "frontparts/bloc/plg_videoplayer.php") === false); print_r("失敗");
        if(SC_Helper_FileManager_Ex::deleteFile(CLASS_REALDIR . "pages/frontparts/bloc/LC_Page_FrontParts_Bloc_VideoPlayer.php") === false); print_r("失敗");
        if(SC_Helper_FileManager_Ex::deleteFile(CLASS_EX_REALDIR . "page_extends/frontparts/bloc/LC_Page_FrontParts_Bloc_VideoPlayer_Ex.php") === false); print_r("失敗");
    }

    /**
     * 稼働
     * enableはプラグインを有効にした際に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function enable($arrPlugin) {

        // ブロック登録
        VideoPlayer::insertBloc($arrPlugin);

    }

    /**
     * 停止
     * disableはプラグインを無効にした際に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function disable($arrPlugin) {

        // ブロック削除
        VideoPlayer::deleteBloc($arrPlugin);

    }

    // プラグイン独自の設定データを追加
    function insertFreeField() {
        $objQuery = SC_Query_Ex::getSingletonInstance();
        $teblenamelist = $objQuery->listTables();
        $searchVar = "dtb_videoplayer";

        if(VideoPlayer::Search($teblenamelist , $searchVar)){
            // テーブルを削除する.（PC）
            $objQuery->query("DROP TABLE dtb_videoplayer");
        }
        // テーブルの作成とデータの追加(dtb_videoplayer)
        $objQuery->query("CREATE TABLE dtb_videoplayer(id integer,
                                                       product_id integer NOT NULL,
                                                       video_url text,
                                                       disp_width integer,
                                                       disp_height integer,
                                                       PRIMARY KEY (id))");//
        // INSERTする
        for($i=1;$i<4;$i++){
            $sqlval_dtb_videoplayer = array();
            $sqlval_dtb_videoplayer['id'] = $i;
            $sqlval_dtb_videoplayer['product_id'] = $i;
            $sqlval_dtb_videoplayer['video_url'] = "http://www.youtube.com/watch?v=z63DeH0eTeU&feature=plcp";
            $sqlval_dtb_videoplayer['disp_width'] = 380;
            $sqlval_dtb_videoplayer['disp_height'] = 260;
            $objQuery->insert("dtb_videoplayer", $sqlval_dtb_videoplayer);
        }

        $sqlval['update_date'] = 'CURRENT_TIMESTAMP';
        $where = "plugin_code = ?";
        // UPDATEの実行
        $objQuery->update('dtb_plugin', $sqlval, $where, array('VideoPlayer'));
    }

    // プラグイン独自の設定データを削除
    function uninsertFreeField() {

        $objQuery = SC_Query_Ex::getSingletonInstance();
        $teblenamelist = $objQuery->listTables();
        $searchVar = "dtb_videoplayer";
        if(VideoPlayer::Search($teblenamelist , $searchVar)){
            // テーブルを削除する.（PC）
            $objQuery->query("DROP TABLE dtb_videoplayer");
        }

    }

    function insertBloc($arrPlugin) {
        $objQuery = SC_Query_Ex::getSingletonInstance();
        $searchcol = $objQuery->getCol("filename", "dtb_bloc","");

        if(VideoPlayer::Search($searchcol,"plg_videoplayer")){
            // ブロックを削除する.（PC）
            $arrBlocId = $objQuery->getCol('bloc_id', "dtb_bloc", "device_type_id = ? AND filename = ?", array(DEVICE_TYPE_PC , "plg_videoplayer"));
            $bloc_id = (int) $arrBlocId[0];
            $where = "bloc_id = ? AND device_type_id = ?";
            $objQuery->delete("dtb_bloc", $where, array($bloc_id,DEVICE_TYPE_PC));
            $objQuery->delete("dtb_blocposition", $where, array($bloc_id,DEVICE_TYPE_PC));
        }

        // PCにdtb_blocにブロックを追加する.
        $sqlval_bloc = array();
        $sqlval_bloc['device_type_id'] = DEVICE_TYPE_PC;
        $sqlval_bloc['bloc_id'] = $objQuery->max('bloc_id', "dtb_bloc", "device_type_id = " . DEVICE_TYPE_PC) + 1;
        $sqlval_bloc['bloc_name'] = $arrPlugin['plugin_name'];
        $sqlval_bloc['tpl_path'] = "plg_videoplayer.tpl";
        $sqlval_bloc['filename'] = "plg_videoplayer";
        $sqlval_bloc['create_date'] = "CURRENT_TIMESTAMP";
        $sqlval_bloc['update_date'] = "CURRENT_TIMESTAMP";
        $sqlval_bloc['php_path'] = "frontparts/bloc/plg_videoplayer.php";
        $sqlval_bloc['deletable_flg'] = 0;
        $sqlval_bloc['plugin_id'] = $arrPlugin['plugin_id'];
        $objQuery->insert("dtb_bloc", $sqlval_bloc);

    }

    function deleteBloc($arrPlugin) {
        $objQuery = SC_Query_Ex::getSingletonInstance();
        $searchcol = $objQuery->getCol("filename", "dtb_bloc","");

        if(VideoPlayer::Search($searchcol,"plg_videoplayer")){
            $arrBlocId = $objQuery->getCol('bloc_id', "dtb_bloc", "device_type_id = ? AND filename = ?", array(DEVICE_TYPE_PC , "plg_videoplayer"));
            $bloc_id = (int) $arrBlocId[0];
            // ブロックを削除する.（PC）
            $where = "bloc_id = ? AND device_type_id = ?";
            $objQuery->delete("dtb_bloc", $where, array($bloc_id,DEVICE_TYPE_PC));
            $objQuery->delete("dtb_blocposition", $where, array($bloc_id,DEVICE_TYPE_PC));
        }

    }

    //DB検索 配列検索
    function Search($arrData , $searchVar){
        foreach($arrData as $value){
            if($value == $searchVar){
                return ture;
            }
        }
        return false;//
    }


    /**
     * プレフィルタコールバック関数
     *
     * @param string &$source テンプレートのHTMLソース
     * @param LC_Page_Ex $objPage ページオブジェクト
     * @param string $filename テンプレートのファイル名
     * @return void
     */
    function prefilterTransform(&$source, LC_Page_Ex $objPage, $filename) {
var_dump($objPage->arrVideo);
        $objTransform = new SC_Helper_Transform($source);
        $template_dir = PLUGIN_UPLOAD_REALDIR . 'VideoPlayer/templates/';
        switch($objPage->arrPageLayout['device_type_id']){
            case DEVICE_TYPE_PC:
                // 商品詳細画面


                if (strpos($filename, 'products/detail.tpl') !== false) {

echo $template_dir . 'plg_videoplayer.tpl';

var_dump(file_get_contents($template_dir . 'plg_videoplayer.tpl'));
                    $objTransform->select('div.cart_area')->insertAfter(file_get_contents($template_dir . 'plg_videoplayer.tpl'));
                }
                break;
            case DEVICE_TYPE_MOBILE:
            case DEVICE_TYPE_SMARTPHONE:
            case DEVICE_TYPE_ADMIN:
            default:
                break;
        }
        $source = $objTransform->getHTML();
    }

    /**
     * 処理の介入箇所とコールバック関数を設定
     * registerはプラグインインスタンス生成時に実行されます
     *
     * @param SC_Helper_Plugin $objHelperPlugin
     */
    function register(SC_Helper_Plugin $objHelperPlugin) {
        $objHelperPlugin->addAction('LC_Page_Products_Detail_action_after', array($this, 'LC_ProductsDetail'));
        $objHelperPlugin->addAction('prefilterTransform', array(&$this, 'prefilterTransform'));
    }

    function LC_ProductsDetail($objPage){

        /* youtubeのURLリンク */
        $objPage->youtube_url = 'http://www.youtube.com/embed/';

        /* niconicoのURLリンク */
        $objPage->nico_url = 'http://ext.nicovideo.jp/thumb_watch/';

        /* 動画判別用 */
	$objPage->arrVideo = VideoPlayer::lfGetURL($objPage);

        // 動画プレイヤー設定情報取得
        $objPage->arrVideoData = VideoPlayer::lfGetVideoPlayer($objPage);


	if ($objPage->arrVideo['disp_width'] <= 50 && $objPage->arrVideo['disp_height'] <= 50){
	    $objPage->arrVideo['disp_width'] = 100;
	    $objPage->arrVideo['disp_height'] = 100;
        }

	/* アスペクト比の計算 */
	if ($objPage->arrVideo['disp_width'] <= 50){
           $objPage->arrVideo['disp_width'] = $objPage->arrVideo['disp_height'] / 9 * 16;
	}
	if ($objPage->arrVideo['disp_height'] <= 50){
            $objPage->arrVideo['disp_height'] = $objPage->arrVideo['disp_width'] / 16 * 9;
	}
        $objPage->arrVideo['youtube_id'] = $objPage->arrVideoData->youtube_id;
	$objPage->arrVideo['view_id'] = $objPage->arrVideoData->view_id;
	$objPage->arrVideo['niconico_id'] = $objPage->arrVideoData->niconico_id;
    }

    /**
     * 動画プレイヤー設定情報取得
     *
     * @return array
     */
    function lfGetVideoPlayer(&$objPage){
	$objQuery = new SC_Query();
	$col = '*'; //カラム
	$table = 'dtb_videoplayer'; //テーブル名
	$arrVideos = $objQuery->select($col,$table);
	// youtube検索パターン
	$youtube_pattern1 = '/http:\/\/www.youtube.com\/watch\?v=([-\d\w]{11}).*/';
	$youtube_pattern2 = '/.*\.be.*([\d\w-]{11})/';
	$youtube_pattern3 = '/.*.embed.([\d\w-]{11}).*/';
	// niconico検索パターン
	$niconico_pattern = '/http:\/\/www.*nicovideo.*([s|n]m[\d]+)/';

	/* yotubeURL判別 */
	if (preg_match('/youtu/', $objPage->arrVideo['video_url'])){
	    if (preg_match('/\?v=/', $objPage->arrVideo['video_url'])){
		$arrVideo->view_id = 'youtube';
		$arrVideo->youtube_id = preg_replace($youtube_pattern1,'$1',$objPage->arrVideo['video_url']);
	    }
	    else if (preg_match('/\.be/', $objPage->arrVideo['video_url'])){
		$arrVideo->view_id = 'youtube';
		$arrVideo->youtube_id = preg_replace($youtube_pattern2,'$1',$objPage->arrVideo['video_url']);
	    }
	    else if (preg_match('/embed/', $objPage->arrVideo['video_url'])){
		$arrVideo->view_id = 'youtube';
		$arrVideo->youtube_id = preg_replace($youtube_pattern3,'$1',$objPage->arrVideo['video_url']);
	    }
	    else{
	        $arrVideo->view_id = 'get url failed';
	    }
	}
	/* niconicoURL判別 */
	else if (preg_match('/nico/', $objPage->arrVideo['video_url'])){
		$arrVideo->niconico_id = preg_replace($niconico_pattern,'$1',$objPage->arrVideo['video_url']);
		$arrVideo->view_id = 'niconico';
	}
	else if ($objPage->arrVideo['video_url'] != ''){
	     $arrVideo->  view_id = 'get url failed';
	}
        else{
             $arrVideo->  view_id = 'NULL';
        }
      //  print();
        //return $arrVideoPlayer
         return $arrVideo;
    }


    function lfGetURL($objPage){
	$objQuery = new SC_Query();
	$list_id = array();
	$list_id = $objQuery->getCol('product_id', 'dtb_videoplayer');

        foreach($list_id as $value){
	    if($value == $objPage->arrProduct["product_id"]){
		//$objPage->arrVideo = $objQuery->getRow('video_url,disp_width,disp_height', 'dtb_videoplayer', 'product_id = ?', array($this->product_id));

                return $objQuery->getRow('video_url,disp_width,disp_height', 'dtb_videoplayer', 'product_id = ?', array($objPage->arrProduct["product_id"]));
	    }
	}
	
    }
}