<script type="text/javascript">
    $(document).ready(function(){
    	<?php if(!empty($tw)) : ?>
        $('#jqxTabs').jqxTabs({ width: '60%', height: '215', position: 'top', theme: theme });
        <?php endif ?>
		$('#btn_back').click(function () {
			document.location.href="<?php echo site_url('program');?>";
		});

		$('#btn_target').click(function () {
			document.location.href="#target";
		});

		$("#tanggal,#tanggal_end").jqxDateTimeInput({ width: '140px', height: '30px', formatString: 'yyyy-MM-dd', theme: theme});

		$('#tanggal').on('valueChanged', function (event) 
		{  
    		var jsDate = $('#tanggal').val();

    		$('#tanggal_input').val(jsDate);
		});

		$('#tanggal_end').on('valueChanged', function (event) 
		{  
    		var jsDate = $('#tanggal_end').val();

    		$('#tanggal_input_end').val(jsDate);
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

		<?php if(set_value('unit') != '' && empty($program)) : ?>
		var data = '<?php echo set_value('unit') ?>';
		var lab = '<?php echo set_value('lab') ?>';
			$.ajax({
				url : '<?php echo site_url('program/update/get_lab') ?>',
				type : 'POST',
				data : 'unit=' + data + '&lab='+lab,
				success : function(data) {
					$('#lab').html(data);
				}
			});

			return false;
		<?php endif; ?>


	});
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">Program Data</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Program Data
	   </h3>
   </div>
</div>
<div class="row-fluid">
	<?php //$notice = $this->session->flashdata('notice') ?>
	<?php echo !empty($notice) ? '<div class="alert">'.$notice : '' ?>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);font-size:14px">
    <tr id="td_loading" style="display:none" height="30">
        <td colspan="3" align="right">Processing data ....</td>
    </tr>
<?php echo form_open() ?>
	<input type="hidden" name="id" value="<?php echo !empty($program) ? $program->id_program : '' ?>" />
    <tr>
        <td colspan="3" style="font-size:20px">Program <?php echo $title ?></td>
    </tr>
    <tr id="td_proses" height="30">
        <td colspan="3" align="right">
        	<?php if($title !== 'Add') { ?>
				<button class='btn' id='btn_target' type='button'>SET TARGET</button>
			<?php } ?>
				<input class='btn' id='btn_save' type='submit' name="submit" />
				<button class='btn' id='btn_back' type='button'>KEMBALI</button>
		</td>
    </tr>
    <tr>
        <td width='18%'>Program Name</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="20" name="name" value="<?php echo !empty($program) ? $program->name : set_value('name') ?>" id="Name" placeholder="Name" style="margin: 0;height: 30px;width:400px"/></td>
    </tr>
   <tr>
        <td width='18%'>Unit</td>
        <td width='1%'>:</td>
        <td class="white">
        	<?php $orgs[''] = 'Choose Unit' ?>
			<?php foreach($organization as $org) : ?>
			<?php $orgs[$org->id_organization_item] = $org->org_name ?>
			<?php endforeach; ?>
			
			<?php echo form_dropdown('unit', $orgs, !empty($program) ? $unit : set_value('unit'), ' id="unit" style="width: 300px;margin: 0;"') ?>
		</td>
    </tr>
    <tr>
        <td width='18%'>Bagian / Lab</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="lab" id="lab" style="width: 300px;margin: 0;">
				<option value="">Choose Lab</option>
				<?php foreach($labs as $lab) : ?>
					<option value="<?php echo $lab->id_organization_item ?>" <?php echo $lab->id_organization_item == $program->id_organization_item ? 'selected' : ''; ?>><?php echo $lab->org_name ?></option>
				<?php endforeach ?>
			</select>
		</td>
    </tr>
    <tr style="display:none;">
        <td width='18%'>Research Type</td>
        <td width='1%'>:</td>
        <td class="white">
        	<?php $types[''] = 'Choose Type' ?>
			<?php foreach($resType as $type) : ?>
			<?php $types[$type->id_mas_research_type] = $type->type ?>
			<?php endforeach; ?>
			<?php echo form_dropdown('type', $types, !empty($program) ? $program->id_mas_research_type : set_value('type'), ' id="type" style="width: 300px;margin: 0;"') ?>
		</td>
    </tr>
	<tr>
		<td width='18%'>Description</td>
		<td width='1%'>:</td>
		<td class="white"><input type="text" size="20" name="desc" value="<?php echo !empty($program) ? $program->program_description : set_value('desc') ?>" id="Description" placeholder="Description" style="margin: 0;height: 30px;width:500px"/></td>
	</tr>
	<tr>
        <td width='18%'>Anggaran</td>
        <td width='1%'>:</td>
        <td class="white">Rp <input type="text" size="20" name="budget" value="<?php echo !empty($program) ? $program->budget : set_value('budget') ?>" id="Name" placeholder="000.000.000" style="margin: 0;height: 30px;width:400px"/></td>
    </tr>
	<tr>
		<td width='18%'>User</td>
		<td width='1%'>:</td>
		<td class="white"><input type="text" size="20" name="user" value="<?php echo !empty($program) ? $program->user : set_value('user') ?>" id="User" placeholder="User" style="margin: 0;height: 30px;"/></td>
	</tr>
	<tr>
		<td width='18%'>Start Date</td>
		<td width='1%'>:</td>
        <td class="white"><input type="hidden" id="tanggal_input" name="tanggal" value="<?php echo !empty($program) ? $program->start_date : set_value('tanggal') ?>" /><div id='tanggal' value="<?php echo !empty($program) ? $program->start_date : set_value('tanggal') ?>"></div></td>
	</tr>
	<tr>
		<td width='18%'>End Date</td>
		<td width='1%'>:</td>
        <td class="white"><input type="hidden" id="tanggal_input_end" name="tanggal_end" value="<?php echo !empty($program) ? $program->end_date : set_value('tanggal_end') ?>" /><div id='tanggal_end' name="tanggal_end" value="<?php echo !empty($program) ? $program->end_date : set_value('tanggal_end') ?>"></div></td>
	</tr>
	<tr>
		<td width='18%'>Output</td>
		<td width='1%'>:</td>
		<td class="white"><input type="text" size="20" name="output" value="<?php echo !empty($program) ? $program->output : set_value('output') ?>" id="Output" placeholder="User" style="margin: 0;height: 30px;"/></td>
	</tr>
   <tr>
        <td width='18%'>Quartal</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="quartal" id="Year" style="width: 100px;margin: 0;">
				<option value="TW I" <?php echo !empty($program) && $program->quartal == 'TW I' ? 'selected' : '' ?>>TW I</option>
				<option value="TW II" <?php echo !empty($program) && $program->quartal == 'TW II' ? 'selected' : '' ?>>TW II</option>
				<option value="TW III" <?php echo !empty($program) && $program->quartal == 'TW III' ? 'selected' : '' ?>>TW III</option>
				<option value="TW IV" <?php echo !empty($program) && $program->quartal == 'TW IV' ? 'selected' : '' ?>>TW IV</option>
			</select>
		</td>
    </tr>
   <tr>
        <td width='18%'>PM</td>
        <td width='1%'>:</td>
		<td class="white"><input type="text" size="20" name="pm" value="<?php echo !empty($program) ? $pm : set_value('pm') ?>" id="User" placeholder="NIK autocomplete" style="margin: 0;height: 30px;"/></td>
    </tr>
   <tr>
        <td width='18%'>PO</td>
        <td width='1%'>:</td>
		<td class="white"><input type="text" size="20" name="po" id="User" value="<?php echo !empty($program) ? $po : set_value('po') ?>" placeholder="NIK autocomplete" style="margin: 0;height: 30px;"/></td>
    </tr>
   <tr>
        <td width='18%'>Primary Program ?</td>
        <td width='1%'>:</td>
        <td class="white"><input type="checkbox" name="prime" value="1" <?php echo !empty($program) && $program->primary_program == 1 ? 'checked' : set_value('prime') ?> class="input"></td>
    </tr>
 	<tr>
		<td width='18%'>Deliverable</td>
		<td width='1%'>:</td>
		<td class="white"><textarea cols="60" name="deliver" rows="4" style="width: 400px;margin: 0;"><?php echo !empty($program) ? $program->deliverable : set_value('deliver') ?></textarea></td>
	</tr>
 	<tr>
		<td width='18%'>KPI</td>
		<td width='1%'>:</td>
		<td class="white"><textarea cols="60" name="kpi" rows="4" style="width: 400px;margin: 0;"><?php echo !empty($program) ? $program->KPI : set_value('kpi') ?></textarea></td>
	</tr>
 	<tr>
		<td width='18%'>Implementation Strategy</td>
		<td width='1%'>:</td>
		<td class="white"><textarea cols="60" name="implement" rows="4" style="width: 400px;margin: 0;"><?php echo !empty($program) ? $program->implementation_strategy : set_value('implement') ?></textarea></td>
	</tr>
 	<tr>
		<td width='18%'>Strategic Initiative</td>
		<td width='1%'>:</td>
		<td class="white"><textarea cols="60" name="strategic" rows="4" style="width: 400px;margin: 0;"><?php echo !empty($program) ? $program->strategic_initative : set_value('strategic') ?></textarea></td>
	</tr>
    <tr>
        <td width='18%'>Status</td>
        <td width='1%'>:</td>
        <td class="white">
        	<?php $statuses[''] = 'Choose Status' ?>
			<?php foreach($status as $stat) : ?>
			<?php $statuses[$stat->id_mas_project_status] = $stat->status ?>
			<?php endforeach; ?>
			<?php echo form_dropdown('status', $statuses, !empty($program) ? $program->id_mas_project_status : set_value('status'), ' id="type" style="width: 300px;margin: 0;"') ?>
		</td>
    </tr>
</form>
<?php if(!empty($tw)) : ?>
   <tr>
        <td colspan="3">
		<div style="padding-top:10px;padding-bottom:10px;"><a name="target">Program Target</a></div>

			<div id="jqxTabs">
				<ul>
					<li>TW I</li>
					<li>TW II</li>
					<li>TW III</li>
					<li>TW IV</li>
				</ul>
				<?php for($i=0;$i<sizeof($tw);$i++) : ?>
					<div style="padding: 10px;">
						<?php echo $tw[$i] ?>
					</div>
				<?php endfor ?>
			</div>		
		</td>
    </tr>
<?php endif; ?>
    </table>
</div>
