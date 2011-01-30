<?php /* Smarty version 2.6.26, created on 2010-12-23 23:02:45
         compiled from view/drupal.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'thumb', 'view/drupal.tpl.php', 16, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html class="js" dir="ltr" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="alternate" type="application/rss+xml" title="Orange demo RSS" href="http://drupal.amandarodriguez.com/rss.xml">
        <link rel="shortcut icon" href="http://drupal.amandarodriguez.com/misc/favicon.ico" type="image/x-icon">
        <title><?php echo $this->_tpl_vars['title']; ?>
</title>
		<?php if ($this->_tpl_vars['DEBUG']): ?><link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['SYS_FOLDER']; ?>
themes/pQp.css"><?php endif; ?>
        <link type="text/css" rel="stylesheet" media="all" href="<?php echo $this->_tpl_vars['SYS_FOLDER']; ?>
themes/admin.css">
    </head>

    <body class="anonymous-user right">

    <?php echo smarty_function_thumb(array('file' => "media/images/google.jpg",'width' => '150','link' => 'false','html' => 'class="img float"'), $this);?>



        <div id="wrapper">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'view/test/header-top.tpl.php', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'view/test/header.tpl.php', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


            <div id="container">
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'view/test/content-top.tpl.php', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <?php echo $this->_tpl_vars['main']; ?>

                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'view/test/sidebar.tpl.php', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <div class="clear"> </div>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'view/test/content-bottom.tpl.php', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
        </div> <!-- end wrapper -->

        <div id="footer">
          <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'view/test/footer.tpl.php', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </div> <!-- end footer -->

    </body>

</html>