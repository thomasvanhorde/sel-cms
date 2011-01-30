<?php /* Smarty version 2.6.26, created on 2011-01-25 12:36:24
         compiled from view/include/headerUser.tpl.php */ ?>
<div id="header">
    <div id="connexion">
        <img src="<?php echo $this->_tpl_vars['FOLDER_THEME']; ?>
defaut/connexion.png" alt="image connection"/>
        <p>
            <?php if ($this->_tpl_vars['is_login']): ?>
              <a href="<?php echo $this->_tpl_vars['SYS_FOLDER']; ?>
user/disconnect/" title="deconnection du compte">Se déconnecter.</a>
            <?php else: ?>
              <a href="<?php echo $this->_tpl_vars['SYS_FOLDER']; ?>
user/login/" title="connection au compte">Se connecter</a>
            <?php endif; ?>
        </p>
    </div>
	<ul id="menu">
		<li><a href="<?php echo $this->_tpl_vars['SYS_FOLDER']; ?>
" title="Accueil">Accueil</a></li>
		<li><a href="<?php echo $this->_tpl_vars['SYS_FOLDER']; ?>
les-annonces/" title="Consulter les annonces">Consulter les annonces</a></li>
		<li><a href="<?php echo $this->_tpl_vars['SYS_FOLDER']; ?>
qui-somme-nous/" title="Qui sommes-nous ?">Qui sommes-nous ?</a></li>
		<li><a href="<?php echo $this->_tpl_vars['SYS_FOLDER']; ?>
contacts/" title="Contacts">Contacts</a></li>
	</ul><!-- Fin #MENU-->
</div><!-- Fin #HEADER-->