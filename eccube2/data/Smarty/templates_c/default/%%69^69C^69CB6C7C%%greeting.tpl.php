<?php /* Smarty version 2.6.26, created on 2012-10-06 13:29:29
         compiled from /var/www/eccube-2.12.2/html/../data/Smarty/templates/default/frontparts/bloc/greeting.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/eccube-2.12.2/html/../data/Smarty/templates/default/frontparts/bloc/greeting.tpl', 1, false),array('modifier', 'u', '/var/www/eccube-2.12.2/html/../data/Smarty/templates/default/frontparts/bloc/greeting.tpl', 3, false),array('modifier', 'date_format', '/var/www/eccube-2.12.2/html/../data/Smarty/templates/default/frontparts/bloc/greeting.tpl', 4, false),)), $this); ?>
      <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrPurchaseProducts'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['PurchaseProduct']):
?>
      <li>
      <a href="<?php echo ((is_array($_tmp=@P_DETAIL_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['PurchaseProduct']['product_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('u', true, $_tmp) : smarty_modifier_u($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['PurchaseProduct']['product_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</a>
      <span><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['PurchaseProduct']['create_date'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y/%m/%d") : smarty_modifier_date_format($_tmp, "%Y/%m/%d")); ?>
<br />
      </li>
      <?php endforeach; endif; unset($_from); ?>