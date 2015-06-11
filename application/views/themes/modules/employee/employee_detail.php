<script type="text/javascript">
    $(document).ready(function(){
        $("#bar_general").click();

        $('#jqxTabs').jqxTabs({ width: '1100', height: '300', position: 'top', theme: theme });
	    $("#btn_edit,#btn_back,#btn_showhide").jqxButton({ height: 28, theme: theme });
		$('#btn_back').click(function () {
			document.location.href="<?php echo site_url('idec/employee');?>";
		});

		$('#btn_edit').click(function () {
			document.location.href="<?php echo site_url('idec/employee/edit/' . md5($employee->id_employee)) ?>";
		});

		$('#btn_add1,#btn_add2,#btn_add3,#btn_add4,#btn_add5').click(function () {
			edit(1);
		});

		$('#btn_showhide').click(function () {
			$("#tbldetail").toggle("fade");
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
	<div id="popup_title">Employee</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Employee Detail
	   </h3>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr id="td_proses" height="30">
        <td colspan="3" align="right">
			<button id='btn_showhide' style='width:150px' type='button'>SHOW/HIDE DETAIL</button>
			<button id='btn_edit' type='button'>EDIT EMPLOYEE DATA</button>
			<?php if($this->session->userdata('level')!="researcher"){?><button id='btn_back' type='button'>KEMBALI</button><?php }?>
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
