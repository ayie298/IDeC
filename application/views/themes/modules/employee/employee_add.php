<script type="text/javascript">
    $(document).ready(function(){
        $("#bar_general").click();

	    $("#btn_edit,#btn_back").jqxButton({ height: 28, theme: theme });
        $("#tanggal").jqxDateTimeInput({ width: '140px', height: '30px', formatString: 'yyyy-MM-dd', theme: theme});
		$('#btn_back').click(function () {
			document.location.href="<?php echo site_url('idec/employee');?>";
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

		<?php if(set_value('unit') != '') : ?>
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
	<?php //$notice = $this->session->flashdata('notice') ?>
	<?php echo !empty($notice) ? '<div class="alert">'.$notice : '' ?>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr id="td_loading" style="display:none" height="30">
        <td colspan="3" align="right">Processing data ....</td>
    </tr>
    <tr>
        <td colspan="3" style="font-size:20px">Employee Add</td>
    </tr>
    <?php echo form_open_multipart() ?>
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
									<img class="blah" src="<?php echo base_url()?>media/images/profile.jpeg" width="100" height="100">
								</td>
							</tr>
							<tr>
								<td width='25%'>NIK</td>
								<td width='1%'>:</td>
								<td class="white"><input type="text" value="<?php echo set_value('nik') ?>" name="nik" placeholder="NIK" style="height:30px;"/></td>
							</tr>
							<tr>
								<td width='25%'>Name</td>
								<td width='1%'>:</td>
								<td class="white"><input type="text" value="<?php echo set_value('name') ?>" name="name" placeholder="Nama" style="height:30px;"/></td>
							</tr>
							<tr>
								<td width='25%'>Date Of Birth</td>
								<td width='1%'>:</td>
								<td class="white"><div id='tanggal' value="<?php echo set_value('date') ?>"></div><input type="hidden" id="tanggal_input" name="date" value="<?php echo set_value('date') ?>" /></td>
							</tr>
							<tr>
								<td width='25%'>Gender</td>
								<td width='1%'>:</td>
								<td class="white">
								<select size="1" class="input" name="gender" id="Gender" style="width: 100px;margin: 0;">
									<option value="male">L</option>
									<option value="female">P</option>
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
									<?php $orgs[''] = 'Choose Unit' ?>
									<?php foreach($organization as $org) : ?>
									<?php $orgs[$org->id_organization_item] = $org->org_name ?>
									<?php endforeach; ?>
								<?php echo form_dropdown('unit', $orgs, set_value('unit'), ' id="unit" style="width: 300px;margin: 0;"') ?>
								</td>
							</tr>
							<tr>
								<td width='25%'>Bagian / Lab</td>
								<td width='1%'>:</td>
								<td class="white">
								<select size="1" class="input" name="lab" id="lab" style="width: 300px;margin: 0;">
									<option value="">Choose Lab</option>
								</select>
								</td>
							</tr>
							<tr>
								<td width='25%'>Position</td>
								<td width='1%'>:</td>
								<td class="white">
									<?php $post[''] = 'Choose Position' ?>
									<?php foreach($position as $pos) : ?>
										<?php $post[$pos->id_mas_employee_position] = $pos->position ?>
									<?php endforeach; ?>
									<?php echo form_dropdown('position', $post, set_value('position'), 'style="width: 300px;margin: 0;"'); ?>
								</td>
							</tr>
							<tr>
								<td width='25%'>Title</td>
								<td width='1%'>:</td>
								<td class="white">
									<?php $titles[''] = 'Choose Title' ?>
									<?php foreach($title as $tit) : ?>
									<?php $titles[$tit->id_mas_title] = $tit->title ?>
								<?php endforeach ?>
									<?php echo form_dropdown('title', $titles, set_value('title'), 'style="width: 300px;margin: 0;"'); ?>
								</td>
							</tr>
							<tr style="display:none">
								<td width='25%'>LAMP</td>
								<td width='1%'>:</td>
								<td class="white"><input type="text" name="LAMP" placeholder="A" style="width:50px;height:30px;"/></td>
							</tr>
							<tr>
								<td width='25%'>BP</td>
								<td width='1%'>:</td>
								<td class="white">
									<?php $bpss[''] = 'Choose BP' ?>
									<?php foreach($bps as $bp) : ?>
									<?php $bpss[$bp->id_mas_bp] = $bp->bp ?>
									<?php endforeach; ?>
									<?php echo form_dropdown('bp', $bpss, set_value('bp'), 'style="width: 300px;margin: 0;"'); ?>
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
								<td class="white"><input type="file" name="userfile">(hanya PDF)</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<?php echo form_close() ?>
		</td>
	</tr>
    </table>
</div>
