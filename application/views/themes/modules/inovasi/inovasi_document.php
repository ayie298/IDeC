<script>
	$(function(){
 	   $("#btn_add_document,#btn_add,#btn_cancel").jqxButton({ height: 28, theme: theme });
       $("#tanggal1,#tanggal2").jqxDateTimeInput({ width: '140px', height: '30px', formatString: 'yyyy-MM-dd', theme: theme});
	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'deskripsi', type: 'string' },
			{ name: 'tgl', type: 'date' }
        ],
		url: "<?php echo base_url(); ?>inovasi/inovasi_internal/document_json",
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
				<?php if($this->session->userdata('level')!="researcher"){?>{ text: '#', align: 'center', filtertype: 'none', sortable: false, width: '10%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_document").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit_document("+dataRecord.id+");'></a> <a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='edit("+dataRecord.id+");'></a></div>";
                 }
                },<?php }?>
				{ text: 'Deskripsi', datafield: 'deskripsi', columntype: 'textbox', filtertype: 'textbox', width: '47%' },
				{ text: 'Received Date ', datafield: 'tgl', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '28%'},
				{ text: 'File', filtertype: 'none', sortable: false, width: '15%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_document").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/download.gif'></a></div>";
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
			edit_document(1);
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
			height: 250,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_document").jqxWindow('open');
	}

</script>
<div id="popup_document" style="display:none">
	<div id="popup_title">Document</div>
	<div id="popup_content">
    	<table class='tbl-form'>
			<tr>
				<td colspan="3" style="font-size:16px;font-weight:bold">Add / Edit Document</td>
			</tr>
			<tr>
				<td width='18%'>Deskripsi</td>
				<td width='1%'>:</td>
				<td class="white"><input type="text" size="40" name="Deskripsi" id="Deskripsi" placeholder="Deskripsi" style="margin: 0;height: 30px;"/></td>
			</tr>
			<tr>
				<td width='18%'>Recieved Date</td>
				<td width='1%'>:</td>
				<td class="white"><div id='tanggal1'></div></td>
			</tr>
			<tr>
				<td width='18%'>File Upload</td>
				<td width='1%'>:</td>
				<td class="white"><input type="file" style="margin: 0;height: 30px;"/></td>
			</tr>
			<tr id="td_proses" height="30">
				<td colspan="3" align="right">
					<button style='width:120px' id='btn_add' onClick='close_document()' type='button'><i class='icon-save'></i> ADD</button>
					<button style='width:120px' id='btn_cancel' onClick='close_document()' type='button'><i class='icon-ban-circle'></i> CANCEL</button>
				</td>
			</tr>
		</table>
	</div>
</div>
<div>
    <div class="div-grid">
		<?php if($this->session->userdata('level')!="researcher"){?>
		<div style="float:right;padding:5px">
			<button style='width:150px' id='btn_add_document' type='button'><i class='icon-upload'></i> ATTACH FILE</button>
		</div>
		<?php }?>
        <div id="jqxgrid_document"></div>
	</div>
</div>