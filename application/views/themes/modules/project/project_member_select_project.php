<script type="text/javascript">
    $(document).ready(function(){
		$("#btn_pilih").jqxInput({ theme: 'fresh', height: '30px', width: '120px' }); 
		$('#btn_pilih').click(function () {
			selected(1);
		});
	});
</script>
<div style="padding:5px;text-align:center">
<?php echo form_open(current_url(),'id="frmData"'); ?>
	<input id="btn_pilih" type="submit" name="btn_pilih" value=" Pilih " />
	<input type="hidden" name="id_project" value="<?php echo $id_project ?>" />
	<input type="hidden" name="id" value="<?php echo $employee->id_employee ?>" />
	<input type="hidden" name="id_emp_proj" value="<?php echo $id_emp_pro ?>" />
	<br />
	<br />
	<table border="0" cellpadding="0" cellspacing="8" align="center">
		<tr>
			<td>
				<table border="0" cellpadding="3" cellspacing="2">
					<tr>
						<td>NIK</td>
						<td>:</td>
						<td><?php echo $employee->nik ?></td>
					</tr>
					<tr>
						<td>Name</td>
						<td>:</td>
						<td><?php echo $employee->name ?></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td class="white">
							<select size="1" class="input" name="position" id="Status" style="width:100px;margin: 0;">
								<?php foreach($position as $pos) : ?>
									<option value="<?php echo $pos->id_mas_employee_project_position ?>" <?php echo $pos->id_mas_employee_project_position == $cur_pos ? 'selected' : '' ?>><?php echo $pos->position ?></option>
								<?php endforeach ?>
							</select>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
</div>