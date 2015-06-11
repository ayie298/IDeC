<script type="text/javascript">
    $(document).ready(function(){
		$('#btn_back').click(function () {
			document.location.href="<?php echo site_url('performance');?>";
		});

		$('#unit').change(function(){
			var data = $(this).val();
			$.ajax({
				url : '<?php echo site_url('researcher/search/get_researcher') ?>',
				type : 'POST',
				data : 'unit=' + data,
				success : function(data) {
					$('#employee').html(data);
				}
			});

			return false;
		});
	});
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">Performance Data</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Performance Data
	   </h3>
   </div>
</div>
<div class="row-fluid">
   <div class="span12">
		 <?php echo !empty($notice) ? '<div class="alert">'.$notice.'</div>' : ''; ?>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr id="td_loading" style="display:none" height="30">
        <td colspan="3" align="right">Processing data ....</td>
    </tr>
    <tr>
        <td colspan="3" style="font-size:20px">Performance <?php echo $title ?></td>
    </tr>
    <?php echo form_open() ?>
    <tr id="td_proses" height="30">
        <td colspan="3" align="right">
				<button class='btn' id='btn_back' type='button'>KEMBALI</button>
				<input class='btn' id='btn_save' type='submit' value="SIMPAN" />
		</td>
    </tr>
	<?php if(!empty($performance)) { ?>
	<tr valign="top">
        <?php $name = $performance->org_name == "" ? 'Researcher : ' . $performance->name : $performance->org_name ?>
        <td width='18%'>Performance For</td>
        <td width='1%'>:</td>
        <td class="white"><?php echo strtoupper($name); ?></td>
      </tr>
     <?php } else { ?>
     <tr valign="top">
        <td width='18%' rowspan="2">Performance For</td>
        <td width='1%' rowspan="2">:</td>
        <td class="white">
			<select size="1" class="input" name="unit" id="unit" style="width: 300px;margin: 0;">
				<option value="">Choose Unit</option>
				<?php foreach($organization as $org) : ?>
					<?php $select = $org->id_organization_item == $performance->id_organization_item ? 'selected' : '' ?>
					<option value="<?php echo $org->id_organization_item ?>" <?php echo $select ?>><?php echo $org->org_name ?></option>
				<?php endforeach; ?>
			</select>
		</td>
    </tr>
	<tr>
        <td class="white">
			<select size="1" class="input" name="employee" id="employee" style="width: 300px;margin: 0;">
				<option value="">Choose Researcher</option>
			</select>
		</td>
    </tr>
	<?php } ?>
	<tr>
        <td width='18%'>Name</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" value="<?php echo !empty($performance) ? $performance->perform_name : '' ?>" size="20" name="name" id="Description" placeholder="Description" style="margin: 0;height: 30px;width:600px"/></td>
    </tr>
	<tr>
        <td width='18%'>Description</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" value="<?php echo !empty($performance) ? $performance->desc : '' ?>" size="20" name="desc" id="Description" placeholder="Description" style="margin: 0;height: 30px;width:600px"/></td>
    </tr>
     <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    </form>
    </table>

</div>
