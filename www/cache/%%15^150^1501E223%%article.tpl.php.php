<?php /* Smarty version 2.6.26, created on 2010-12-20 10:10:47
         compiled from controller/articles/view/article.tpl.php */ ?>
Un article en particulier

<br /><br />
Liste des parametres suppl�mentaires <br />
<?php $_from = $this->_tpl_vars['parametres']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cle'] => $this->_tpl_vars['foo']):
?>
	<?php echo $this->_tpl_vars['cle']; ?>
 - <?php echo $this->_tpl_vars['foo']; ?>
<br />
<?php endforeach; endif; unset($_from); ?>

<?php echo $this->_tpl_vars['toto']; ?>
