<script type="text/javascript">
    $(document).ready(function(){
		$("#btn_add_step,#btn_reset_step").jqxInput({ theme: 'fresh', height: '30px', width: '120px' }); 
        $("#tanggal,#tanggal_end").jqxDateTimeInput({ width: '140px', height: '30px', formatString: 'yyyy-MM-dd', theme: theme});
	});
</script>
<script type="text/javascript">
    $(function(){
        $('#form-step form').submit(function(){
            $.post('<?php echo current_url() ?>', $('#form-step form').serialize(), function(data){
                var obj = $.parseJSON(data);
                
                if(obj.error == 1) {
                    $('.notice').html('<div class="alert">' + obj.notice + '</div>');
                } else {
                    $("#popup").jqxWindow('close');
                    alert(obj.notice);
                    $("#jqxgrid_step").jqxGrid('updatebounddata', 'cells');
                }
            });

            return false;
        });
    });
</script>
<div id="form-step" style="padding:5px;text-align:center">
<div class="notice"></div>
<?php echo form_open() ?>
	<input id="btn_add_step" type="submit" name="btn_simpan" value="Simpan" />
	<button id="btn_reset_step" type="reset"> Ulang </button>
	<br />
	<br />
	<table border="0" cellpadding="0" cellspacing="8" align="center">
		<tr>
			<td>
				<input type="hidden" name="id" value="<?php echo $id ?>" />
				<table border="0" cellpadding="3" cellspacing="2">
					<tr>
						<td>Name</td>
						<td>:</td>
						<td><input type="text" name="name" value="<?php echo !empty($step->step_name) ? $step->step_name : '' ?>" placeholder="Name" style="height:30px;padding:2px;"/></td>
					</tr>
					<tr>
						<td>Description</td>
						<td>:</td>
						<td><input type="text" name="desc" value="<?php echo !empty($step->step_description) ? $step->step_description : '' ?>" placeholder="Description" style="height:30px;padding:2px;width:300px"/></td>
					</tr>
					<tr>
						<td>Bobot</td>
						<td>:</td>
						<td><input type="text" name="bobot" value="<?php echo !empty($step->weight) ? $step->weight : '' ?>" placeholder="100" style="width:80px;height:30px;padding:2px;"/></td>
					</tr>
					<tr>
						<td>Start</td>
						<td>:</td>
						<td><div id="tanggal" name="tanggal" value="<?php echo !empty($step->start_date) ? $step->start_date : '' ?>"/></td>
					</tr>
					<tr>
						<td>End</td>
						<td>:</td>
						<td><div id="tanggal_end" name="tanggal_end" value="<?php echo !empty($step->end_date) ? $step->end_date : '' ?>" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
</div>