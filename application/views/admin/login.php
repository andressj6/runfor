

<h1>Administrativo</h1>
<div class="container form-input-750">
<?php if(isset($error)): ?>
<div class="alert alert-warning"><?php echo $error; ?> </div>
<?php endif; ?>

<?php echo form_open('admin/login_post'); ?>

<div class="form-group">
    <label for="login">Login:</label>
    <input type="text" name="login" class="form-control"/>
</div>

<div class="form-group">
    <label for="senha">Senha:</label>
    <input type="password" name="senha" class="form-control"/>
</div>

<div class="form-group">
    <input type="submit" value="Entrar" class="btn btn-success"/>
</div>

</form>
</div>