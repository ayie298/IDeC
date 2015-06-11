<script type="text/javascript">
    $(document).ready(function(){
       $("#bar_rms").click();
 	   $("#btn_number,#btn_save,#btn_back").jqxButton({ height: 28, theme: theme });
       
		$('#btn_back').click(function () {
			document.location.href="<?php echo base_url();?>idec_rms/research";
		});

        $("#tanggal").jqxDateTimeInput({ width: '140px', height: '30px', formatString: 'yyyy-MM-dd', theme: theme});

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

		$('#btn_number').click(function(){
			$.post("<?php echo site_url('research/add/generate') ?>",$('#add-form form').serialize(), function(response) {
				$('#Number').val(response);
		});
		})

	});
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">Innovation and Research Add</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Data Hasil Riset Add
	   </h3>
   </div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <?php echo !empty($notice) ? '<div class="alert">'.$notice.'</div>' : '' ?>
	   <?php echo $this->session->flashdata('notice') ? '<div class="alert">'.$this->session->flashdata('notice').'</div>' : '' ?>
   </div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <?php echo $this->session->flashdata('notice') != '' ? '<div class="alert">'.$this->session->flashdata('notice').'</div>' : ''; ?>
   </div>
</div>
<div id="add-form" style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
	<?php echo form_open() ?>
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr id="td_proses" height="30">
        <td colspan="6" align="right">
				<input style='width:120px' id='btn_save' type='submit' value="SIMPAN" />
				<button style='width:120px' id='btn_back' type='button'>KEMBALI</button>
		</td>
    </tr>
    <tr>
        <td width='10%'>Unit</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="unit" id="Category" style="width: 300px;margin: 0;">
				<?php foreach($organization as $org) : ?>
					<option value="<?php echo $org->id_organization_item ?>"><?php echo $org->org_name ?></option>
				<?php endforeach ?>
			</select>
		</td>
        <td width='10%'>Number</td>
        <td width='1%'>:</td>
        <td class="white">
			<input type="text" size="20" name="number" id="Number" placeholder="Number" style="margin: 0;height: 30px;"/> 
			<input style="padding: 5px;width:150px;" value=" Generate Number " id="btn_number" type="button" />
		</td>
    </tr>
    <tr valign='top'>
        <td width='10%'>Program</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="program" id="Program" style="width: 300px;margin: 0;">
				<?php foreach($program as $prog) : ?>
					<option value="<?php echo $prog->id_program ?>"><?php echo $prog->name ?></option>
				<?php endforeach ?>
			</select>
		</td>
        <td rowspan='3' width='10%'>Executive Summary</td>
        <td rowspan='3' width='1%'>:</td>
        <td rowspan='3' class="white"><textarea name="summary" id="Executive Summary" placeholder="Executive Summary" style="width:450px;margin: 0;height: 120px;"/></textarea></td>
    </tr>
    <tr>
        <td width='10%'>Name</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="20" name="name" id="Name" placeholder="Name" style="margin: 0;height: 30px;"/></td>
    </tr>
    <tr>
        <td width='10%'>Type</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="program" id="Program" style="width: 300px;margin: 0;">
				<?php foreach($type as $type) : ?>
					<option value="<?php echo $type->id_mas_research_type ?>"><?php echo $type->type ?></option>
				<?php endforeach ?>
			</select>
		</td>
    </tr>
    <tr>
        <td width='10%'>Group</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="group" id="Category" style="width: 300px;margin: 0;">
				<?php foreach($groups as $group) : ?>
					<option value="<?php echo $group->id_mas_research_group ?>"><?php echo $group->code ?></option>
				<?php endforeach ?>
			</select>
		</td>
        <td rowspan="2">Pemanfaatan</td>
        <td rowspan="2">:</td>
        <td rowspan="2" class="white"><textarea name="pemanfaatan" id="Pemanfaatan" placeholder="Pemanfaatan" style="width:450px;margin: 0;height: 100px;"/></textarea></td>
    </tr>
    <tr>
        <td width='10%'>Content Type</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="content" id="Category" style="width: 300px;margin: 0;">
				<?php foreach($content as $con) : ?>
					<option value="<?php echo $con->id_mas_research_content ?>"><?php echo $con->content_type ?></option>
				<?php endforeach ?>
			</select>
		</td>
    </tr>
    <tr>
        <td width='10%'>Numbering Date</td>
        <td width='1%'>:</td>
        <td class="white"><div id='tanggal' name="tanggal"></div></td>
       <td width='10%'>Status</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="status" id="Category" style="width: 300px;margin: 0;">
				<?php foreach($status as $con) : ?>
					<option value="<?php echo $con->id_mas_project_status ?>"><?php echo $con->status ?></option>
				<?php endforeach ?>
			</select>
		</td>
    </tr>
    <tr valign='top'>
        <td width='10%'>Kesimpulan & Rekomendasi</td>
        <td width='1%'>:</td>
        <td class="white" colspan="4"><textarea name="kesimpulan" id="Kesimpulan & Rekomendasi" placeholder="Kesimpulan & Rekomendasi" style="width:100%;margin: 0;height: 120px;"/></textarea></td>
    </tr>
     <tr valign='top'>
        <td width='10%'>Tim Penyusun</td>
        <td width='1%'>:</td>
        <td class="white" colspan="4">
        	<textarea name="penyusun" id="Kesimpulan & Rekomendasi" placeholder="Tim Penyusun" style="width:100%;margin: 0;height: 120px;"/></textarea>
        </td>
    </tr>
    </table>
</form>
</div>
