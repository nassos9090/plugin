      <!--{foreach from=$arrPurchaseProducts item=PurchaseProduct}-->
      <li>
      <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$PurchaseProduct.product_id|u}-->"><!--{$PurchaseProduct.product_name}--></a>
      <span><!--{$PurchaseProduct.create_date|date_format:"%Y/%m/%d"}--><br />
      </li>
      <!--{/foreach}-->
