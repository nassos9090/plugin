

<!--{$youtube_id|@debug_print_var}--><br>
<!--{$view_id|@debug_print_var}--><br>

<!--{if $view_id == 'youtube'}-->
    <iframe width="<!--{$video_width|h}-->" height="<!--{$video_height|h}-->" 
		src="<!--{$youtube_url|h}--><!--{$youtube_id|h}-->?showinfo=0
        	&amp;rel=0&amp;fs=0&amp;controls=1&amp;autohide=1"
		frameborder="0">
    </iframe>

<!--{elseif $view_id == 'niconico'}-->
    <script type="text/javascript" src="<!--{$nico_url|h}--><!--{$niconico_id|h}-->
					?w=<!--{$video_width|h}-->
					&amp;h=<!--{$video_height|h}-->">
    </script>
    <noscript>
	<a href="<!--{$nico_url|h}--><!--{$niconico_id|h}-->">
		動画はこちら
	</a>
    </noscript>
<!--{/if}-->
