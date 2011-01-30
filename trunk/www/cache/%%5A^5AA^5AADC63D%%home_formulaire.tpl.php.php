<?php /* Smarty version 2.6.26, created on 2011-01-14 18:13:23
         compiled from controller/home/view/home_formulaire.tpl.php */ ?>
<form id="inscriptionForm" action="<?php echo $this->_tpl_vars['SYS_FOLDER']; ?>
user/register/" method="post">
  <ul id="inscription">
    <li><input type="hidden" name="todo" value="user[register]" /></li>
    <li>Login :<input type="text" name="login" /></li>
    <li>Mot de Passe :<input type="password" name="password" /></li>
    <li>E-Mail :<input type="text" name="email" /></li>
    <li>Adresse :<input type="text" name="adresse" /></li>
    <li>Ville :<input type="text" name="ville" /></li>
    <li>Code Postal :<input type="text" name="cp" /></li>
    <li>T&eacute;l&eacute;phone :<input type="text" name="tel" /></li>
  </ul>
  <p><input type="submit" class="valider-form"/></p>
</form>