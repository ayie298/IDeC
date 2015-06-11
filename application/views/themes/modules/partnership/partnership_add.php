<script type="text/javascript">
    $(document).ready(function(){
		$("#bar_rms").click();
 		$("#btn_save,#btn_back").jqxButton({ height: 28, theme: theme });
		$('#jqxTabs').jqxTabs({ width: '1200px', height: '700', position: 'top', theme: theme });
		$('#btn_back').click(function () {
			document.location.href="<?php echo base_url();?>partnership/partnership_list";
		});
	});
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">Partnership Edit</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Partnership New
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
	<form action="<?=base_url('partnership/partnership_action/add/')?>" method="post">
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
				<td width='18%'>Mitra</td>
				<td width='1%'>:</td>
				<td class="white">
					<input type="text" size="20" name="mitra" id="Partner" placeholder="Mitra" value="<?=$mitra;?>" style="margin: 0;height: 30px;"/> 
				</td>
    </tr>
	<tr valign='top'>
		<td width='10%'>Kategori</td>
		<td width='1%'>:</td>
		<td class="white">
			<?=form_dropdown('kategori',array('Kerja Sama Pengembangan'=>'Kerja Sama Pengembangan', 'Kerjasama Riset' => 'Kerjasama Riset', 'Kerjasama inisiatif bisnis' => 'Kerjasama inisiatif bisnis'),$kategori,'size="1" class="input"  id="categori" style="width:300px;margin: 0;');?>
		</td>
        <td width='10%'>Status</td>
        <td width='1%'>:</td>
        <td >
			<?=form_dropdown('status',project_status(),1,'class="input"  id="Status" style="width:300px;margin: 0;');?>
		</td>
    </tr>
	<tr valign='top' height='30'>
        <td width='10%' rowspan='2'>Judul</td>
        <td width='1%' rowspan='2'>:</td>
        <td class="white" rowspan='2'><textarea placeholder="Judul" name="judul" rows='4' style='width:400px'><?=$judul;?></textarea></td>
        <td width='10%'>Unit Kerja Initiator</td>
        <td width='1%'>:</td>
        <td class="white">
        	<?php $orgs = array() ?>
        	<?php foreach($organization as $org) : $orgs[$org->id_organization_item] = $org->org_name; endforeach; ?>

			<?=form_dropdown('program',$orgs,$program,'size="1" class="input"  id="program" style="width:300px;margin: 0;');?>
		</td>
    </tr>
	<tr valign='top'>
        <td width='10%'>Program</td>
        <td width='1%'>:</td>
        <td class="white">
        	<?php $orgs = array() ?>
        	<?php foreach($programs as $org) : $orgs[$org->id_program] = $org->name; endforeach; ?>
			<?=form_dropdown('program_1',$orgs,$program_1,'size="1" class="input"  id="program_1" style="width:300px;margin: 0;');?>
		</td>
    </tr>
    <input type="hidden" id="budget_input" name="budget" value="<?=$budget?>" />
    <input type="hidden" id="tanggal3_input" name="tanggal3" value="<?=$tanggal3?>" />
    <input type="hidden" id="tanggal1_input" name="tanggal1" value="<?=$tanggal1?>" />
    <input type="hidden" id="tanggal2_input" name="tanggal2" value="<?=$tanggal2?>" />
    <tr>
        <td colspan="6">
			<div id="jqxTabs">
				<ul>
					<li>Detail</li>
					<li>Activity</li>
					<li>Keterangan</li>
				</ul>
				<div style="padding: 10px;">
				<?=$document;?>
				</div>
				
				<div style="padding: 10px;">
				<?=$activity;?>
				</div>
				<div style="padding: 10px;">
				<?=$evaluasi;?>
				</div>
			</div>		
		</td>
    </tr>
    </table>
	</form>
</div>








 