<script>
	$(function(){
 	   $("#btn_add_document,#btn_add,#btn_cancel").jqxButton({ height: 28, theme: theme });
       $("#tanggal1,#tanggal2,#tanggal3").jqxDateTimeInput({ width: '140px', height: '30px', formatString: 'yyyy-MM-dd', theme: theme});
       <?php if($title != 'Add') : ?>
	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'tipe', type: 'string' },
			{ name: 'files', type: 'string' }
        ],
		url: "<?php echo base_url(); ?>partnership/partnership_action/partnership_document_json",
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
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, 
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: false, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: '#', align: 'center', filtertype: 'none', sortable: false, width: '10%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_document").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit_document("+dataRecord.id+");'></a> <a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='edit_document("+dataRecord.id+");'></a></div>";
                 }
                },
				{ text: 'Document Type', datafield: 'tipe', columntype: 'textbox', filtertype: 'textbox', width: '40%' },
				{ text: 'Document', datafield: 'files', columntype: 'textbox', filtertype: 'textbox', width: '40%' },
				{ text: 'File', filtertype: 'none', sortable: false, width: '10%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_document").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/download.gif'></a></div>";
                 }
				}
           ]
		});
		<?php endif ?>
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid_document").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid_document").jqxGrid('updatebounddata', 'cells');
		});

 		$('#btn_add_document').click(function () {
			edit_document(1);
		});

		$('#tanggal1').on('valueChanged', function (event) 
		{  
    		var jsDate = $('#tanggal1').val();

    		$('#tanggal1_input').val(jsDate);
		});

		$('#tanggal2').on('valueChanged', function (event) 
		{  
    		var jsDate = $('#tanggal2').val();

    		$('#tanggal2_input').val(jsDate);
		});

		$('#tanggal3').on('valueChanged', function (event) 
		{  
    		var jsDate = $('#tanggal3').val();

    		$('#tanggal3_input').val(jsDate);
		});

		$('#budget').keyup(function(){
			$('#budget_input').val($(this).val());
		})

	});

	function close_document(){
		$("#popup_document").jqxWindow('close');
	}

	function edit_document(id){
		var offset = $("#jqxgrid").offset();
		$("#popup_document").jqxWindow({
			theme: theme, resizable: false,
			width: 550,
			height: 200,
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
			<tr>
				<td width='25%'>Document Type</td>
				<td width='1%'>:</td>
				<td class="white">
					<select size="1" class="input" name="Program" id="Program" style="width: 300px;margin: 0;">
						<option>-</option>
						<option>PKS</option>
						<option>Justifikasi</option>
						<option>Lampiran</option>
					</select>
				</td>
			</tr>
			<tr>
				<td width='25%'>File Upload</td>
				<td width='1%'>:</td>
				<td class="white"><input type="file" style="margin: 0;height: 30px;"/></td>
			</tr>
			<tr id="td_proses" height="30">
				<td colspan="3" align="right">
					<button style='width:120px' id='btn_add' onClick='close_document()' type='button'>ADD</button>
					<button style='width:120px' id='btn_cancel' onClick='close_document()' type='button'>CANCEL</button>
				</td>
			</tr>
		</table>
	</div>
</div>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
			<table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);font-size:12px">
				<td width='18%'>Budget</td>
				<td width='1%'>:</td>
				<td class="white">Rp. 
					<input type="text" size="10" name="budget" id="budget" placeholder="000" value="<?=$budget;?>" style="margin: 0;height: 30px;"/>
				</td>
				<td width='18%'>Start Date</td>
				<td width='1%'>:</td>
				<td class="white"><div id='tanggal1' name="tanggal1" value="<?=$tanggal1;?>"></div></td>
			</tr>
			<tr>
				<td width='18%'>Signature Date PKS</td>
				<td width='1%'>:</td>
				<td class="white"><div id='tanggal3' name="tanggal3" value="<?=$tanggal3;?>"></div></td>
				<td width='18%'>End Date</td>
				<td width='1%'>:</td>
				<td class="white"><div id='tanggal2' name="tanggal2" value="<?=$tanggal2;?>"></div></td>
			</tr>
		</table>
		<?php if($title != 'Add') : ?>
		<?php if($this->session->userdata('level')!="researcher"){?><div style="float:right;padding:2px">
			<button style='width:150px' id='btn_add_document' type='button'>ATTACH FILE</button>
		</div><?php }?>
        <div id="jqxgrid_document"></div>
    	<?php endif; ?>
	</div>
</div>