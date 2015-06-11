<script type="text/javascript">
    $(document).ready(function(){
		$("#btn_simpan,#btn_ulang").jqxInput({ theme: 'fresh', height: '30px', width: '100px' }); 
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
                    $("#popupexp2").jqxWindow('close');
                    alert(obj.notice);
                    $("#jqxgrid_experience").jqxGrid('updatebounddata', 'filter');
                }
            });

            return false;
        });
    });
</script>
<div id="form-competence" style="padding:5px;text-align:center">
<div class="notice"></div>
<?php echo form_open() ?>
<input type="hidden" name="id_emp" value="<?php echo $id_emp ?>" />
		<input type="hidden" name="id_work" value="<?php echo $id_work ?>" />
	<input type="submit" id="btn_simpan" name="btn_simpan" value=" Simpan " />
	<button type="reset" id="btn_ulang"> Ulang </button>
	<br />
	<br />
	<table border="0" cellpadding="0" cellspacing="8" align="center">
		<tr>
			<td>
				<table border="0" cellpadding="3" cellspacing="2">
					<tr>
						<td>Researcher</td>
						<td>:</td>
						<td><?php echo $employee->nik ?> - <?php echo $employee->name ?></td>
					</tr>
					<tr>
						<td>Description</td>
						<td>:</td>
						<td><input type="text" value="<?php echo !empty($bko) ? $bko->job_desk : '' ?>" name="desc" placeholder="Description" style="height:30px;padding:2px;"/></td>
					</tr>
					<tr>
						<td>Type</td>
						<td>:</td>
						<td>
						<select size="1" class="input" name="type" id="Category" style="width: 300px;margin: 0;">
							<option value="">Choose Type</option>
							<option value="work" <?php echo !empty($bko) && $bko->work_type == 'work' ? 'selected' : '' ?>>Work</option>
							<option value="research" <?php echo !empty($bko) && $bko->work_type == 'research' ? 'selected' : '' ?>>Research</option>
						</select>
						</td>
					</tr>
					<tr>
						<td>Category</td>
						<td>:</td>
						<td>
						<select size="1" class="input" name="category" id="Category" style="width: 300px;margin: 0;">
							<option value="">Choose Category</option>
							<?php foreach($times as $pos) : ?>
								<option value="<?php echo $pos->id_mas_times_category ?>" <?php echo !empty($bko) && $bko->id_mas_times_category == $pos->id_mas_times_category ? 'selected' : '' ?>><?php echo $pos->category ?></option>
							<?php endforeach ?>
						</select>
						</td>
					</tr>
					<tr>
						<td>Year</td>
						<td>:</td>
						<td>
							<input type="text" value="<?php echo !empty($bko) ? $bko->start_year : '' ?>" name="start_year" placeholder="Start" style="height:30px;padding:2px;width:60px"/> - 
							<input type="text" value="<?php echo !empty($bko) ? $bko->end_year : '' ?>" name="end_year" placeholder="End" style="height:30px;padding:2px;width:60px"/></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
</div>