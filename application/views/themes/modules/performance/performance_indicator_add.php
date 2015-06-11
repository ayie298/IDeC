<script type="text/javascript">
    $(document).ready(function(){
		$("#btn_save,#btn_back,#btn_add1,#btn_add2,#btn_save1,#btn_save2,#btn_close,#btn_add_indicator").jqxButton({ height: 30, theme: theme });
        $('#jqxTabs').jqxTabs({ width: '60%', height: '215', position: 'top', theme: theme });
		$('#btn_back').click(function () {
			document.location.href="<?php echo site_url('performance/indicator/update/' . $id);?>";
		});
		
		$('#btn_add1').click(function () {
			$("#edit_indicator").show();
			$(".add_program").hide();
		});

		$('#btn_save1,#btn_close').click(function () {
			$("#edit_indicator").hide();
			$(".add_program").hide();
		});

		$('#btn_add2').click(function () {
			$("#edit_indicator").hide();
			$(".add_program").show();
		});

		$('#btn_save2').click(function () {
			$("#edit_indicator").hide();
			$(".add_program").hide();
		});

		$(".add_program").hide();
	});
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">Add Indicator</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Add Indicator
	   </h3>
   </div>
</div>
<div class="row-fluid">
	<?php $notice = $this->session->flashdata('notice') ?>
	<?php echo !empty($notice) ? '<div class="alert">'.$this->session->flashdata('notice') : '' ?>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr id="td_loading" style="display:none" height="30">
        <td colspan="3" align="right">Processing data ....</td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:20px">Select / Create Indicator</td>
        <td align="right">
				<button style='width:100px' id='btn_back' type='button'>Back</button>
		</td>
    </tr>
   <tr>
        <td width='18%'>Select Existing</td>
        <td width='1%'>:</td>
        <?php echo form_open() ?>
        <td class="white">
			<select size="1" class="input" name="existing" id="Category" style="width: 300px;margin: 0;">
				<?php foreach($existing as $exist) : ?>
					<option value="<?php echo $exist->id_performance_indicator ?>"><?php echo $exist->name ?></option>
				<?php endforeach ?>
			</select>
			<input style='width:100px' id='btn_save' type='submit' name="submit_exist" value="Select" />
			<button style='width:200px' id='btn_add1' type='button'>Create New Indicator</button>
		</td>
		</form>
    </tr>
    <!--
   <tr>
        <td width='18%'>Select From Program</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="Category" id="Category" style="width: 300px;margin: 0;">
				<option>Indigo Incubator</option>
				<option>Creative center deployment </option>
				<option>Implementasi SMT RDC</option>
			</select>
			<button style='width:100px' id='btn_add2' type='button'>Create New </button>
		</td>
    </tr>
-->
   <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
   <tr class="add_program">
        <td width='18%'>Strategic Objective</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="Category" id="Category" style="width: 300px;margin: 0;">
				<option>Increase Productivity</option>
				<option>Increase Productivity</option>
			</select>
		</td>
    </tr>
   <tr class="add_program">
        <td width='18%'>KPI</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="Category" id="Category" style="width: 300px;margin: 0;">
				<option>Cost Optimization</option>
				<option>Cost Optimization</option>
			</select>
		</td>
    </tr>
   <tr class="add_program">
		<td width='18%'>Measurement Definition</td>
		<td width='1%'>:</td>
		<td class="white"><textarea cols="60" rows="4" style="width: 400px;margin: 0;"></textarea></td>
	</tr>
   <tr class="add_program">
		<td width='18%'>Evidence</td>
		<td width='1%'>:</td>
		<td class="white"><textarea cols="60" rows="4" style="width: 400px;margin: 0;"></textarea></td>
	</tr>
   <tr class="add_program">
        <td width='18%'>Formula</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="Status" id="Status" style="width: 100px;margin: 0;">
				<option>R1</option>
				<option>R2</option>
			</select>
			<select size="1" class="input" name="Status" id="Status" style="width: 100px;margin: 0;">
				<option>F1</option>
				<option>F2</option>
			</select>
		</td>
	</tr>
	<tr class="add_program">
        <td colspan="2">&nbsp;</td>
        <td class="white">
			<button style='width:200px' id='btn_save2' type='button'>Save and Add</button>
		</td>
	</tr>
	<tr class="add_program">
        <td colspan="3">&nbsp;</td>
    </tr>
    </table>
</div>

<div id="edit_indicator" style="display:none;width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
	<?php echo form_open() ?>
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr id="td_loading" style="display:none" height="30">
        <td colspan="3" align="right">Processing data ....</td>
    </tr>
    <tr>
        <td colspan="3" style="font-size:20px">Add New Indicator</td>
    </tr>
    <tr id="td_proses" height="30">
        <td colspan="3" align="right">
				<input style='width:100px' id='btn_save1' type='submit' name="save_new" value="Save" />
				<button style='width:100px' id='btn_close' type='button'>Close</button>
		</td>
    </tr>
   <tr>
        <td width='18%'>Unit</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="unit" id="Category" style="width: 300px;margin: 0;">
				<?php foreach($unit as $unit) : ?>
					<option value="<?php echo $unit->id_organization_item ?>"><?php echo $unit->org_name ?></option>
				<?php endforeach; ?>
			</select>
		</td>
    </tr>
   <tr>
        <td width='18%'>Prespective</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="pers" id="Category" style="width: 300px;margin: 0;">
				<?php foreach($perspective as $pers) : ?>
					<option value="<?php echo $pers->id_mas_perspective ?>"><?php echo $pers->perspective ?></option>
				<?php endforeach ?>
			</select>
		</td>
    </tr>
    <tr>
        <td width='18%'>Name</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="20" name="name" id="Name" placeholder="Name" style="margin: 0;height: 30px;"/></td>
    </tr>
	<tr>
		<td width='18%'>Description</td>
		<td width='1%'>:</td>
		<td class="white"><input type="text" size="20" name="desc" id="Description" placeholder="Description" style="margin: 0;height: 30px;width:600px"/></td>
	</tr>
   <tr>
        <td width='18%'>Program</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="program" id="Category" style="width: 300px;margin: 0;">
				<?php foreach($program as $prog) : ?>
					<option value="<?php echo $prog->id_program ?>"><?php echo $prog->name ?></option>
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
					<option value="<?php echo $strat->id_mas_strategic_objective ?>"><?php echo $strat->strategic_objective ?></option>
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
		<td class="white"><textarea cols="60" name="definition" rows="4" style="width: 400px;margin: 0;"></textarea></td>
	</tr>
 	<tr>
		<td width='18%'>Evidence</td>
		<td width='1%'>:</td>
		<td class="white"><textarea cols="60" rows="4" name="evidence" style="width: 400px;margin: 0;"></textarea></td>
	</tr>
    <tr>
        <td width='18%'>Formula</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="for_realisasi" id="Status" style="width: 100px;margin: 0;">
				<?php foreach($formula_realisasi as $for) : ?>
					<option value="<?php echo $for->id_mas_formula ?>"><?php echo $for->name ?></option>
				<?php endforeach ?>
			</select>
			<select size="1" class="input" name="for_achieve" id="Status" style="width: 100px;margin: 0;">
				<?php foreach($formula_achievement as $for) : ?>
					<option value="<?php echo $for->id_mas_formula ?>"><?php echo $for->name ?></option>
				<?php endforeach ?>
			</select>
		</td>
    </tr>
	</form>
   <tr>
        <td colspan="3">
		<div style="padding-top:10px;padding-bottom:10px;font-weight:bold">Target</div>

			<div id="jqxTabs">
				<ul>
					<li>TW I</li>
					<li>TW II</li>
					<li>TW III</li>
					<li>TW IV</li>
				</ul>
				<div style="padding: 10px;">
				{tw}
				</div>
				<div style="padding: 10px;">
				{tw}
				</div>
				<div style="padding: 10px;">
				{tw}
				</div>
				<div style="padding: 10px;">
				{tw}
				</div>
			</div>		
		</td>
    </tr>
    </table>
</div>
