<script type="text/javascript">

    $(document).ready(function(){
       $("#bar_rms").click();
       $("#btn_number,#btn_save,#btn_back").jqxButton({ height: 28, theme: theme });
       $('#jqxTabs').jqxTabs({ width: '1000px', height: '350', position: 'top', theme: theme });
        $('#btn_back').click(function () {
            document.location.href="<?php echo base_url();?>qa/qa_list";
        });

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
    <div id="popup_title">Quality Assurance</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
       <h3 class="page-title">
         QA Update
       </h3>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <form action="<?=$url;?>" method="post" >
	<tr id="td_proses" height="30">
        <td colspan="6" align="right">
                <button style='width:120px' id='btn_save' type='submit'>SIMPAN</button>
                <button style='width:120px' id='btn_back' type='button'>KEMBALI</button>
        </td>
    </tr>
    <tr>
        <td width='20%'>Nama Produk</td>
        <td width='1%'>:</td>
        <td class="white" colspan="4"><input type="text" size="50" name="name_produk" id="Nama Produk" value="<?=$name_produk; ?>" placeholder="Nama Produk" style="margin: 0;height: 30px;"/></td>
    </tr>
    <tr>
        <td width='20%'>Bulan Mulai</td>
        <td width='1%'>:</td>
        <td class="white">
            <select size="1" class="input" name="Program" id="Program" style="width: 100px;margin: 0;">
                <option>2015</option>
                <option>2014</option>
            </select>
			<?=form_dropdown('bln_1',month(),$bln_1,'style="width: 200px;margin: 0;"');?>
        </td>
        <td width='20%'>Bulan Selesai</td>
        <td width='1%'>:</td>
        <td class="white">
            <select size="1" class="input" name="Program" id="Program" style="width: 100px;margin: 0;">
                <option>2015</option>
                <option>2014</option>
            </select>
            <?=form_dropdown('bln_2',month(),$bln_2,'style="width: 200px;margin: 0;"');?>
        </td>
    </tr>   
    <tr>
        <td width='20%'>Executive Summary</td>
        <td width='1%'>:</td>
        <td class="white" colspan="4"><textarea name="summary" id="Executive Summary" placeholder="Executive Summary" style="width:100%;margin: 0;height: 100px;"/><?=$summary?></textarea></td>
    </tr>
    <tr>
        <td width='20%'>Kesimpulan Pengujian</td>
        <td width='1%'>:</td>
        <td class="white" colspan="4"><textarea name="kesimpulan" id="Kesimpulan Pengujian" placeholder="Kesimpulan Pengujian" style="width:100%;margin: 0;height: 100px;"/><?=$kesimpulan; ?></textarea></td>
    </tr>
    <tr>
        <td width='20%'>Rekomendasi Pengujian</td>
        <td width='1%'>:</td>
        <td class="white" colspan="4"><textarea name="rekomendasi" id="Rekomendasi Pengujian" placeholder="Rekomendasi Pengujian" style="width:100%;margin: 0;height: 100px;"/><?=$rekomendasi;?></textarea></td>
    </tr>
    <tr>
        <td width='20%'>Nama Penguji</td>
        <td width='1%'>:</td>
        <td class="white" colspan="4"><textarea name="nama_penguji" id="Nama Penguji" placeholder="Nama Penguji" style="width:100%;margin: 0;height: 60px;"/><?=$nama_penguji;?></textarea></td>
    </tr>
    <tr>
        <td width='20%'>Keterangan</td>
        <td width='1%'>:</td>
        <td class="white" colspan="4"><textarea name="keterangan" id="Keterangan" placeholder="Keterangan / Dasar Pelaksanaan" style="width:100%;margin: 0;height: 60px;"/><?=$keterangan;?></textarea></td>
    </tr>
	</form>
    <tr>
        <td colspan="6">
            <div id="jqxTabs">
                <ul>
                    <li>File / Document</li>
                </ul>
                <div style="padding: 10px;">
                <script>
    $(function(){
       $("#btn_add_document,#btn_add,#btn_cancel").jqxButton({ height: 28, theme: theme });
       $("#tanggal1,#tanggal2").jqxDateTimeInput({ width: '140px', height: '30px', formatString: 'yyyy-MM-dd', theme: theme});
       var source = {
            datatype: "json",
            type    : "POST",
            datafields: [
            { name: 'urut'},
            { name: 'id', type: 'number' },
            { name: 'deskripsi', type: 'string' },
            { name: 'tgl', type: 'date' }
        ],
        url: "<?=base_url('qa/qa_list/json_file/'.$id)?>",
        cache: false,
        updaterow: function (rowid, rowdata, commit) {
            },
        filter: function(){
            $("#jqxgrid_document").jqxGrid('updatebounddata', 'filter');
        },
        sort: function(){
            $("#jqxgrid_document").jqxGrid('updatebounddata', 'sort');
        },
        root: 'Rows',
        pagesize: 10,
        beforeprocessing: function(data){       
            if (data != null){
                source.totalrecords = data[0].TotalRows;                    
            }
        }
        };      
        var dataadapter = new $.jqx.dataAdapter(source, {
            loadError: function(xhr, status, error){
                alert(error);
            }
        });
     
        $("#jqxgrid_document").jqxGrid(
        {       
            width: '100%',
            selectionmode: 'singlerow',
            source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100', '200'],
            showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
            rendergridrows: function(obj)
            {
                return obj.data;    
            },
            columns: [
                { text: '#', align: 'center', filtertype: 'none', sortable: false, width: '10%', cellsrenderer: function (row) {
                    var dataRecord = $("#jqxgrid_document").jqxGrid('getrowdata', row);
                    return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url() ?>public/images/edt.gif' onclick='edit_document("+dataRecord.id+");'></a> <a href='javascript:void(0);'><img border=0 src='<?php echo base_url() ?>public/images/del.gif' onclick='edit("+dataRecord.id+");'></a></div>";
                 }
                },              { text: 'Deskripsi', datafield: 'deskripsi', columntype: 'textbox', filtertype: 'textbox', width: '47%' },
                { text: 'Received Date ', datafield: 'tgl', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '28%'},
                { text: 'File', filtertype: 'none', sortable: false, width: '15%', cellsrenderer: function (row) {
                    var dataRecord = $("#jqxgrid_document").jqxGrid('getrowdata', row);
                    return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url() ?>public/images/download.gif'></a></div>";
                 }
                }
           ]
        });
        
        $('#clearfilteringbutton').click(function () {
            $("#jqxgrid_document").jqxGrid('clearfilters');
        });
        
        $('#refreshdatabutton').click(function () {
            $("#jqxgrid_document").jqxGrid('updatebounddata', 'cells');
        });

        $('#btn_add_document').click(function () {
            edit_document(<?=$id?>);
        });

    });

    function close_document(){
        $("#popup_document").jqxWindow('close');
    }

    function edit_document(id){
        var offset = $("#jqxgrid").offset();
        $("#popup_document").jqxWindow({
            theme: theme, resizable: false,
            width: 600,
            height: 300,
            isModal: true, autoOpen: false, modalOpacity: 0.2
        });
        $("#popup_document").jqxWindow('open');
    }

</script>
					<div id="popup_document" style="display:none">
						<div id="popup_title">Document</div>
						<div id="popup_content">
								<table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);font-size:12px">
								<tr>
									<td colspan="3" style="font-size:16px;font-weight:bold">Add / Edit Document</td>
								</tr>
								<form action="<?=base_url('qa/qa_add/file/'.$id);?>" method="post" enctype='multipart/form-data' >
								<tr>
									<td width='18%'>Deskripsi</td>
									<td width='1%'>:</td>
									<td class="white"><input type="text" size="40" name="Deskripsi" id="Deskripsi" placeholder="Deskripsi" style="margin: 0;height: 30px;"/></td>
								</tr>
								<tr>
									<td width='18%'>Recieved Date</td>
									<td width='1%'>:</td>
									<td class="white"><div id='tanggal1'  onchange="tanggal(this.value)" ></div></td>
									<input type="hidden" id="tgl" name="tanggal" />
									<script>
										$('document').ready(function(){
											$('#tanggal1').on(function(){
												var a = $(this).val();
												$('#tgl').val(a);
											});
										});
										function tanggal(val){
											$('#tgl').val(val);
											
										}
									</script>
								</tr>
								<tr>
									<td width='18%'>File Upload</td>
									<td width='1%'>:</td>
									<td class="white"><input type="file" name="userfile" style="margin: 0;height: 30px;"/></td>
								</tr>
								<tr id="td_proses" height="30">
									<td colspan="3" align="right">
										<button style='width:120px' id='btn_add' onClick='close_document()' type='submit'>ADD</button>
										<button style='width:120px' id='btn_cancel' onClick='close_document()' type='button'>CANCEL</button>
									</td>
								</tr>
								</form>
							</table>
						</div>
					</div>
					<div>
						<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
							<div style="float:right;padding:2px">
								<button style='width:250px' id='btn_add_document' type='button'>Attach Dokumen Hasil & Lampiran</button>
							</div>        <div id="jqxgrid_document"></div>
						</div>
					</div>
                </div>
            </div>      
        </td>
    </tr>
    </table>
</div>
