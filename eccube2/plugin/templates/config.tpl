<!--{*
 * VideoPlayer
 * Copyright(c) 2012 . Student .
 *
 * http://www.ec-cube.net/
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
 *}-->

<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_header.tpl"}-->
<script type="text/javascript">
</script>

<h2><!--{$tpl_subtitle}--></h2>
<form name="form1" id="form1" method="post" action="<!--{$smarty.server.REQUEST_URI|h}-->">
<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
<input type="hidden" name="mode" value="edit">


<p style="margin-bottom:10px;">動画プレイヤーの設定を行うことができます</p>

<table border="0" cellspacing="1" cellpadding="8" summary=" ">
    <tr>
        <td colspan="2" width="90" bgcolor="#f3f3f3">動画プレイヤー設定
        <br><div style="font-size: 80%; color: #ff0000">動画サイズを16:9にする場合は幅、高さどちらかを未入力にして下さい。</div></td>
        </td>
    </tr>
    <tr >
        <td bgcolor="#f3f3f3">参照商品id</td>

        <td>
        <!--{assign var=key value="product_id"}-->
        <span class="red"><!--{$arrErr[$key]}--></span>
        <input name="<!--{$key}-->" type="text" value="<!--{$arrForm[$key]}-->" size="5" maxlength="<!--{$smarty.const.INT_LEN}-->">
        </td>
    </tr>
    <tr>
        <td bgcolor="#f3f3f3">動画URL<div style="font-size: 80%; color: #666666">登録していない状態ではブロックが省略されます</div></td>

        <td>
        <!--{assign var=key value="video_url"}-->
        <span class="red"><!--{$arrErr[$key]}--></span>
        <input class="box60" maxlength="<!--{$smarty.const.URL_LEN}-->" name="<!--{$key}-->" type="text" value="<!--{$arrForm[$key]}-->" / >
        </td>
    </tr>

    <tr >
        <td bgcolor="#f3f3f3">幅</td>

        <td>
        <!--{assign var=key value="disp_width"}-->
        <span class="red"><!--{$arrErr[$key]}--></span>
        <input type="text" name="<!--{$key}-->" value="<!--{$arrForm[$key]}-->" size="5" maxlength="<!--{$smarty.const.INT_LEN}-->">
        </td>
    </tr>
    <tr >
        <td bgcolor="#f3f3f3">高さ</td>

        <td>
        <!--{assign var=key value="disp_height"}-->
        <span class="red"><!--{$arrErr[$key]}--></span>
        <input type="text" name="<!--{$key}-->" value="<!--{$arrForm[$key]}-->" size="5" maxlength="<!--{$smarty.const.INT_LEN}-->" />
        </td>
    </tr>
</table>



<div class="btn-area">
    <ul>
        <li>
            <a class="btn-action" href="javascript:void(0);" onclick="document.form1.submit();return false;"><span class="btn-next">この内容で登録する</span></a>
        </li>
    </ul>
</div>

</form>
<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_footer.tpl"}-->
