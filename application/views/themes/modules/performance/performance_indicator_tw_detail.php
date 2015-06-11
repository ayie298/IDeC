<table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);font-size:14px;">
	<tr>
		<td width='5%'>Edit</td>
		<td width='5%'>Delete</td>
		<td width='20%'>Metric</td>
		<td width='20%'>Value</td>
		<td width='40%'>Target Detail</td>
	</tr>
	<?php foreach($targets as $target) : ?>
	<tr>
		<td>
			<a href='javascript:void(0);'>
				<img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit_target(<?php echo $target->id_target_item ?>);'> 
			</a>
		</td>
		<td>
			<a href='<?php echo site_url('performance/indicator/delete_target/' . md5($target->id_target_item) . '/' . $indicator->id_performance_system_item) ?>' onclick="return confirm('Delete target ?')">
				<img border=0 src='<?php echo base_url(); ?>public/images/del.gif'>
			</a>
		</td>
		<td>
			<?php echo !empty($target) ? $target->metric_type : ''; ?>
		</td>
		<td><?php echo !empty($target) ? $target->target : ''; ?></td>
		<td><?php echo !empty($target) ? $target->target_detail : ''; ?></td>
	</tr>
	<?php endforeach ?>
</table>
<br>
<button type="button" style="margin-bottom:40px;" value="<?php echo $quartal ?>" target="<?php echo $id_target ?>" class="add_target"> ADD NEW </button>