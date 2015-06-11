<script type="text/javascript">
    $(document).ready(function(){
        $('#jqxTabs').jqxTabs({ width: '1200', height: '600', position: 'top', theme: theme });
	    $("#btn_edit,#btn_back,#btn_show,#btn_showhide").jqxButton({ height: 28, theme: theme });
		$('#btn_back').click(function () {
			document.location.href="<?php echo site_url('researcher/search');?>";
		});

		$('#btn_edit').click(function () {
			//document.location.href="<?php echo base_url();?>idec_general/employee_edit";
		});

		$('#btn_showhide').click(function () {
			$("#tbldetail").toggle("fade");
		});

		$('#btn_show').click(function () {
			var offset = $("#jqxgrid").offset();
			$("#popup").jqxWindow({
				theme: theme, resizable: false,
				width: 600,
				height: 300,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popup").jqxWindow('open');
		});

		$('#btn_add1,#btn_add2,#btn_add3,#btn_add4').click(function () {
			edit(1);
		});

		function edit(id){
			$("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
			var offset = $("#jqxgrid").offset();
			$("#popup").jqxWindow({
				theme: theme, resizable: false,
				width: 600,
				height: 350,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popup").jqxWindow('open');
		}

	});
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">Researcher CV</div>
	<div id="popup_content">
		<div style="padding:5px;border:2px solid white;width:47%;position:relative;float:left">
			<table cellpadding="4" cellspacing="2" width="100%" style="font-size:12px;border:1px solid #CCC;color:#000">
				<tr style="background:#DDD;">
					<td colspan="2">Competance</td>
				</tr>
				<?php $no = 1; ?>
				<?php foreach($competences as $comp) : ?>
				<tr>
					<td><?php echo $no ?>.</td>
					<td><?php echo strtoupper(substr($comp->name,0,1)) . ' ' . $comp->name ?></td>
				</tr>
				<?php $no++ ?>
				<?php endforeach ?>
			</table>
			<br>
			<table cellpadding="4" cellspacing="2" width="100%" style="font-size:12px;border:1px solid #CCC;color:#000">
				<tr style="background:#DDD;">
					<td colspan="2">Certificate</td>
				</tr>
				<?php $no = 1; ?>
				<?php foreach($certificate as $cer) : ?>
				<tr>
					<td><?php echo $no ?>.</td>
					<td><?php echo $cer->cer_name ?></td>
				</tr>
				<?php $no++ ?>
				<?php endforeach ?>
			</table>
		</div>
		<div style="padding:5px;border:2px solid white;width:47%;position:relative;float:left">
			<table cellpadding="4" cellspacing="2" width="100%" style="font-size:12px;border:1px solid #CCC;color:#000">
				<tr style="background:#DDD;">
					<td colspan="2">Training</td>
				</tr>
				<?php $no = 1 ?>
				<?php foreach($training as $train) : ?>
				<tr>
					<td><?php echo $no ?>.</td>
					<td><?php echo $train->name ?></td>
				</tr>
				<?php $no++ ?>
				<?php endforeach ?>
			</table>
			<br>
			<table cellpadding="4" cellspacing="2" width="100%" style="font-size:12px;border:1px solid #CCC;color:#000">
				<tr style="background:#DDD;">
					<td colspan="2">Education</td>
				</tr><?php $no = 1 ?>
				<?php foreach($education as $ed) : ?>
				<tr>
					<td><?php echo $no ?>.</td>
					<td><?php echo $edu->institute ?></td>
				</tr>
				<?php $no++ ?>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Researcher Data
	   </h3>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr id="td_loading" style="display:none" height="30">
        <td colspan="3" align="right">Processing data ....</td>
    </tr>
    <tr id="td_proses" height="30">
        <td colspan="3" align="right">
			<button id='btn_showhide' style='width:150px' type='button'>SHOW/HIDE DETAIL</button>
			<button id='btn_show' style='width:150px' type='button'>VIEW CV</button>
			<a href="<?php echo site_url('idec/employee/edit/' . md5($employee->id_employee))?>"><button id='btn_edit' style='width:120px' type='button'>EDIT PROFILE</button></a>
			<button id='btn_back' style='width:100px' type='button'>KEMBALI</button>
		</td>
    </tr>
	<tr>
		<td colspan="3">
			<table width="100%">
				<tr valign="top">
					<td width="50%">
						<table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid #CCC;background: #EFEFEF;font-size:14px">

							<tr>
								<td class="white" rowspan="3" width="18%">
									<?php if(empty($employee->photo)) { ?>
										<img src="<?php echo base_url() ?>media/images/profile.jpeg" width="100" height="100">
									<?php } else { ?>
										<img src="<?php echo base_url() ?>uploads/<?php echo $employee->photo ?>" width="100" height="100">
									<?php } ?>
								</td>
								<td class="white"><?php echo $employee->name ?></td>
							</tr>
							<tr>
								<td class="white">NIK: <?php echo $employee->nik ?></td>
							</tr>
							<tr>
								<?php $dob = explode("-", $employee->date_of_birth) ?>
								<?php $dob = date('d F Y', mktime(0,0,0,$dob[1],$dob[2],$dob[0])) ?>
								<td class="white"><?php echo ucfirst($employee->gender) ?>, <?php echo $dob ?></td>
							</tr>
						</table>
					</td>
					<td width="50%">
						<table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid #CCC;background: #EFEFEF;font-size:14px;display:none" id="tbldetail">
							 <?php $lab = $this->employee_model->organization(array('level' => 'lab', 'id_organization_item' => $employee->id_organization_item), 'row'); ?>
							 <?php $unit = empty($lab) ? '' : $this->employee_model->organization(array('id_organization_item' => $lab->id_organization_item_parent), 'row'); ?>
							<tr>
								<td width='25%'>Unit</td>
								<td width='1%'>:</td>
								<td class="white"><?php echo empty($lab) ? $employee->org_name : $unit->org_name ?></td>
							</tr>
							<tr>
								<td width='25%'>Bagian / Lab</td>
								<td width='1%'>:</td>
								<td class="white"><?php echo empty($lab) ? '' : $lab->org_name ?></td>
							</tr>
							<tr>
								<td width='25%'>Position</td>
								<td width='1%'>:</td>
								<td class="white"><?php echo $employee->position ?> </td>
							</tr>
							<tr>
								<td width='25%'>Title</td>
								<td width='1%'>:</td>
								<td class="white"><?php echo $employee->title ?></td>
							</tr>
							<tr>
								<td width='25%'>BP</td>
								<td width='1%'>:</td>
								<td class="white"><?php echo $employee->bp ?></td>
							</tr>
							<tr>
								<td width='25%'>Curiculum Vitae</td>
								<td width='1%'>:</td>
								<td class="white">File <?php echo anchor('uploads/default/cv/' . $employee->cv_document, 'CV.docx') ?>  </td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
    <tr>
        <td colspan="3">
			<div id="jqxTabs">
				<ul>
					<li>Project</li>
					<li>Activity</li>
					<li>BKO</li>
					<li>Work Experience</li>
				</ul>
				<div style="padding: 10px;">
				<?php echo $project ?>
				</div>
				<div style="padding: 10px;">
				<?php echo $activity ?>
				</div>
				<div style="padding: 10px;">
				<?php echo $bko ?>
				</div>
				<div style="padding: 10px;">
				<?php echo $work ?>
				</div>
			</div>		
		</td>
    </tr>
    </table>
</div>
