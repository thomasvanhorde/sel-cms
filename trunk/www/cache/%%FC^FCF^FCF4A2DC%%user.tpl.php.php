<?php /* Smarty version 2.6.26, created on 2011-01-24 20:47:21
         compiled from view/user.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'view/include/head.tpl.php', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body>

	<div id="general">

        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'view/include/headerUser.tpl.php', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php echo $this->_tpl_vars['BigMenu']; ?>


		<div id="content-user">
			<?php echo $this->_tpl_vars['MenuGauche']; ?>


			<?php echo $this->_tpl_vars['Content']; ?>

		</div><!-- Fin #CONTENT-USER -->

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'view/include/footer.tpl.php', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	</div> <!-- Fin #GENERAL -->

</body>
</html>