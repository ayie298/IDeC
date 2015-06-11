<script>
	$(function(){
       $("#bar_rms").click();
	   $("#submitbutton,#clearfilteringbutton, #refreshdatabutton,#btn_report,#btn_import,#btn_print,#btn_excel").jqxButton({ height: 28, theme: theme });
	   $("input[type='text']").jqxInput({ height: 28, theme: theme });

 		$('#submitbutton').click(function () {
			document.location.href="<?php echo base_url();?>idec_rms/researcher_search";
		});

		$('#btn_import').click(function () {
			$.get("<?php echo base_url();?>idec_rms/project_import/", function(response) {
				$("#popupimport_content").html(response);
			});
			$("#popupimport").jqxWindow({
				theme: theme, resizable: false,
				width: 600,
				height: 350,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popupimport").jqxWindow('open');
		});

		$('#btn_report').click(function () {
			var offset = $("#jqxgrid").offset();
			$("#popup").jqxWindow({
				theme: theme, resizable: false,
				width: 600,
				height: 350,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popup").jqxWindow('open');
		});
        
	});

</script>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Researcher Data
	   </h3>
   </div>
</div>
<div id="popupimport" style="display:none">
	<div id="popupimport_title">Import Excel Data</div><div id="popupimport_content">{popup}</div>
</div>
<div id="popup" style="display:none">
	<div id="popup_title">Generate Report</div>
	<div id="popup_content">
		<div style="padding:4px;height:30px;margin-top:10px">
			Researcher Unit : <select size="1" class="input" name="unit" id="Category" style="width: 300px;margin: 0;">
				<option>Choose Unit</option>
				<?php foreach($organization as $org) : ?>
					<option value="<?php echo $org->id_organization_item ?>"><?php echo $org->org_name ?></option>
				<?php endforeach; ?>
			</select>

		</div>
		<div style="padding:4px;height:40px;margin-top:10px">
			<input style="padding: 5px;width:100px" value=" PRINT" id="btn_print" type="button" />
			<input style="padding: 5px;width:100px" value=" EXCEL " id="btn_excel" type="button" />
		</div>
	</div>
</div>
<div>
	<div style="width:99%;background-color:#EEEEEE;color:black;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<?php echo form_open('researcher/search') ?>
		<div style="font-weight:bold">Cari Researcher:</div>
		<div style="float:left;position:relative;width:690px">
			<div style="height:55px;float:left;position:relative;width:200px;padding-left:40px">
				Unit : 
				<select size="1" class="input" name="unit" id="Category" style="width:220px;margin: 0;">
					<option value="">Choose Unit</option>
					<?php foreach($organization as $org) : ?>
						<option value="<?php echo $org->id_organization_item ?>"><?php echo $org->org_name ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div style="height:55px;float:left;position:relative;width:150px;padding-left:40px">
				Competence : <br />
				<?php foreach($competence as $comp) : ?>
					<input type="checkbox" name="competence[]" value="<?php echo $comp->name ?>">&nbsp;<?php echo substr($comp->name, 0, 1) ?>
				<?php endforeach; ?>
			</div>
			<div style="height:55px;float:left;position:relative;width:150px;padding-left:40px">
				Certificate : <input type="text" name="certificate" placeholder="Sun Certified Developer" style="width:180px">
			</div>
			<div style="height:55px;float:left;position:relative;width:200px;padding-left:40px">
				Training : <input type="text" name="training" placeholder="Oracle" style="width:220px">
			</div>
			<div style="height:55px;float:left;position:relative;width:75px;padding-left:40px">
				NIK : <input type="text" name="nik" placeholder="NIK" style="width:100px">
			</div>
			<div style="height:55px;float:left;position:relative;width:180px;padding-left:40px">
				Nama : <input type="text" name="name" placeholder="Nama">
			</div>
		</div>
		<div style="float:left;position:relative;width:300px;">
			<br>
			<input style="padding: 5px;" value=" Search " id="submitbutton" type="submit" />
			<input style="padding: 5px;" value=" Clear Filter " id="clearfilteringbutton" type="button" />
			<input style="padding: 5px;" value=" Refresh Data " id="refreshdatabutton" type="button" />
		</div>
		<div style="float:right;position:relative;width:320px;padding-right:10px">
			<br>
			<?php if($this->session->userdata('level')!="researcher"){?>
			<!--<input style="padding: 5px;width:150px" value=" Import Excel Data" id="btn_import" type="button" />-->
			<?php }?>
			<!--<input style="padding: 5px;width:140px" value=" Generate Report" id="btn_report" type="button" />-->
		</div>
		<div style="clear:both"></div>
		</form>
	</div>
</div>