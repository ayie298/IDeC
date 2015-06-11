<table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);">
	<tr>
		<td width='20%'>Metric</td>
		<td width='20%'>Value</td>
		<td width='40%'>Target Detail</td>
	</tr>
	<?php foreach($target as $target) : ?>
	<tr>
		<td><?php echo $target->metric_type ?></td>
		<td><?php echo $target->target ?></td>
		<td><?php echo $target->target_detail ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<br>
