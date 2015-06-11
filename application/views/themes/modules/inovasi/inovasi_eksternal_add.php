<script type="text/javascript">
    $(document).ready(function(){
       $("button,input[type='button'],input[type='submit']").jqxButton({ height: 28, theme: theme });
       $("input[type='text']").jqxInput({ height: 28, width:'99%', theme: theme });
       $("textarea").jqxInput({ height: 100, width:'99%', theme: theme });
       $('#jqxTabs').jqxTabs({ width: '97%', height: '350', position: 'top', theme: theme });
		$('#btn_back').click(function () {
			document.location.href="<?php echo base_url();?>inovasi/inovasi_eksternal";
		});

        $("#tanggal,#tanggal2").jqxDateTimeInput({ width: '140px', height: '30px', formatString: 'yyyy-MM-dd', theme: theme});

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

	});
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">Innovation and Research</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
         <i class='icon-tasks'></i> Add Hasil Inovasi Eksternal 
	   </h3>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table class='tbl-form'>
    <tr id="td_proses" height="30">
        <td colspan="6" align="right">
			<button style='width:120px' id='btn_save' type='button'><i class='icon-save'></i> SIMPAN</button>
			<button style='width:120px' id='btn_back' type='button'><i class='icon-chevron-sign-left'></i> KEMBALI</button>
		</td>
    </tr>
     <tr>
        <td>Judul Inovasi</td>
        <td width='1%'>:</td>
        <td width='33%' class="white"><input type="text" size="50" name="Judul Inovasi" id="Judul Inovasi" placeholder="Judul Inovasi" style="margin: 0;height: 30px;"/></td>
        <td width='10%'>Kategori</td>
        <td width='1%'>:</td>
        <td class="white">
            <select size="1" class="input" name="Category" id="Category" style="width:95%;margin: 0;">
                <option>-</option>
                <option>Inovative Idea</option>
                <option>Innovative Product</option>
                <option>Innovative Business</option>
            </select>
        </td> 
   </tr>   
    <tr>
        <td>Nama Tim Startup</td>
        <td width='1%' >:</td>
        <td class="white"><input type="text" size="20" name="Nama Tim Startup" id="Nama Tim Startup" placeholder="Nama Tim Startup" style="margin: 0;height: 30px;"/></td>
      <td width='10%'>Sub Kategori</td>
        <td width='1%'>:</td>
        <td class="white">
            <select size="1" class="input" name="Category" id="Category" style="width:95%;margin: 0;">
                <option>-</option>
                <option>Personal Apps</option>
                <option>Home Solution </option>
                <option>Business Solution</option>
                <option>Social Media and Community</option>
                <option>City and Government Solution</option>
                <option>Commerce</option>
            </select>
        </td>    
    </tr>
    <tr>
        <td width='15%'>PIC</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="20" name="PIC" id="PIC" placeholder="PIC" style="margin: 0;height: 30px;"/></td>
        <td rowspan='3' width='18%'>Deskripsi</td>
        <td rowspan='3' width='1%'>:</td>
        <td rowspan='3' class="white"><textarea name="Description" id="Description" placeholder="Description" style="width:450px;margin: 0;height: 100px;"/></textarea></td>
    </tr>
    <tr>
        <td>Tlp</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="20" name="Tlp" id="Tlp" placeholder="Tlp" style="margin: 0;height: 30px;"/></td>
    </tr>
    <tr>
        <td>Email</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="20" name="Email" id="Email" placeholder="Email" style="margin: 0;height: 30px;"/></td>
    </tr>
    <tr>
     	<td width='10%'>Tahap Akhir</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="Category" id="Category" style="width:95%;margin: 0;">
				<option>Customer Validation</option>
				<option>Product Validation</option>
				<option>Business Model Validation</option>
				<option>Handover to DDB</option>
			</select>
		</td>
        <td>Tanggal Mulai Proses</td>
        <td width='1%'>:</td>
        <td class="white"><div id='tanggal'></div></td>
    </tr>
    <tr>
        <td rowspan='2'>Keterangan</td>
        <td rowspan='2'>:</td>
        <td rowspan='2' class="white"><textarea name="Keterangan" id="Keterangan" placeholder="Keterangan" style="width:450px;margin: 0;height: 100px;"/></textarea></td>
        <td>Tanggal Selesai</td>
        <td width='1%'>:</td>
        <td class="white"><div id='tanggal2'></div></td>
    </tr>
    <tr>
        <td>Total Realisasi Anggaran (Rp)</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="100" name="Realisasi" id="Realisasi" placeholder="000" style="margin: 0;height: 30px;"/></td>
    </tr>
    <tr>
        <td colspan="6">
			<div id="jqxTabs">
				<ul>
					<li>File / Document</li>
					<li>Pemanfaatan Lebih Luas</li>
				</ul>
				<div style="padding: 10px;">
				<?php echo $document?>
				</div>
				<div>
                <?php echo $pemanfaatan?>
				</div>
			</div>		
		</td>
    </tr>
    </table>
</div>
