<script type="text/javascript">
    $(document).ready(function(){
        $('#jqxTabs').jqxTabs({ width: '60%', height: '130', position: 'top', theme: theme });
		$('#btn_back').click(function () {
			document.location.href="<?php echo site_url('program');?>";
		});

		$('#btn_target').click(function () {
			document.location.href="<?php echo site_url('program/update/' . md5($program->id_program));?>";
		});

	});
</script>
<style type="text/css">
.white {
    background: white;
	font-size:14px;
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
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr>
        <td colspan="2" style="font-size:20px">Program Detail</td>
    </tr>
    <tr id="td_proses" height="30">
        <td colspan="2" align="right">
			<?php if($this->session->userdata('level')!="researcher"){?><button class='btn' id='btn_target' type='button'>EDIT PROGRAM</button><?php }?>
			<button class='btn' id='btn_back' type='button'>KEMBALI</button>
		</td>
    </tr>
    <tr valign="top">
        <td width="50%">
		<table cellpadding="4" cellspacing="4" width="95%" style="font-size:14px">
			<tr valign="top">
				<td width='28%'>Program Name</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo $program->name ?></td>
			</tr>
		   <tr valign="top">
				<td width='28%'>Unit</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo $unit ?></td>
			</tr>
		   <tr valign="top">
				<td width='28%'>Bagian / Lab</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo $lab ?></td>
			</tr>
			<tr valign="top">
				<td width='28%'>Description</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo $program->description ?></td>
			</tr>
			<tr valign="top">
				<td width='28%'>User</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo $program->user ?></td>
			</tr>
			<tr valign="top">
				<td width='28%'>Start Date</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo $program->start_date ?></td>
			</tr>
			<tr valign="top">
				<td width='28%'>End Date</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo $program->end_date ?></td>
			</tr>
		   <tr valign="top">
				<td width='28%'>Quartal</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo $program->quartal ?></td>
			</tr>
		   <tr valign="top">
				<td width='28%'>PM</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo !empty($pm) ? $pm : NULL ?></td>
			</tr>
		   <tr valign="top">
				<td width='28%'>PO</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo !empty($po) ? $po : NULL ?></td>
			</tr>
		   <tr valign="top">
				<td width='28%'>Primary Program ?</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo $program->primary_program == 1 ? 'Ya' : 'Bukan' ?></td>
			</tr>
		</table>
		</td>
        <td width="50%">
		<table cellpadding="4" cellspacing="4" width="95%" style="font-size:14px">
			<tr valign="top">
				<td width='28%'>Deliverable</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo $program->deliverable ?></td>
			</tr>
			<tr valign="top">
				<td width='28%'>KPI</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo $program->KPI ?></td>
			</tr>
			<tr valign="top">
				<td width='28%'>Implementation Strategy</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo $program->implementation_strategy ?></td>
			</tr>
			<tr valign="top">
				<td width='28%'>Strategic Initiative</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo $program->strategic_initative ?></td>
			</tr>
			<tr valign="top">
				<td width='28%'>Status</td>
				<td width='1%'>:</td>
				<td class="white"><?php echo $status->status ?></td>
			</tr>
 		</table>
		</td>
    </tr>
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
