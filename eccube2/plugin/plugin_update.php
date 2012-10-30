<?php
/**
 * プラグイン のアップデート用クラス.
 *
 * @package VideoPlayer
 * @author  Student.
 * @version $Id: $
 */
class plugin_update{
   /**
     * アップデート
     * updateはアップデート時に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     * 
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function update($arrPlugin) {
        // nop
        // バージョンの更新
        $objQuery = SC_Query_Ex::getSingletonInstance();
        $objQuery->begin();
        $plugin_id = $arrPlugin['plugin_id'];
        $plugin_version = '0.9.1';  // 新しいバージョン

        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $sqlval = array();
        $table = "dtb_plugin";
        $sqlval['plugin_version'] = $plugin_version;
        $sqlval['update_date'] = 'CURRENT_TIMESTAMP';
        $where = "plugin_id = ?";
        $objQuery->update($table, $sqlval, $where, array($plugin_id));
        $objQuery->commit();
 
        // 変更ファイルの上書き
        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/VideoPlayer.php", PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/VideoPlayer.php");
        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/logo.png", PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/logo.png");

        // ブロック画面の上書き
//        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/bloc/plg_videoplayer.php",  HTML_REALDIR . "frontparts/bloc/plg_videoplayer.php");
//        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/templates/default/plg_videoplayer.tpl",  TEMPLATE_REALDIR . "frontparts/bloc/plg_videoplayer.tpl");
//        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/bloc/LC_Page_FrontParts_Bloc_VideoPlayer.php",  CLASS_REALDIR . "pages/frontparts/bloc/LC_Page_FrontParts_Bloc_VideoPlayer.php");
//        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/bloc/LC_Page_FrontParts_Bloc_VideoPlayer_Ex.php",  CLASS_EX_REALDIR . "page_extends/frontparts/bloc/LC_Page_FrontParts_Bloc_VideoPlayer_Ex.php");

        // プラグイン設定画面の上書き
//        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/config.php", PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/config.php");
//        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/LC_Page_Plugin_VideoPlayer_Config.php", PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/config.phpLC_Page_Plugin_VideoPlayer_Config.php");
//        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/templates/config.tpl",  PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/templates/config.tpl");
    }
}
?>