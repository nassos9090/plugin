<!--{if count($arrRanking) > 0}-->
    <ul>
    <!--{foreach from=$arrRanking key=myId item=i}-->
        <li>
            <!--{assign var=rank value=$myId+1}-->
            <span><!--{$rank}-->位:<!--{$i.name}--></span>
            </a>
        </li>
    <!--{/foreach}-->
    </ul>
<!--{/if}-->