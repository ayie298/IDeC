<script type="text/javascript">
    $(document).ready(function(){
		$("#btn_analysis,#btn_back,#btn_detail,#btn_save").jqxButton({ height: 30, theme: theme });

		$('#btn_detail').click(function () {
			document.location.href="<?php echo base_url();?>idec_pms/performance_indicator_detil";
		});

		$('#btn_back').click(function () {
			document.location.href="<?php echo site_url('performance/detail/' . md5($performance->id_performance_system));?>";
		});

		$('#btn_analysis').click(function () {
			$("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
			var offset = $("#jqxgrid").offset();
			$.get("<?php echo site_url('performance/indicator/analysis/' . $quartal->id_performance_quartal);?>", function(response) {
				$("#popup_content").html(response);
			});
			$("#popup").jqxWindow({
				theme: theme, resizable: false,
				width: 600,
				height: 420,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popup").jqxWindow('open');

		});

		$('#btn_budget').click(function () {
			$("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='http://idec.byethost4.com/media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
			var offset = $("#jqxgrid").offset();
			$.get("<?php echo site_url('performance/indicator/budget/' . $quartal->id_performance_quartal);?>", function(response) {
				$("#popup_content").html(response);
			});
			$("#popup").jqxWindow({
				theme: theme, resizable: false,
				width: 600,
				height: 220,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popup").jqxWindow('open');

		});


		$('#Year').change(function(){
			var d = $(this).val();

			if(d == "manual") {
				$('#manual').show();
			} else {
				$('#manual').hide();
			}
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
	<div id="popup_title">Edit Analysis</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Performance Realization
	   </h3>
   </div>
</div>
<div class="row-fluid">
	<?php $notice = $this->session->flashdata('notice') ?>
	<?php echo !empty($notice) ? '<div class="alert">'.$this->session->flashdata('notice') : '' ?>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background:#FFFFFF;">
    <tr id="td_loading" style="display:none" height="30">
        <td colspan="2" align="right">Processing data ....</td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:20px">
			<div style="font-size:14px">Performance System</div>
			<div style="font-size:20px"><a><?php echo $system->name ?></a></div>
			<div style="font-size:18px;padding-top:30px"><?php echo $program->name ?> <a href="<?php echo site_url('program/detail/' . md5($performance->id_program)) ?>"><button id='btn_details'  style='width:100px' type='button'>Detail</button></a><button style='width:100px' id='btn_back' type='button' />Back</div>
		</td>
    </tr>
    <tr>
    	<?php echo form_open() ?>
        <td width='50%' style="font-size:16px">Formula <?php echo $formula2->name . ' ' . $formula1->name ?></td>
        <td width='50%' align="right">
		Triwulan : 
			<select size="1" class="input" name="quartal" id="Status" style="width: 100px;margin: 0;">
				<option value="1">TW I</option>
				<option value="2">TW II</option>
				<option value="3">TW III</option>
				<option value="4">TW IV</option>
			</select>
			<input style='width:100px' id='btn_backs' name="change_quartal" value="Change" type='submit' />
		</td>
		</form>
    </tr>
    <tr valign="top" style="background:#EFEFEF">
        <td width='50%'>
		    <table width='80%' cellpadding='5' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background:#FFF;font-size:14px">
				<tr style="font-weight:bold;background:#FAFAFA">
					<td style="border:1px solid #999999;">Name</td><td style="border:1px solid #999999;">Value</td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Weight</td><td style="border:1px solid #999999;"><?php echo !empty($quartal) ? $quartal->weight : 100 ?>%</td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Target</td><td style="border:1px solid #999999;">100%</td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Realization</td><td style="border:1px solid #999999;"><?php echo !empty($quartal) ? $quartal->achievement_raw : 0 ?>%</td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Achievement </td><td style="border:1px solid #999999;"><?php echo !empty($quartal) ? $quartal->achievement : 0 ?>%</td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Deviation</td><td style="border:1px solid #999999;"><?php echo !empty($quartal) ? $quartal->deviation : 0 ?>%</td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Analysis</td><td style="border:1px solid #999999;"><?php echo !empty($quartal) ? $quartal->analysis : NULL ?></td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Evaluation</td><td style="border:1px solid #999999;"><?php echo !empty($quartal) ? $quartal->evaluation : NULL ?></td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Recomendation</td><td style="border:1px solid #999999;"><?php echo !empty($quartal) ? $quartal->recommendation : NULL ?></td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Accomplishment</td><td style="border:1px solid #999999;"><?php echo !empty($quartal) ? (float) $quartal->accomplishment/100 : 0 ?>%</td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Realisasi Target</td><td style="border:1px solid #999999;">Rp <?php echo !empty($quartal) ? number_format($quartal->budget_realization) : 0 ?></td>
				</tr>
			</table>
			<?php if($this->session->userdata('level')!="researcher"){?><br><br>
			<button id='btn_analysis' style='width:100px' type='button'>Edit Analysis</button>
			<button id='btn_budget' style='' type='button'>Edit Realisasi Anggaran</button>
			<?php } ?>
		</td>
        <td width='50%'>
        	<?php echo form_open() ?>
        	<input type="hidden" name="id" value="<?php echo !empty($quartal) ? $quartal->id_performance_quartal : ''; ?>" />
        	<input type="hidden" name="tw" value="<?php echo $periode ?>" />
		    <table width='80%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid #999999;background: #FFF;">
				<tr style="background:#FAFAFA">
					<td>
						<br>Count Mode : 
						<select size="1" class="input" name="method" id="Year" style="width: 300px;margin: 0;">
							<option value="formula">Berdasarkan Formula</option>
							<option value="manual">Manual</option>
						</select>
						<br><br>
					</td>
				</tr>
				<tr>
					<td><br>Target</td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;Metric : <?php echo $target->metric_type ?> </td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $target->target ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $target->target_detail ?><br><br></td>
				</tr>
				<tr>
					<td>Realization</td>
				</tr>
				<?php if($this->session->userdata('level')!="researcher"){?>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" placeholder="40" value="<?php echo !empty($real) ? $real->realization : '' ?>" name="real" style="width:50px;height:30px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $target->target_detail ?></td>
				</tr>
				<tr id="manual" style="display:none;">
					<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;Realization Percent&nbsp;&nbsp;&nbsp;<input type="text" placeholder="105 %" name="real_percent" style="width:60px;height:30px"></td>
				</tr>
				<?php }else{?>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;40&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah proposal diterima</td>
				</tr>
				<tr>
					<td colspan="2"><br>Realization Percent&nbsp;&nbsp;&nbsp;105%</td>
				</tr>
				<?php }?>
				<?php if($this->session->userdata('level')!="researcher"){?><tr>
					<td colspan="2"><input style='width:100px' id='btn_save' name="submit_formula" type='submit' value="Save" /></td>
				</tr><?php }?>
			</table>
			</form>
		</td>
    </tr>
   <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    </table>
</div>
