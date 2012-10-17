<?php /* Smarty version 2.6.26, created on 2012-10-06 13:29:29
         compiled from /var/www/eccube-2.12.2/html/../data/Smarty/templates/default/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/eccube-2.12.2/html/../data/Smarty/templates/default/index.tpl', 24, false),array('modifier', 'rand', '/var/www/eccube-2.12.2/html/../data/Smarty/templates/default/index.tpl', 28, false),)), $this); ?>

<div id="main_image">
    <a href="<?php echo ((is_array($_tmp=@P_DETAIL_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
1" onmouseover="chgImg('<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/banner/bnr_top_main_on.jpg','bnr_top_main');" onmouseout="chgImg('<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/banner/bnr_top_main.jpg','bnr_top_main');">
        <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/banner/bnr_top_main.jpg" alt="詳細はこちら" id="bnr_top_main" name="bnr_top_main" />
    </a>

<?php $this->assign('mynum', ((is_array($_tmp=1)) ? $this->_run_mod_handler('rand', true, $_tmp, 3) : rand($_tmp, 3))); ?>
<br />
    <?php if (((is_array($_tmp=$this->_tpl_vars['mynum'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 1): ?>
        <a href="<?php echo ((is_array($_tmp=@P_DETAIL_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
1">アイス</a>
    <?php elseif (((is_array($_tmp=$this->_tpl_vars['mynum'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 2): ?>
　　    <a href="<?php echo ((is_array($_tmp=@P_DETAIL_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
2">おなべ</a>
    <?php else: ?>
　　    <a href="<?php echo ((is_array($_tmp=@P_DETAIL_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
3">レシピ</a>
    <?php endif; ?>



</div>