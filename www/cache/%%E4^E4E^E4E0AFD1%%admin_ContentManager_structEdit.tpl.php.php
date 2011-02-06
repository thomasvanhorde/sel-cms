<?php /* Smarty version 2.6.26, created on 2011-02-06 22:14:27
         compiled from D:/localhost/sel-cms/trunk/engine/controller/admin/view/admin_ContentManager_structEdit.tpl.php */ ?>
<label>Nom</label><input type="text" value="<?php echo $this->_tpl_vars['struct']['name']; ?>
" />
<label>Description</label><textarea><?php echo $this->_tpl_vars['struct']['description']; ?>
</textarea>

<strong>Elements</strong>
<div>

<?php $_from = $this->_tpl_vars['struct']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['element']):
?>

    <div>
    <?php echo $this->_tpl_vars['element']['type']['name']; ?>


    <?php if ($this->_tpl_vars['element']['structId'] == '1'): ?>
        <input type="text" name="" value=""/>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['element']['structId'] == '2'): ?>
        <textarea name=""><?php echo $this->_tpl_vars['element']['type']['name']; ?>
</textarea>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['element']['structId'] == '3'): ?>
        date
    <?php endif; ?>
    <?php if ($this->_tpl_vars['element']['structId'] == '4'): ?>
        media
    <?php endif; ?>
    </div>
<?php endforeach; endif; unset($_from); ?>
</div>