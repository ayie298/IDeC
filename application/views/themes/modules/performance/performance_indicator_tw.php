<?php $url = !empty($target) ? 'performance/indicator/edit_target' : 'performance/indicator/target'; ?>
<?php echo form_open($url) ?>
<input type="hidden" name="quartal" value="<?php echo $quartal ?>" />
<input type="hidden" name="id" value="<?php echo $id ?>" />
<input type="hidden" name="id_target" value="<?php echo $id_target ?>" />
<input type="hidden" name="id_item_target" value="<?php echo !empty($target) ? $target->id_target_item : 0 ?>" />

<table cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);">
	<tr>
		<td>Metric</td>
		<td>Value</td>
		<td>Target Detail</td>
	</tr>
	<tr>
		<td>
			<?php $metrics = array(); ?>
			<?php foreach($metric as $met) { $metrics[$met->id_mas_metric] = $met->metric_type; } ?>
			<?php echo form_dropdown('metric', $metrics, !empty($target) ? $target->id_mas_metric : ''); ?>
		</td>
		<td><input type="text" value="<?php echo !empty($target) ? $target->target : '' ?>" size="20" name="value" id="Number" placeholder="Name" style="margin: 0;height: 30px;width:150px"/></td>
		<td><input type="text" value="<?php echo !empty($target) ? $target->target_detail : '' ?>" size="20" name="detail" id="Number" placeholder="Detail" style="margin: 0;height: 30px;width:300px"/></td>
	</tr>
</table>
<br>
<input class='btn' id='btn_save' type='submit' name="save" value="Save" />
</form>