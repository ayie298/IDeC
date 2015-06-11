<script type="text/javascript">
    $(document).ready(function(){
        $("#bar_rms").click();

        $('#jqxTabs').jqxTabs({ width: '1000', height: '350', position: 'top', theme: theme });
	    $("#btn_save,#btn_back").jqxButton({ height: 28, theme: theme });
		$('#btn_back').click(function () {
			document.location.href="<?php echo site_url('researcher/project');?>";
		});

		$('#btn_add1').click(function () {
			add_member(1);
		});

		$('#btn_add2').click(function () {
			add_step('<?php echo !empty($project->id_project) ? $project->id_project : 1; ?>');
		});

        $("#tanggal,#tanggal_end").jqxDateTimeInput({ width: '140px', height: '30px', formatString: 'yyyy-MM-dd', theme: theme});

		function add_step(id){
			$("#popup_title").html("Step Project");
			$("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
			var offset = $("#jqxgrid").offset();
			$.get("<?php echo site_url('researcher/project/add_step');?>?id=" + id, function(response) {
				$("#popup_content").html(response);
			});
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
	<div id="popup_title">Project Data</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Alokasi Researcher Project Baru
	   </h3>
   </div>
</div>
<div class="row-fluid">
   <div class="span12">
		 <?php echo $this->session->flashdata('notice') == "" ? "" : '<div class="alert">' . $this->session->flashdata('notice') . '</div>'; ?>
		 <?php echo !empty($notice) ? '<div class="alert">' . $notice . '</div>' : "" ; ?>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
	<?php echo form_open() ?>
	<input type="hidden" name="id" value="<?php echo !empty($project) ? $project->id_project : '' ?>" />
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr id="td_proses" height="30">
        <td colspan="6" align="right">
				<input id='btn_save' style='width: 100px;' type='submit' name="submit" />
				<button id='btn_back' style='width: 100px;' type='button'>KEMBALI</button>
		</td>
    </tr>
    <tr valign='top'>
        <td width='12%'>Name</td>
        <td width='1%'>:</td>
        <td width='30%' class="white">
        	<input type="text" size="20" value="<?php echo !empty($project->name) ? $project->name : set_value('name') ?>" name="name" id="Name" placeholder="Name" style="margin: 0;height: 30px;"/></td>
        <td width='12%'>Start Date</td>
        <td width='1%'>:</td>
        <td class="white"><div id='tanggal' name="tanggal" value="<?php echo !empty($project->start_date) ? $project->start_date : set_value('start_date') ?>"></div></td>
    </tr>
    <tr valign='top'>
        <td width='12%'>Unit</td>
        <td width='1%'>:</td>
        <td class="white">
        	<!--
			<select size="1" class="input" name="unit" id="Category" style="width: 300px;margin: 0;">
				<option value="">Choose Unit</option>
				<?php $units = array(); ?>
				<?php foreach($organization as $org) : ?>
				<?php $units[$org->id_organization_item] = $org->org_name ?>
					<option value="<?php echo $org->id_organization_item ?>" <?php echo !empty($project->id_organization_item) && $project->id_organization_item == $org->id_organization_item ? "selected" : "" ?>><?php echo $org->org_name ?></option>
				<?php endforeach; ?>
			</select>
		-->
			<?php echo form_dropdown('unit',$units,!empty($project->id_organization_item) && $project->id_organization_item == $org->id_organization_item ? $org->id_organization_item : set_value('unit')); ?>
		</td>
        <td width='12%'>End Date</td>
        <td width='1%'>:</td>
        <td class="white"><div id='tanggal_end' name="tanggal_end" value="<?php echo !empty($project->end_date) ? $project->end_date : "" ?>"></div></td>
    </tr>
    <tr valign='top'>
        <td width='12%'>Program</td>
        <td width='1%'>:</td>
        <td class="white">
        	<!--
			<select size="1" class="input" name="program" id="Category" style="width: 300px;margin: 0;">
				<?php $programs  = array(); ?>
				<?php foreach($program as $prog) : ?>
					<?php $programs[$prog->id_program] = $prog->name ?>
					<option value="<?php echo $prog->id_program ?>" <?php echo !empty($project->id_program) && $project->id_program == $prog->id_program ? "selected" : "" ?>><?php echo $prog->name ?></option>
				<?php endforeach; ?>
			</select>
		-->
			<?php echo form_dropdown('program',$programs,!empty($project->id_program) && $project->id_program == $prog->id_program ? $prog->id_program : set_value('program')); ?>
		</td>
        <td width='12%'>Status</td>
        <td width='1%'>:</td>
        <td class="white">
        <!--
			<select size="1" class="input" name="status" id="Category" style="width: 150px;margin: 0;">
				<?php $statuses = array() ?>
				<?php foreach($status as $stat) : ?>
					<option value="<?php echo $stat->id_mas_project_status ?>" <?php echo !empty($project->id_mas_project_status) && $project->id_mas_project_status == $stat->id_mas_project_status ? "selected" : "" ?>><?php echo $stat->status ?></option>
					<?php $statuses[$stat->id_mas_project_status] = $stat->status ?>
				<?php endforeach; ?>
			</select>
		-->
			<?php echo form_dropdown('status',$statuses,!empty($project->id_mas_project_status) && $project->id_mas_project_status == $stat->id_mas_project_status ? $stat->id_mas_project_status : set_value('status')); ?>
		</td>
    </tr>
    <tr valign='top' height='30'>
        <td width='10%' rowspan='2'>Description</td>
        <td width='1%' rowspan='2'>:</td>
        <td class="white" rowspan='2'><textarea name="desc" id="Description" placeholder="Description" style="width:400px;height:150px"><?php echo !empty($project->project_description) ? $project->project_description : set_value('desc') ?></textarea></td>
        <td width='12%'>Weight</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="20" value="<?php echo !empty($project->weight) ? $project->weight : set_value('weight') ?>" name="weight" id="Weight" placeholder="1-105" style="margin: 0;height: 30px;width:80px"/></td>
    </tr>
    <tr valign='top'>
        <td width='12%'>Stream</td>
        <td width='1%'>:</td>
        <td class="white">
        	<?php $unserialize = !empty($project) ? unserialize($project->id_mas_times_category) : array(); ?>
        	<?php foreach($competence as $stream) : ?>
			<div style='position:relative;float:left;width:150px;font-size:14px;padding:4px'>
				<?php $check = in_array($stream->id_mas_times_category, $unserialize) ? 'checked' : '' ?>
				<input type="checkbox" name="stream[]" value="<?php echo $stream->id_mas_times_category ?>" <?php echo $check ?>> <?php echo $stream->category ?>
			</div>
			<?php endforeach ?>
    </tr>
     <tr>
        <td colspan="6">&nbsp;</td>
    </tr>
	</form>
    <tr>
        <td colspan="6">
			<div id="jqxTabs">
				<ul>
					<li>Project Step</li>
					<li>Researcher / Team Member</li>
				</ul>
				<div style="padding: 5px;">
				<?php echo $project_step ?>
				</div>
				<div style="padding: 5px;">
				<?php echo $project_member ?>
				</div>
			</div>		
		</td>
    </tr>
    </table>
</div>
