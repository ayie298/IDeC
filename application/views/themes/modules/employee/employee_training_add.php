<script type="text/javascript">
    $(document).ready(function(){
        $("#tanggal1").jqxDateTimeInput({ width: '140px', height: '30px', formatString: 'yyyy-MM-dd', theme: theme});
	});
</script>
<script type="text/javascript">
    $(function(){
        $('#form-competence  form').submit(function(){
            $.post('<?php echo current_url() ?>', $('#form-competence form').serialize(), function(data){
                var obj = $.parseJSON(data);
                
                if(obj.error == 1) {
                    $('.notice').html('<div class="alert">' + obj.notice + '</div>');
                } else {
                    $("#popup_training").jqxWindow('close');
                    alert(obj.notice);
                    $("#jqxgrid_training").jqxGrid('updatebounddata', 'cells');
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
    <input type="hidden" name="id_train" value="<?php echo !empty($training_emp) ? $training_emp->id_training : '' ?>" />
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr>
        <td colspan="3" style="font-size:20px"><?php echo $title ?></td>
    </tr>
    <tr id="td_proses" height="30">
        <td colspan="3" align="right">
			<input class='btn' id='btn_save' type='submit' name="submit" value="SAVE"/ >
		</td>
    </tr>
    <tr>
        <td width='18%'>Name</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="20" name="name" value="<?php echo !empty($training_emp) ? $training_emp->name : '' ?>" id="Name" placeholder="Name" style="margin: 0;height: 30px;"/></td>
    </tr>
    <tr>
        <td width='18%'>Type</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="type" id="Category" style="width: 300px;margin: 0;">
                <?php foreach($type as $cer) : ?>
                    <option value="<?php echo $cer->id_mas_training_type ?>" <?php echo !empty($training_emp) && $cer->id_mas_training_type == $training_emp->id_mas_training_type ? 'selected' : '' ?>><?php echo $cer->type ?></option>
                <?php endforeach ?>
            </select>
		</td>
    </tr>
    <tr>
        <td width='18%'>Category</td>
        <td width='1%'>:</td>
        <td class="white">
            <select size="1" class="input" name="category" id="Category" style="width: 300px;margin: 0;">
                <?php foreach($category as $cer) : ?>
                    <option value="<?php echo $cer->id_mas_times_category ?>" <?php echo !empty($training_emp) && $cer->id_mas_times_category == $training_emp->id_mas_times_category ? 'selected' : '' ?>><?php echo $cer->category ?></option>
                <?php endforeach ?>
            </select>
        </td>
    </tr>
    <tr>
        <td width='18%'>Organizer</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="40"value="<?php echo !empty($training_emp) ? $training_emp->organizer : '' ?>" name="organizer" id="Type" placeholder="Organizer" style="margin: 0;height: 30px;width:200px"/></td>
    </tr>
    <tr>
        <td width='18%'>Date</td>
        <td width='1%'>:</td>
        <td class="white"><div id='tanggal1' name="tanggal1"></div></td>
    </tr>
    </table>
    </form>
</div>
