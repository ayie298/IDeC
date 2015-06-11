<script type="text/javascript">
    $(document).ready(function(){
		$("#btn_add_activity,#btn_reset_activity").jqxButton({ height: 28, theme: theme });
        $("#tanggal,#tanggal_end").jqxDateTimeInput({ width: '140px', height: '30px', formatString: 'yyyy-MM-dd', theme: theme});
	});
</script>
<div style="padding:5px;text-align:center">
<?php echo form_open() ?>
	<input type="submit" name="btn_simpan" id="btn_add_activity" value=" Simpan " />
	<button type="reset" id="btn_reset_activity"> Ulang </button>
	<br />
	<br />
	<input type="hidden" name="id" value="<?php echo $id_project ?>" />
	<input type="hidden" name="id_act" value="<?php echo !empty($activity) ? $activity->id_employee_activity_log : '' ?>" />
	<table border="0" cellpadding="0" cellspacing="4" align="center" style="font-size:12px">
		<tr>
			<td>

				<table border="0" cellpadding="2" cellspacing="2">
					<tr>
						<td>Project</td>
						<td>:</td>
						<td><?php echo $project->name ?></td>
					</tr>
					<tr>
						<td>Step</td>
						<td>:</td>
						<td>
						<select size="1" class="input" name="step" id="Category" style="width:200px;margin: 0;">
							<?php foreach($project_step as $step) : ?>
								<option value="<?php echo $step->id_project_step ?>" <?php echo !empty($activity) && $step->id_project_step == $activity->id_project_step ? 'selected' : '' ?>><?php echo $step->step_name ?></option>
							<?php endforeach; ?>
						</select>
						</td>
					</tr>
					<tr>
						<td>Activity Name</td>
						<td>:</td>
						<td><input type="text" name="name" placeholder="Name" value="<?php echo !empty($activity) ? $activity->activity_name : '' ?>" style="height:30px;padding:2px;"/></td>
					</tr>
					<tr>
						<td>Activity Description</td>
						<td>:</td>
						<td><input type="text" name="desc" placeholder="Description" value="<?php echo !empty($activity) ? $activity->activity_detail : '' ?>" style="height:30px;padding:2px;width:300px"/></td>
					</tr>
					<tr>
						<td>Location</td>
						<td>:</td>
						<td><input type="text" name="location" placeholder="Location" value="<?php echo !empty($activity) ? $activity->location : '' ?>" style="height:30px;padding:2px;width:300px"/></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td>
						<select size="1" class="input" name="status" id="Category" style="width: 150px;margin: 0;">
							<?php foreach($status as $stat) : ?>
								<option value="<?php echo $stat->id_mas_project_status ?>" <?php echo !empty($activity) && $stat->id_mas_project_status == $activity->id_mas_project_status ? 'selected' : '' ?>><?php echo $stat->status ?></option>
							<?php endforeach; ?>
						</select>
						</td>
					</tr>
					<tr>
						<td>Start</td>
						<td>:</td>
						<td><div id="tanggal" name="start_date" value="<?php echo !empty($activity) ? $activity->start_date : '' ?>" /></td>
					</tr>
					<tr>
						<td>End</td>
						<td>:</td>
						<td><div id="tanggal_end" name="end_date" value="<?php echo !empty($activity) ? $activity->end_date : '' ?>" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
</div>