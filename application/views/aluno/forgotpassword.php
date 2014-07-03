<div class="container form-input-750">

<?php if(isset($error)) : ?>
	<div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<?php echo form_open('aluno/forgotpassword_post') ?>

	<label for="email">Email:</label>
	<input type="email" class="form-control" name="email" /><br />

	<input type="submit" name="submit" value="Enviar" class="btn btn-success"/>

</form>

</div>