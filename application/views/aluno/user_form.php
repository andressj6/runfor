<h2>Cadastre-se!</h2>
    <?php echo validation_errors(); ?>

<?php echo form_open('aluno/form_post') ?>

    <h3> Dados de Acesso </h3>
    
	<label for="nome">Nome:</label>
	<input type="text" class="form-control" name="nome" /><br />

    <label for="senha">Data de Nascimento:</label>
    <input type="date" class="form-control" name="dataNascimento" /><br />

    <label for="email">Email:</label>
    <input type="text" class="form-control" name="email" /><br />

    <label for="senha">Senha:</label>
    <input type="password" class="form-control" name="senha" /><br />


    <hr />
    
    <h3> Endereço </h3>
    <label for="endereco">Endereço:</label>
	<input type="text"  class="form-control"name="endereco" /><br />
	
	<label for="bairro">Bairro:</label>
	<input type="text" class="form-control" name="bairro" /><br />
	
	<label for="complemento">Complemento:</label>
	<input type="text" class="form-control" name="complemento" /><br />
	
	<label for="cidade">Cidade:</label>
	<input type="text" class="form-control" name="cidade" /><br />
	
	<label for="estado">Estado:</label>
	<select name="estado">
	    <option value="GO">Goiás</option>
	</select><br />
	<hr />
	
    <h3>Dados Médicos</h3>	
    
    <label for="altura">Altura:</label>
	<input type="text" class="form-control" name="altura" /><br />
	
	<label for="peso">Peso:</label>
	<input type="text" class="form-control" name="peso" /><br />
	
	<input type="submit" class="btn btn-default" name="submit" value="Enviar!" />

</form>