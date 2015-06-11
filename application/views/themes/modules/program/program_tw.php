<?php echo form_open('program/update/target') ?>
<input type="hidden" name="quartal" value="<?php echo $quartal ?>" />
<input type="hidden" name="id_program" value="<?php echo $program->id_program ?>" />
<table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);">
	<tr>
		<td width='20%'>Metric</td>
		<td width='20%'>Value</td>
		<td width='40%'>Target Detail</td>
	</tr>
	<tr>
		<td>
			<select size="1" class="input" name="metric" id="Quantity" style="width:100px;margin: 0;">
				<option value="1">Quantity</option>
				<option value="2">Date</option>
			</select>
		</td>
		<td><input type="text" size="20" name="value" id="Number" placeholder="Name" style="margin: 0;height: 30px;width:150px"/></td>
		<td><input type="text" size="20" name="detail" id="Number" placeholder="Detail" style="margin: 0;height: 30px;width:400px"/></td>
	</tr>
</table>
<br>
<input class='btn' id='btn_save' type='submit' name="ADD" />
</form>