<script type="text/javascript">
    $(document).ready(function(){
		$("#bar_rms").click();
 		$("#btn_save,#btn_back").jqxButton({ height: 28, theme: theme });
		$('#jqxTabs').jqxTabs({ width: '1200px', height: '700', position: 'top', theme: theme });
		$('#btn_back').click(function () {
			document.location.href="<?php echo site_url('bantek/bantek_list');?>";
		});
	});
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">BANTEK Edit</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 New BANTEK
	   </h3>
   </div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <?php echo !empty($notice) ? '<div class="alert">'.$notice.'</div>' : ''; ?>
	   <?php echo $this->session->flashdata('notice') ? '<div class="alert">'.$this->session->flashdata('notice').'</div>' : ''; ?>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
	<?php echo form_open() ?>
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr id="td_loading" style="display:none" height="30">
        <td colspan="6" align="right">Processing data ....</td>
    </tr>
    <tr id="td_proses" height="30">
        <td colspan="6" align="right">
			<input style='width:120px' id='btn_save' type='submit' value="SIMPAN" />
			<button style='width:120px' id='btn_back' type='button'>KEMBALI</button>
		</td>
    </tr>
	<tr valign='top'>
		<td width='18%'>Partner User</td>
		<td width='1%'>:</td>
		<td class="white">
			<input type="text" size="20" name="user" value="<?php echo set_value('user') ?>" id="Partner" placeholder="Partner User" style="margin: 0;height: 30px;"/> 
		</td>
        <td width='10%'>Status</td>
        <td width='1%'>:</td>
        <td class="white">
			<?php echo form_dropdown('status', array('1' => 'On Going', '2' => 'Close'), set_value('status')) ?>
		</td>
    </tr>
	<tr valign='top' height='30'>
        <td width='10%'>Judul</td>
        <td width='1%'>:</td>
        <td class="white"><textarea name="judul" placeholder="Judul" rows='4' style='width:400px'><?php echo set_value('judul') ?></textarea></td>
        <td width='10%'>Unit Kerja Eksekutor</td>
        <td width='1%'>:</td>
        <td class="white">
        	<?php foreach($organization as $org) : ?>
        	<?php $check = in_array($org->id_organization_item, $unit_choose) ? 'checked' : '' ?>
        		<input type="checkbox" name="unit[]" value="<?php echo $org->id_organization_item ?>" <?php echo $check ?>><?php echo strtoupper($org->org_name) ?><br />
        	<?php endforeach; ?>
		</td>
    </tr>
    <input type="hidden" id="tanggal1_input" name="tanggal1" value="<" />
    <input type="hidden" id="tanggal2_input" name="tanggal2" value="" />
    <tr>
        <td colspan="6">
			<div id="jqxTabs">
				<ul>
					<li>Detail</li>
				</ul>
				<div style="padding: 10px;">
				<?php echo $document ?>
				</div>
			</div>		
		</td>
    </tr>
    </table>
</form>
</div>
