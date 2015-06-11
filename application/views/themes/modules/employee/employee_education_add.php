<script type="text/javascript">
    $(document).ready(function(){
        
	});
</script>
<script type="text/javascript">
    $(function(){
        $('#form-competence form').submit(function(){
            $.post('<?php echo current_url() ?>', $('#form-competence form').serialize(), function(data){
                var obj = $.parseJSON(data);
                
                if(obj.error == 1) {
                    $('.notice').html('<div class="alert">' + obj.notice + '</div>');
                } else {
                    $("#popup_education").jqxWindow('close');
                    alert(obj.notice);
                    $("#jqxgrid_education").jqxGrid('updatebounddata', 'cells');
                }
            });

            return false;
        });
    });
</script>
<div id="form-competence" style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
	<div class="notice"></div>
	<?php echo form_open() ?>
	<input type="hidden" value="<?php echo $id_employee ?>" name="id" />
	<input type="hidden" name="id_edu" value="<?php echo !empty($education_emp) ? $education_emp->id_employee_education : '' ?>" />
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr>
        <td colspan="3" style="font-size:20px"><?php echo $title ?></td>
    </tr>
    <tr id="td_proses" height="30">
        <td colspan="3" align="right">
			<input type="submit" name="submit" value="Save" class='btn' id='btn_save' />
		</td>
    </tr>
    <tr>
        <td width='18%'>Degre</td>
        <td width='1%'>:</td>
        <td class="white">
        	<?php $degree = array('SD', 'SMP',' SMA', 'S1', 'S2', 'S3') ?>
			<select size="1" class="input" name="degree" id="Degre" style="width: 300px;margin: 0;">
				<option value="">-</option>
				<?php for($i=0;$i<sizeof($degree);$i++) : ?>
					<?php $select = !empty($education_emp) && $education_emp->education_degree == $degree[$i] ? 'selected' : '' ?>
					<option value="<?php echo $degree[$i] ?>" <?php echo $select ?>><?php echo $degree[$i] ?></option>
				<?php endfor; ?>
			</select>
		</td>
    </tr>
    <tr>
        <td width='18%'>Institute</td>
        <td width='1%'>:</td>
        <td class="white"><input value="<?php echo !empty($education_emp) ? $education_emp->institute : '' ?>" type="text" size="40" name="institute" id="Institute" placeholder="Institute" style="margin: 0;height: 30px;width:200px"/></td>
    </tr>
    <tr>
        <td width='18%'>Major</td>
        <td width='1%'>:</td>
        <td class="white">
			<input type="text" size="1" class="input" value="<?php echo !empty($education_emp) ? $education_emp->major : '' ?>" name="major" id="Category" placeholder="Major" style="width: 300px;margin: 0;">
		</td>
    </tr>
    <tr>
        <td width='18%'>Start Year</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="start_year" id="Start" style="width: 100px;margin: 0;">
				<option value="">-</option>
				<?php for($i=date('Y');$i>=date('Y')-20;$i--) : ?>
					<?php $select = !empty($education_emp) && $education_emp->start_year == $i ? 'selected' : '' ?>
					<option value="<?php echo $i ?>" <?php echo $select ?>><?php echo $i ?></option>
				<?php endfor; ?>
			</select>
		</td>
    </tr>
    <tr>
        <td width='18%'>End Year</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="end_year" id="Start" style="width: 100px;margin: 0;">
				<option value="">-</option>
				<?php for($i=date('Y');$i>=date('Y')-20;$i--) : ?>
					<?php $select = !empty($education_emp) && $education_emp->end_year == $i ? 'selected' : '' ?>
					<option value="<?php echo $i ?>" <?php echo $select ?>><?php echo $i ?></option>
				<?php endfor; ?>
			</select>
		</td>
    </tr>
    </table>
	</form>
</div>
