<table class="table" style="text-align: center" >
    <tr>
        <td>
            <a href="<?php echo site_url('aluno/ver_treino')?>">
                <img src="/runfor/images/icone_treinos.jpg" style="width: 200px;"/><br />
                <span  >Treinos </span>
            </a>
        </td>
        <td>
            <a href="<?php echo site_url('aluno/ver_avaliacoes')?>">
                <img src="/runfor/images/icone_avaliacoes.jpg" style="width: 200px;"/>
            </a>
        </td>
        <td>
            <a href="<?php echo site_url('aluno/calendario')?>">
                <img src="/runfor/images/icone_calendario.jpg" style="width: 200px;"/>
            </a>
        </td>
    </tr>
</table>

<?php var_dump($this->session->userdata('aluno')); ?>