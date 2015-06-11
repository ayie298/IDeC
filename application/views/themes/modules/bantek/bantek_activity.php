<script>
	$(function(){
 	   $("#btn_add_activity,#btn_add_act,#btn_cancel_act").jqxButton({ height: 28, theme: theme });
	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'program', type: 'string' },
			{ name: 'sow', type: 'string' },
			{ name: 'deliverables', type: 'string' },
			{ name: 'progress', type: 'string' },
			{ name: 'waktu', type: 'string' },
			{ name: 'pic_idec', type: 'string' },
			{ name: 'pic_netbro', type: 'string' }
        ],
		url: "<?php echo base_url(); ?>idec_rms/bantek_activity_json",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_activity").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_activity").jqxGrid('updatebounddata', 'sort');
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
     
		$("#jqxgrid_activity").jqxGrid(
		{		
			width: '100%',
			selectionmode: 'singlerow',autorowheight: true,
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, 
			showfilterrow: false, filterable: false, sortable: true, autoheight: true, pageable: false, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: 'Evaluasi', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_activity").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit_activity("+dataRecord.id+");'></a></div>";
                 }
                },
				{ text: 'Del', align: 'center', filtertype: 'none', sortable: false, width: '4%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_activity").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='edit_activity("+dataRecord.id+");'></a></div>";
                 }
                },
				{ text: 'Download', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_activity").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/download.gif'></a></div>";
                 }
                },
				{ text: 'Program', datafield: 'program', columntype: 'textbox', filtertype: 'textbox', width: '17%' },
				{ text: 'SoW', datafield: 'sow', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Deliverables', datafield: 'deliverables', columntype: 'textbox', filtertype: 'textbox', width: '18%' },
				{ text: 'Waktu', datafield: 'waktu', columntype: 'textbox', filtertype: 'textbox', width: '8%' },
				{ text: 'PIC IDeC', datafield: 'pic_idec', columntype: 'textbox', filtertype: 'textbox', width: '11%' },
				{ text: 'PIC User', datafield: 'pic_netbro', columntype: 'textbox', filtertype: 'textbox', width: '11%' },
				{ text: 'Realisasi', datafield: 'progress', columntype: 'textbox', filtertype: 'textbox', width: '6%' }
           ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid_activity").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid_activity").jqxGrid('updatebounddata', 'cells');
		});

 		$('#btn_add_activity').click(function () {
			edit_activity(1);
		});

	});

	function close_activity(){
		$("#popup_activity").jqxWindow('close');
	}

	function edit_activity(id){
		var offset = $("#jqxgrid").offset();
		$("#popup_activity").jqxWindow({
			theme: theme, resizable: false,
			width: 550,
			height: 550,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_activity").jqxWindow('open');
	}

</script>
<div id="popup_activity" style="display:none">
	<div id="popup_title">Program</div>
	<div id="popup_content">
			<table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);font-size:12px">
			<tr>
				<td colspan="3" style="font-size:16px;font-weight:bold">Add / Edit Program</td>
			</tr>
			<tr>
				<td width='25%'>Program </td>
				<td width='1%'>:</td>
				<td class="white">
					<input type="text" name="Activity" id="Activity" placeholder="Activity" style="margin: 0;height: 30px;width:350px"/> 
				</td>
			</tr>
			<tr>
				<td width='25%'>SoW</td>
				<td width='1%'>:</td>
				<td class="white">
					<textarea name="SoW" placeholder="SoW" style="margin: 0;height:100px;width:350px"/> </textarea>
				</td>
			</tr>
			<tr>
				<td width='25%'>Deliverables</td>
				<td width='1%'>:</td>
				<td class="white">
					<textarea name="Deliverables" placeholder="Deliverables" style="margin: 0;height:100px;width:350px"/> </textarea>
				</td>
			</tr>
			<tr>
				<td width='25%'>Waktu</td>
				<td width='1%'>:</td>
				<td class="white">
					<input type="text" name="Waktu" id="Waktu" placeholder="Waktu" style="margin: 0;height: 30px;width:300px"/> 
				</td>
			</tr>
			<tr>
				<td width='25%'>PIC IDeC</td>
				<td width='1%'>:</td>
				<td class="white">
					<input type="text" name="PIC IDeC" id="PIC IDeC" placeholder="PIC IDeC" style="margin: 0;height: 30px;width:300px"/> 
				</td>
			</tr>
			<tr>
				<td width='25%'>PIC User</td>
				<td width='1%'>:</td>
				<td class="white">
					<input type="text" name="PIC User" id="PIC User" placeholder="PIC User" style="margin: 0;height: 30px;width:300px"/> 
				</td>
			</tr>
			<tr>
				<td width='25%'>File Upload</td>
				<td width='1%'>:</td>
				<td class="white"><input type="file"/></td>
			</tr>
			<tr>
				<td width='25%'>Realisasi</td>
				<td width='1%'>:</td>
				<td class="white">
					<input type="text" name="Realisasi" id="Realisasi" placeholder="% Realisasi" style="margin: 0;height: 30px;width:100px"/> 
				</td>
			</tr>
			<tr id="td_proses" height="30">
				<td colspan="3" align="right">
					<button style='width:120px' id='btn_add_act' onClick='close_activity()' type='button'>ADD</button>
					<button style='width:120px' id='btn_cancel_act' onClick='close_activity()' type='button'>CANCEL</button>
				</td>
			</tr>
		</table>
	</div>
</div>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<?php if($this->session->userdata('level')!="researcher"){?><div style="float:right;padding:2px">
			<button style='width:250px' id='btn_add_activity' type='button'>Add Program </button>
		</div><?php }?>
        <div id="jqxgrid_activity"></div>
	</div>
</div>