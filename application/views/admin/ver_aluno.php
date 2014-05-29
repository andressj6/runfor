Ver aluno - id: <?php echo $aluno['id']; ?> <br />
Nome: <?php echo $aluno['nome']; ?> <br/>
Treino atual:

<img src="<?php echo base_url("/images/treinos/".$aluno['id']);?>.png" /><br/>

<?php echo $error;?>
<?php echo form_open_multipart('admin/upload_treino');?>
Enviar Treino: <input type="file" name="treino" size="20" />
<input type="hidden" name="id_aluno" value="<?php echo $aluno['id']; ?>" />
<input type="submit" value="upload" />

</form>