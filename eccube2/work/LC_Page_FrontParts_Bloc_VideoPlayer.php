<?php
// {{{ requires
require_once CLASS_REALDIR . 'pages/frontparts/bloc/LC_Page_FrontParts_Bloc.php';

/**
 * 新着商品ブロックのブロッククラス
 */
class LC_Page_FrontParts_Bloc_VideoPlayer extends LC_Page_FrontParts_Bloc {

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
        //動画プレイヤー設定情報取得
        $this->arrVideoPlayer = $this->lfGetVideoPlayer();
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
     * @setcookie array
     */
    function lfGetVideoPlayer(){

    }

}
?>
