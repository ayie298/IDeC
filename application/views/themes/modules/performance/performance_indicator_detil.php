<script type="text/javascript">
    $(document).ready(function(){
	   $("#btn_save,#btn_back,#btn_edit_indicator,#btn_save_indicator").jqxButton({ height: 30, theme: theme });
        $('#jqxTabs').jqxTabs({ width: '60%', height: '215', position: 'top', theme: theme });
		$('#btn_back').click(function () {
			document.location.href="<?php echo site_url('performance/indicator/update/');?>/" + $(this).attr('value');
		});

		$('#btn_save').click(function () {
			document.location.href="<?php echo site_url('performance/indicator/edit/');?>/" + $(this).attr('value');
		});

		$('#btn_edit_indicator').click(function () {
			$('#indicatortw_edit').show();
			$('#indicatortw_detail').hide();
		});

		$('#btn_save_indicator').click(function () {
			$('#indicatortw_edit').hide();
			$('#indicatortw_detail').show();
		});

	});
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">Performance Indicator Detail</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Performance Indicator Detail
	   </h3>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);font-size:14px">
    <tr id="td_loading" style="display:none" height="30">
        <td colspan="3" align="right">Processing data ....</td>
    </tr>
    <tr id="td_proses" height="30">
        <td colspan="3" align="right">
				<?php if($this->session->userdata('level')!="researcher"){ ?>
				<button style='width:100px' id='btn_save' value="<?php echo $indicator->id_performance_system_item ?>" type='button'>Edit</button><?php } ?>
				<button style='width:100px' id='btn_back' value="<?php echo $indicator->id_performance_system ?>" type='button'>Back</button>
		</td>
    </tr>
    <tr>
        <td width='18%'>Name</td>
        <td width='1%'>:</td>
        <td class="white"><?php echo $indicator->name ?></td>
    </tr>
	<tr>
		<td width='18%'>Description</td>
		<td width='1%'>:</td>
        <td class="white"><?php echo $indicator->description ?></td>
	</tr>
   <tr>
        <td width='18%'>Strategic Objective</td>
        <td width='1%'>:</td>
        <?php $obj = $this->db->where('id_mas_strategic_objective', $indicator->id_mas_strategic_objective)->get('mas_strategic_objective')->row() ?>
        <td class="white"><?php echo $obj->strategic_objective ?></td>
    </tr>
   <tr>
        <td width='18%'>KPI</td>
        <td width='1%'>:</td>
        <td class="white"><?php echo $indicator->indicator_type ?></td>
    </tr>
 	<tr>
		<td width='18%'>Measurement Definition</td>
		<td width='1%'>:</td>
		<td class="white"><?php echo $indicator->measure_definition ?></td>
	</tr>
 	<tr>
		<td width='18%'>Evidence</td>
		<td width='1%'>:</td>
		<td class="white"><?php echo $indicator->evidence ?></td>
	</tr>
    <tr>
        <td width='18%'>Formula</td>
        <td width='1%'>:</td>
        <td class="white">
        	<?php echo $formula1->name .' ' . $formula2->name ?>
        </td>
    </tr>
    <tr>
        <td width='18%'>Used by</td>
        <td width='1%'>:</td>
        <td class="white"><?php echo $indicator->perform_name ?></td>
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
