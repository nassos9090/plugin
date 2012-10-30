<!--{*
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
*}-->

<!--{if $arrVideo.view_id == 'youtube'}-->
    <iframe width="<!--{$arrVideo.disp_width|h}-->" height="<!--{$arrVideo.disp_height|h}-->" 
		src="<!--{$youtube_url|h}--><!--{$arrVideo.youtube_id|h}-->?modestbranding=1&amp;rel=0"frameborder="0"allowfullscreen>
    </iframe>

<!--{elseif $arrVideo.view_id == 'niconico'}-->
    <script type="text/javascript" src="<!--{$nico_url|h}--><!--{$arrVideo.niconico_id|h}-->
					?w=<!--{$arrVideo.disp_width|h}-->
					&amp;h=<!--{$arrVideo.disp_height|h}-->">
    </script>
    <noscript>
	<a href="<!--{$arrVideo.nico_url|h}--><!--{$arrVideo.niconico_id|h}-->">
		動画はこちら
	</a>
    </noscript>

<!--{/if}-->