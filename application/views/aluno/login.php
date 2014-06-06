<h2>Entrar!</h2>

<?php echo validation_errors(); ?>

<?php if(!empty($error)) : ?>
<div class="alert alert-danger">
    <?php echo $error; ?>
</div>
<?php endif; ?>


<?php echo form_open('aluno/login_post') ?>

	<label for="email">Email:</label>
	<input type="email" class="form-control" name="email" /><br />

	<label for="senha">Senha:</label>
	<input type="password" class="form-control" name="senha" /><br />

	<input type="submit" name="submit" value="Entrar" />

</form>
<a href="<?php echo site_url('aluno/novo'); ?>">Cadastre-Se!</a>