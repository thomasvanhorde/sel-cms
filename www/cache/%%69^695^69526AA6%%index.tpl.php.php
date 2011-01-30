<?php /* Smarty version 2.6.26, created on 2010-12-08 08:58:57
         compiled from view/index.tpl.php */ ?>
<title><?php echo $this->_tpl_vars['Title']; ?>
</title>

<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['SYS_FOLDER']; ?>
/themes/pQp.css">


TEMPLATE DE PAGE INDEX (view/index.tpl.php)
<br /><br />
voir page :
<br />
/articles
<br />
et /articles/lpcm (test bdd, voir le controller)
<br />
et /engine (test include template from engine dir)
<br />
et /admin (test include template from engine dir)
<br />
(pour jeux de test)
<br />
<h3>bdd accessible ici :: /bdd (chargement un peut long au début ..)</h3>
<br />

<?php echo $this->_tpl_vars['blk']; ?>


<br />
<?php echo $this->_tpl_vars['top']; ?>

<br />

<form method="post">
    <input type="hidden" name="todo" value="articles[register]" />
    <input type="text" name="pseudo" value="toto" />
    <input type="submit" value="valide" />
</form>