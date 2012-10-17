<!--{*
 * VideoPlayer
 * Copyright(c) 2012 DELIGHT Inc. All Rights Reserved.
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

<!--{* こちらはお客様ごとに編集してください*}-->
<style type="text/css">
#arrNewItems h2 {
 padding: 5px 0 8px 10px;
 margin-bottom:10px;
 border-style: solid;
 border-color: #f90 #ccc #ccc;
 border-width: 1px 1px 0;
 background: url('<!--{$TPL_URLPATH}-->img/background/bg_btn_bloc_02.jpg') repeat-x left bottom #fef3d8;
}
#arrNewItems{margin-bottom:10px;}
#arrNewItems ul li {float:left; width:115px;}
#arrNewItems ul li p.item_image{ text-align:center;}
#arrNewItems ul li p.price{ font-size:90%;}
#arrNewItems ul li p.price em{ color:#FF0000;}
</style>
<!--{if $arrVideoPlayer}-->
<iframe width="560" height="315" src="http://www.youtube.com/embed/VH_UkAzps3Q?rel=0" frameborder="0" allowfullscreen></iframe>

<!--{/if}-->