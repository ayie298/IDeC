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
                    $("#popupexp").jqxWindow('close');
                    alert(obj.notice);
                    $("#jqxgrid_bko").jqxGrid('updatebounddata', 'filter');
                }
            });

            return false;
        });

        $('#unit').change(function(){
			var data = $(this).val();
			$.ajax({
				url : '<?php echo site_url('program/update/get_lab') ?>',
				type : 'POST',
				data : 'unit=' + data,
				success : function(data) {
					$('#lab').html(data);
				}
			});

			return false;
		});
    });
</script>
<div id="form-competence" style="padding:5px;text-align:center">
<div class="notice"></div>
<?php echo form_open() ?>
	<input type="submit" id="btn_simpan" name="btn_simpan" value=" Simpan " />
	<button type="reset" id="btn_ulang"> Ulang </button>
	<br />
	<br />
	<table border="0" cellpadding="0" cellspacing="8" align="center">
		<input type="hidden" name="id_emp" value="<?php echo $id_emp ?>" />
		<input type="hidden" name="id_bko" value="<?php echo $id_bko ?>" />
		<tr>
			<td>
				<table border="0" cellpadding="3" cellspacing="2">
					<tr>
						<td>Researcher</td>
						<td>:</td>
						<td><?php echo $employee->nik ?> - <?php echo $employee->name ?></td>
					</tr>
					<tr>
						<td width='25%'>Bidang</td>
						<td width='1%'>:</td>
						<td class="white">
						<select size="1" class="input" name="unit" id="unit" style="width: 300px;margin: 0;">
							<option value="">Choose Unit</option>
							<?php foreach($organization as $org) : ?>
								<option value="<?php echo $org->id_organization_item ?>" <?php echo !empty($bko) && $unit == $org->id_organization_item ? 'selected' : '' ?>><?php echo $org->org_name ?></option>
							<?php endforeach ?>
						</select>
						</td>
					</tr>
					<tr>
						<td width='25%'>Bagian / Lab</td>
						<td width='1%'>:</td>
						<td class="white">
						<select size="1" class="input" name="lab" id="lab" style="width: 300px;margin: 0;">
							<option value="">Choose Lab</option>
							<?php foreach($labs as $lab) : ?>
								<option value="<?php echo $lab->id_organization_item ?>" <?php echo !empty($bko) && $lab->id_organization_item == $bko->id_organization_item ? 'selected' : ''; ?>><?php echo $lab->org_name ?></option>
							<?php endforeach ?>
						</select>
						</td>
					</tr>
					<tr>
						<td width='25%'>Position</td>
						<td width='1%'>:</td>
						<td class="white">
						<select size="1" class="input" name="position" id="Category" style="width: 300px;margin: 0;">
							<option value="">Choose Position</option>
							<?php foreach($position as $pos) : ?>
								<option value="<?php echo $pos->id_mas_employee_position ?>" <?php echo !empty($bko) && $bko->id_mas_employee_position == $pos->id_mas_employee_position ? 'selected' : '' ?>><?php echo $pos->position ?></option>
							<?php endforeach ?>
						</select>
						</td>
					</tr>
					<tr>
						<td width='25%'>Title</td>
						<td width='1%'>:</td>
						<td class="white">
						<select size="1" class="input" name="title" id="Category" style="width: 300px;margin: 0;">
							<option value="">Choose Title</option>
							<?php foreach($title as $title) : ?>
								<option value="<?php echo $title->id_mas_title ?>" <?php echo !empty($bko) && $bko->id_mas_title == $title->id_mas_title ? 'selected' : '' ?>><?php echo $title->title ?></option>
							<?php endforeach ?>
						</select>
						</td>
					</tr>
					<tr>
						<td>Year</td>
						<td>:</td>
						<td><input type="text" value="<?php echo !empty($bko) ? $bko->year : '' ?>" name="year" placeholder="Year" style="height:30px;padding:2px;width:60px"/> </td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
</div>