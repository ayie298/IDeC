<script type="text/javascript">
    $(document).ready(function(){
        $("#bar_general").click();

        $('#jqxTabs').jqxTabs({ width: '1000', height: '350', position: 'top', theme: theme });
	    $("#btn_edit,#btn_back").jqxButton({ height: 28, theme: theme });
        $("#tanggal").jqxDateTimeInput({ width: '140px', height: '30px', formatString: 'yyyy-MM-dd', theme: theme});
		$('#btn_back').click(function () {
			document.location.href="<?php echo site_url('idec/employee');?>";
		});

		$("#btn_add1,#btn_add2,#btn_add3,#btn_add4").jqxInput({ theme: 'fresh', height: '30px', width: '100px' }); 

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

		$('#tanggal').on('valueChanged', function (event) 
		{  
    		var jsDate = $('#tanggal').val();

    		$('#tanggal_input').val(jsDate);
		});
		$("#img").change(function(){
			var r = ["jpg", "jpeg", "JPG", "JPEG"];
			var e = $(this).val();
    		var i = e.split("\\").pop();
    		var s = i.split(".").pop();
    		var o = $.inArray(s, r);
    		if (o >= 0) {
        		readURL(this);
    		} else {
        		alert("Only JPG or JPEG");
        		e.value = ""
    		}
    		
		});

		<?php if(set_value('unit') != '' && empty($employee)) : ?>
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

	function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">Employee</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Employee Data
	   </h3>
   </div>
</div>
<div class="row-fluid">
	<?php echo !empty($notice) ? '<div class="alert">'.$notice : '' ?>
	<?php echo $this->session->flashdata('notice') != "" ? '<div class="alert">'.$this->session->flashdata('notice') : '' ?>
	<?php //$notice = $this->session->flashdata('notice') ?>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr id="td_loading" style="display:none" height="30">
        <td colspan="3" align="right">Processing data ....</td>
    </tr>
    <tr>
        <td colspan="3" style="font-size:20px">Employee Edit</td>
    </tr>
    <?php echo form_open_multipart('idec/employee/update/' . md5($employee->id_employee)) ?>
    <tr id="td_proses" height="30">
        <td colspan="3" align="right">
			<input type="submit" name="save" value="SAVE DATA" />
			<button id='btn_back' type='button'>KEMBALI</button>
		</td>
    </tr>
	<tr>
		<td colspan="3">
			<table width="100%">
				<tr valign="top">
					<td width="50%">
						<table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid #CCC;background: #EFEFEF;font-size:14px">
							<tr>
								<td width='25%'>Photo</td>
								<td width='1%'>:</td>
								<td class="white">
									<input type="file" id="img" name="userphoto" style="position: absolute;width: 100px;height: 100px;border: 1px solid;opacity: 0;" />
									<span class="preview-photo">
										<img class="blah" src="<?php echo base_url()?><?php echo empty($employee->photo) ? 'media/images/profile.jpeg' : 'uploads/default/photo/' . $employee->photo ?>" width="100" height="100">
									</span>
								</td>
							</tr>
							<tr>
								<td width='25%'>NIK</td>
								<td width='1%'>:</td>
								<td class="white"><input type="text" name="nik" placeholder="NIK" value="<?php echo $employee->nik ?>" style="height:30px;"/></td>
							</tr>
							<tr>
								<td width='25%'>Name</td>
								<td width='1%'>:</td>
								<td class="white"><input type="text" name="name" placeholder="Nama" value="<?php echo $employee->name ?>" style="height:30px;"/></td>
							</tr>
							<tr>
								<td width='25%'>Date Of Birth</td>
								<td width='1%'>:</td>
								<td class="white"><div id='tanggal' value="<?php echo $employee->date_of_birth ?>"></div><input type="hidden" id="tanggal_input" name="date" value="<?php echo $employee->date_of_birth ?>" /></td>
							</tr>
							<tr>
								<td width='25%'>Gender</td>
								<td width='1%'>:</td>
								<td class="white">
								<select size="1" class="input" name="gender" id="Gender" style="width: 100px;margin: 0;">
									<option value="male" <?php echo $employee->gender == "male" ? 'selected' : '' ?>>L</option>
									<option value="female" <?php echo $employee->gender == "female" ? 'selected' : '' ?>>P</option>
								</select>
								</td>
							</tr>
						</table>
					</td>
					<td width="50%">
						<table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid #CCC;background: #EFEFEF;font-size:14px">
							<tr>
								<td width='25%'>Bidang</td>
								<td width='1%'>:</td>
								<td class="white">
								<select size="1" class="input" name="unit" id="unit" style="width: 300px;margin: 0;">
									<option value="">Choose Unit</option>
									<?php foreach($organization as $org) : ?>
										<option value="<?php echo $org->id_organization_item ?>" <?php echo !empty($employee) && $unit == $org->id_organization_item ? 'selected' : '' ?>><?php echo $org->org_name ?></option>
									<?php endforeach; ?>
								</select>
								</td>
							</tr>
							<tr>
								<td width='25%'>Bagian / Lab</td>
								<td width='1%'>:</td>
								<td class="white">
								<select size="1" class="input" name="lab" id="lab" style="width: 300px;margin: 0;">
									<?php foreach($labs as $lab) : ?>
										<option value="<?php echo $lab->id_organization_item ?>" <?php echo $lab->id_organization_item == $employee->id_organization_item ? 'selected' : ''; ?>><?php echo $lab->org_name ?></option>
									<?php endforeach ?>
								</select>
								</td>
							</tr>
							<tr>
								<td width='25%'>Position</td>
								<td width='1%'>:</td>
								<td class="white">
								<select size="1" class="input" name="position" id="Category" style="width: 300px;margin: 0;">
									<option>Choose Position</option>
									<?php foreach($position as $pos) : ?>
										<option value="<?php echo $pos->id_mas_employee_position ?>" <?php echo $employee->id_mas_employee_position == $pos->id_mas_employee_position ? 'selected' : '' ?>><?php echo $pos->position ?></option>
									<?php endforeach; ?>
								</select>
								</td>
							</tr>
							<tr>
								<td width='25%'>Title</td>
								<td width='1%'>:</td>
								<td class="white">
									<select size="1" class="input" name="title" id="Category" style="width: 300px;margin: 0;">
									<option>Choose Title</option>
									<?php foreach($title as $title) : ?>
										<option value="<?php echo $title->id_mas_title ?>" <?php echo $employee->id_mas_title == $title->id_mas_title ? 'selected' : '' ?>><?php echo $title->title ?></option>
									<?php endforeach; ?>
								</select>
								</td>
							</tr>
							<tr style="display:none;">
								<td width='25%'>LAMP</td>
								<td width='1%'>:</td>
								<td class="white"><input type="text" name="LAMP" placeholder="A" style="width:50px;height:30px;"/></td>
							</tr>
							<tr>
								<td width='25%'>BP</td>
								<td width='1%'>:</td>
								<td class="white">
									<select size="1" class="input" name="bp" id="Category" style="width: 300px;margin: 0;">
									<option>Choose BP</option>
									<?php foreach($bps as $bp) : ?>
										<option value="<?php echo $bp->id_mas_bp ?>" <?php echo $employee->id_mas_bp == $bp->id_mas_bp ? 'selected' : '' ?>><?php echo $bp->bp ?></option>
									<?php endforeach; ?>
								</select>
								</td>
							</tr>
							<tr style="display:none">
								<td width='25%'>LOKER</td>
								<td width='1%'>:</td>
								<td class="white">
								<select size="1" class="input" name="LOKER" id="LOKER" style="width: 250px;margin: 0;">
									<option>Choose Loker</option>
									<option>UNIT RESEARCHER GROUP</option>
								</select>
								</td>
							</tr>
							<tr>
								<td width='25%'>Curiculum Vitae</td>
								<td width='1%'>:</td>
								<td class="white"><input type="file" name="userfile">(hanya PDF) <?php echo !empty($employee->cv_document) ? anchor('uploads/default/cv/' . $employee->cv_document, 'download') : '' ?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<?php echo form_close() ?>
		</td>
	</tr>
    <tr>
        <td colspan="3">
			<div id="jqxTabs">
				<ul>
					<li>Competence</li>
					<li>Certificate</li>
					<li>Training</li>
					<li>Education</li>
				</ul>
				<div style="padding: 10px;">
				<?php echo $competence ?>
				</div>
				<div style="padding: 10px;">
				<?php echo $certificate ?>
				</div>
				<div style="padding: 10px;">
				<?php echo $training ?>
				</div>
				<div style="padding: 10px;">
				<?php echo $education ?>
				</div>
			</div>		
		</td>
    </tr>
    </table>
</div>
