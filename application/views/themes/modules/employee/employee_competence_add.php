<script type="text/javascript">
    $(function(){
        $('#form-competence  form').submit(function(){
            $.post('<?php echo current_url() ?>', $('#form-competence form').serialize(), function(data){
                var obj = $.parseJSON(data);
                
                if(obj.error == 1) {
                    $('.notice').html('<div class="alert">' + obj.notice + '</div>');
                } else {
                    $("#popup_competence").jqxWindow('close');
                    alert(obj.notice);
                    $("#jqxgrid").jqxGrid('updatebounddata', 'filter');
                }
            });

            return false;
        });
    });
</script>
<div id="form-competence" style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <div class="row-fluid notice">
    <?php //$notice = $this->session->flashdata('notice') ?>
    </div>
    <?php echo form_open() ?>
    <input type="hidden" name="id" value="<?php echo $id_employee ?>" />
    <input type="hidden" name="id_comp" value="<?php echo !empty($competence_emp) ? $competence_emp->id_competence_employee : '' ?>" />
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr>
        <td colspan="3" style="font-size:20px"><?php echo $title ?></td>
    </tr>
    <tr id="td_proses" height="30">
        <td colspan="3" align="right">
			<input type="submit" name="submit" class='btn' id='btn_save' value="SAVE" />
		</td>
    </tr>
    <tr>
        <td width='18%'>Name</td>
        <td width='1%'>:</td>
        <td class="white">
            <select name="competence">
            <option value="">Choose</option>
            <?php foreach($competence as $comp) : ?>
            <?php $select = !empty($competence_emp) && $competence_emp->id_mas_competence == $comp->id_mas_competence ? 'selected' : '' ?>
                <option value="<?php echo $comp->id_mas_competence ?>" <?php echo $select; ?>><?php echo $comp->name ?></option>
            <?php endforeach ?>
        </td>
    </tr>
    <tr>
        <td width='18%'>Description</td>
        <td width='1%'>:</td>
        <td class="white">
            <textarea name="desc"><?php echo !empty($competence_emp) ? $competence_emp->description : '' ?></textarea>
        </td>
    </tr>
    </table>
    </form>
</div>
