<script type="text/javascript">
    $(document).ready(function(){
	   $("#btn_save,#btn_back,#btn_add_indicator,#btn_formula").jqxButton({ height: 30, theme: theme });
        $('#jqxTabs').jqxTabs({ width: '60%', height: '215', position: 'top', theme: theme });
		$('#btn_back').click(function () {
			document.location.href="<?php echo site_url('performance/indicator/update/' . $indicator->id_performance_system);?>";
		});

		$('#btn_formula').click(function () {
			var offset = $("#jqxgrid").offset();
			$("#popup").jqxWindow({
				theme: theme, resizable: false,
				width: 700,
				height: 500,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popup").jqxWindow('open');
		});
	});
</script>
<script type="text/javascript">
$(function(){
	$('.add_target').click(function(){
		add_target($(this).attr('value'), $(this).attr('target'));
	})
})
function add_target(id, id_target){
		$("#popup_tw_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.post("<?php echo site_url('performance/indicator/add_target') ?>/", 'quartal='+id+'&id='+id_target+'&id_per=<?php echo $indicator->id_performance_system_item ?>', function(response) {
			$("#popup_tw_content").html(response);
		});
		var offset = $("#jqxgrid").offset();
		$("#popup_tw").jqxWindow({
			theme: theme, resizable: false,
			width: 720,
			height: 350,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_tw").jqxWindow('open');
	}
function edit_target(id){
		$("#popup_tw_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.post("<?php echo site_url('performance/indicator/add_target') ?>/", 'id_target_item='+id+'&id_per=<?php echo $indicator->id_performance_system_item ?>', function(response) {
			$("#popup_tw_content").html(response);
		});
		var offset = $("#jqxgrid").offset();
		$("#popup_tw").jqxWindow({
			theme: theme, resizable: false,
			width: 720,
			height: 350,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_tw").jqxWindow('open');
	}
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup_tw" style="display:none">
	<div id="popup_tw_title">Target</div>
	<div id="popup_tw_content" style="padding:10px;"></div>
</div>
<div id="popup" style="display:none">
	<div id="popup_title">Formula</div>
	<div id="popup_content">
		<div style="padding:10px;width:45%;float:left;position:relative">
		   <b>Standard Formula Pencapaian</b>
		   <div style="padding-top:10px;height:90px;width:99%">F1</div>
		   <div style="padding-top:10px;height:90px;width:99%">F2</div>
		   <div style="padding-top:10px;height:90px;width:99%">F3</div>
		   <div style="padding-top:10px;height:90px;width:99%">F4</div>
		</div>
		<div style="padding:10px;width:45%;float:left;position:relative">
		   <b>Standard Formula Realisasi</b>
		   <div style="padding-top:10px;height:90px;width:99%">R1</div>
		   <div style="padding-top:10px;height:90px;width:99%">R2</div>
		   <div style="padding-top:10px;height:90px;width:99%">R3</div>
		   <div style="padding-top:10px;height:90px;width:99%">R4</div>
		</div>
	</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Edit Indicator
	   </h3>
   </div>
</div>
<div class="row-fluid">
	<?php $notice = $this->session->flashdata('notice') ?>
	<?php echo !empty($notice) ? '<div class="alert">'.$this->session->flashdata('notice') : '' ?>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
	<?php echo form_open() ?>
	<input type="hidden" name="id_indicator" value="<?php echo $indicator->id_performance_indicator ?>" />
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr id="td_loading" style="display:none" height="30">
        <td colspan="3" align="right">Processing data ....</td>
    </tr>
    <tr>
        <td colspan="3" style="font-size:20px">Edit Indicator</td>
    </tr>
    <tr id="td_proses" height="30">
        <td colspan="3" align="right">
				<input style='width:100px' id='btn_save' name="submit" value="Save" type='submit' />
				<button style='width:100px' id='btn_back' type='button'>Back</button>
		</td>
    </tr>
    <tr>
        <td width='18%'>Name</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="20" name="name" value="<?php echo $indicator->name ?>" id="Name" placeholder="Name" style="margin: 0;height: 30px;"/></td>
    </tr>
	<tr>
		<td width='18%'>Description</td>
		<td width='1%'>:</td>
		<td class="white"><input type="text" size="20" name="desc" value="<?php echo $indicator->description ?>" id="Description" placeholder="Description" style="margin: 0;height: 30px;width:600px"/></td>
	</tr>
   <tr>
        <td width='18%'>Program</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="program" id="Category" style="width: 300px;margin: 0;">
				<?php foreach($program as $prog) : ?>
					<option value="<?php echo $prog->id_program ?>" <?php echo $prog->id_program == $indicator->id_program ? 'selected' : '' ?>><?php echo $prog->name ?></option>
				<?php endforeach ?>
			</select>
		</td>
    </tr>
   <tr>
        <td width='18%'>Strategic Objective</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="objective" id="Category" style="width: 300px;margin: 0;">
				<?php foreach($strategic as $strat) : ?>
					<option value="<?php echo $strat->id_mas_strategic_objective ?>" <?php echo $strat->id_mas_strategic_objective == $indicator->id_mas_strategic_objective ? 'selected' : '' ?>><?php echo $strat->strategic_objective ?></option>
				<?php endforeach ?>
			</select>
		</td>
    </tr>
   <tr>
        <td width='18%'>KPI</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="kpi" id="Category" style="width: 300px;margin: 0;">
				<option value="shared">Shared</option>
				<option value="common">Common</option>
				<option value="spesific">Spesific</option>
			</select>
		</td>
    </tr>
 	<tr>
		<td width='18%'>Measurement Definition</td>
		<td width='1%'>:</td>
		<td class="white"><textarea cols="60" name="definition" rows="4" style="width: 400px;margin: 0;"><?php echo $indicator->measure_definition ?></textarea></td>
	</tr>
 	<tr>
		<td width='18%'>Evidence</td>
		<td width='1%'>:</td>
		<td class="white"><textarea cols="60" rows="4" name="evidence" style="width: 400px;margin: 0;"><?php echo $indicator->evidence ?></textarea></td>
	</tr>
    <tr>
        <td width='18%'>Formula</td>
        <td width='1%'>:</td>
        <td class="white">
        	<input type="hidden" name="idForReal" value="<?php echo $formula1->id_formula_performance_indicator ?>" />
        	<input type="hidden" name="idForAchieve" value="<?php echo $formula2->id_formula_performance_indicator ?>" />
			<select size="1" class="input" name="for_realisasi" id="Status" style="width: 100px;margin: 0;">
				<?php foreach($formula_realisasi as $for) : ?>
					<option value="<?php echo $for->id_mas_formula ?>" <?php echo $for->id_mas_formula == $formula1->id_mas_formula ? 'selected' : '' ?>><?php echo $for->name ?></option>
				<?php endforeach ?>
			</select>
			<select size="1" class="input" name="for_achieve" id="Status" style="width: 100px;margin: 0;">
				<?php foreach($formula_achievement as $for) : ?>
					<option value="<?php echo $for->id_mas_formula ?>"  <?php echo $for->id_mas_formula == $formula2->id_mas_formula ? 'selected' : '' ?>><?php echo $for->name ?></option>
				<?php endforeach ?>
			</select>

			<button style='width:100px' id='btn_formula' type='button'>Formula</button>
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
