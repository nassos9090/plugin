<?php /* Smarty version 2.6.26, created on 2012-10-06 13:29:29
         compiled from /var/www/eccube-2.12.2/html/../data/Smarty/templates/default/frontparts/bloc/ranking.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/eccube-2.12.2/html/../data/Smarty/templates/default/frontparts/bloc/ranking.tpl', 1, false),)), $this); ?>
<?php if (count ( ((is_array($_tmp=$this->_tpl_vars['arrRanking'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) ) > 0): ?>
    <ul>
    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrRanking'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myId'] => $this->_tpl_vars['i']):
?>
        <li>
            <?php $this->assign('rank', ((is_array($_tmp=$this->_tpl_vars['myId']+1)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))); ?>
            <span><?php echo ((is_array($_tmp=$this->_tpl_vars['rank'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
位:<?php echo ((is_array($_tmp=$this->_tpl_vars['i']['name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</span>
            </a>
        </li>
    <?php endforeach; endif; unset($_from); ?>
    </ul>
<?php endif; ?>