<?php
/*
* プラグインの名前、もしくは何をするのかについての簡単な説明（必須）
* Copyright (C) 作成年（必須）、プラグイン作者名（必須）
* 問合せ先email or URL（任意）
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
     /* youtubeのURLリンク*/
     var $youtube_url = 'http://www.youtube.com/embed/';
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
	$this->aaa = preg_replace('/.*v=([\d\w]+).*/', '$1', 'http://www.youtube.com/watch?v=XQmhg9_Gpeo&feature=g-all-xit');
        return $arrVideoPlayer;
    }
}
