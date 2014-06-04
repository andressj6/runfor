<style type="text/css">
    .form-soccer {
        display: none;
    }

</style>

<script type="text/javascript">
    $(document).ready(function(){
       $(".radio_tipo").change(function(){
           if($(this).val() == 0) {
               $(".form-3200").show();
               $(".form-soccer").hide();
           } else {
               $(".form-3200").hide();
               $(".form-soccer").show();
           }
       }) ;
    });
</script>

<?php echo form_open('admin/save_avaliacao'); ?>
<input type="hidden" name="aluno_id" value="<?php echo $aluno['id']; ?>"/>
<?php if(isset($avaliacao)): ?>
<input type="hidden" name="avaliacao_id" value="<?php echo $avaliacao['id']; ?>" />
<?php endif; ?>


Nome: <?php echo $aluno['nome']; ?> <br/>
<hr/>
Tipo de Avaliação:
<div class="form-group">
    <label for="data_avaliacao">Data:</label>
    <input type="date" name="data_avaliacao" class="form-control"/>
</div>
<!-- tipos de avaliação -->
<div class="radio">
    <label>
        <input type="radio" name="tipo_avaliacao" id="optionsRadios1" class="radio_tipo" value="0" checked>3200 Metros
    </label>
</div>
<div class="radio">
    <label>
        <input type="radio" name="tipo_avaliacao" id="optionsRadios2" value="1" class="radio_tipo">Soccer Test
    </label>
</div>

<div class="form-group form-3200">
    <label for="tempo ">Tempo: </label>
    <input type="number" name="tempo_3200" />
</div>
<div class="form-group form-soccer">
    <label for="soccer_estagio">Estágio:</label>
    <input type="number" name="soccer_estagio" class="form-control"/>
</div>

<div class="form-group form-soccer">
    <label for="soccer_frequencia">Frequência Cardíaca</label>
    <input type="number" name="soccer_frequencia" class="form-control"/>
</div>


<input type="submit" value="Enviar Avaliação" class="btn btn-success" />

</form>