<?php /* Smarty version 2.6.26, created on 2010-11-24 11:29:13
         compiled from /wamp/www/fac/smallProjet/engine/view/index.tpl.php */ ?>
<title><?php echo $this->_tpl_vars['Title']; ?>
</title>

TEMPLATE DE PAGE INDEX (view/index.tpl.php)
<br /><br />
voir page :
<br />
/articles
<br />
et /articles/seconde
<br />
(pour jeux de test)
<br />
<br />

<?php echo $this->_tpl_vars['blk']; ?>


<br />
<br />

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'view/footer.tpl.php', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>