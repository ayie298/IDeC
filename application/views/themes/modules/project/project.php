<script>
	$(function(){
       $("#bar_rms").click();
	   $("#clearfilteringbutton, #refreshdatabutton,#btn_add,#btn_report,#btn_print,#btn_excel,#btn_import").jqxButton({ height: 28, theme: theme });

	   showGrid();
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$.ajax({
				url : "<?php echo site_url('researcher/project/project_json'); ?>",
				data : $('form').serialize(),
				type : 'post',
				success : function() {
					showGrid();
				}
			});

			return false;
		});

 		$('#btn_add').click(function () {
			edit("");
		});

		$('#btn_report').click(function () {
			$("#popup").jqxWindow({
				theme: theme, resizable: false,
				width: 600,
				height: 350,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popup").jqxWindow('open');
		});
        
		$('#btn_import').click(function () {
			$.get("<?php echo base_url();?>idec_rms/project_import/", function(response) {
				$("#popupimport_content").html(response);
			});
			$("#popupimport").jqxWindow({
				theme: theme, resizable: false,
				width: 600,
				height: 350,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popupimport").jqxWindow('open');
		});

        
	});

	function edit(id){
		window.location.href="<?php echo site_url('researcher/project/update/');?>/" + id;
	}

	function detail(id){
		window.location.href="<?php echo site_url('researcher/project/detail/');?>/" + id;
	}

	function close_import(){
		$("#popupimport").jqxWindow('close');
	}

	function close_dialog(s){
		$("#popup").jqxWindow('close');
		if(s==1){
			$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
		}
	}

	function showGrid()
	{
		var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'id_encrypt', type: 'string' },
			{ name: 'name', type: 'string' },
			{ name: 'org_name', type: 'string' },
			{ name: 'start_date', type: 'date' },
			{ name: 'end_date', type: 'date' },
			{ name: 'status', type: 'string' },
			{ name: 'weight', type: 'number' },
			{ name: 'team', type: 'number' }
        ],
		url: "<?php echo site_url('researcher/project/project_json'); ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			
			},
		filter: function(){
			$("#jqxgrid").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid").jqxGrid('updatebounddata', 'sort');
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
     
		$("#jqxgrid").jqxGrid(
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
				{ text: '#', align: 'center', filtertype: 'none', sortable: false, width: '6%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					<?php if($this->session->userdata('level')!="researcher"){?>
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_view.gif' onclick='detail(\""+dataRecord.id_encrypt+"\");'></a> <a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit(\""+dataRecord.id_encrypt+"\");'></a> <a href='<?php echo site_url('researcher/project/delete/') ?>/"+dataRecord.id_encrypt+"'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='return confirm(\"Delete Project ?\")'></a></div>";
					<?php }else{ ?>
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_view.gif' onclick='detail(\""+dataRecord.id_encrypt+"\");'></a> </div>";
					<?php }?>
                 }
                },
				{ text: 'Name', datafield: 'name', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Unit', datafield: 'org_name', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Start Date', datafield: 'start_date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy-MM-dd', width: '10%'},
				{ text: 'End Date', datafield: 'end_date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy-MM-dd', width: '10%'},
				{ text: 'Status', datafield: 'status', columntype: 'textbox', filtertype: 'textbox', width: '10%' },
				{ text: 'Weight', datafield: 'weight', columntype: 'textbox', filtertype: 'textbox', width: '6%' },
				{ text: 'Team', datafield: 'team', columntype: 'textbox', datasort:false, filtertype: 'textbox', width: '8%' }
            ]
		});
	}
</script>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Project List
	   </h3>
   </div>
</div>
<div id="popupimport" style="display:none">
	<!--<div id="popupimport_title">Import Excel Data</div><div id="popupimport_content">{popup}</div>-->
</div>
<div id="popup" style="display:none">
	<div id="popup_title">Generate Report</div>
	<div id="popup_content">
		<div style="padding:4px;height:30px;margin-top:10px">
			Triwulan <select size="1" class="input" name="gendre" style="margin-top:8px;width:150px">
				<option>TW I - March</option>
				<option>TW II - June</option>
				<option>TW III - Sepetember</option>
				<option>TW IV - Desember</option>
			</select>
		</div>
		<div style="padding:4px;height:40px;">
			Chose Type <select size="1" class="input" name="gendre" style="margin-top:8px;width:150px">
				<option>Summary</option>
				<option>Detail</option>
				<option>Complete</option>
			</select>
		</div>
		<div style="padding:4px;">
			Select Project
			<br>
			<table cellpadding="4" cellspacing="2" width="80%" style="font-size:12px;border:1px solid #CCC;color:#000">
				<tr style="background:#DDD;">
					<td width="10%" align="center">#</td>
					<td>Project</td>
				</tr>
				<tr>
					<td align="center"><input type="checkbox"></td>
					<td>Radio 2.0</td>
				</tr>
				<tr>
					<td align="center"><input type="checkbox"></td>
					<td>Integrated Smart Home Box</td>
				</tr>
				<tr>
					<td align="center"><input type="checkbox"></td>
					<td>Smart Building</td>
				</tr>
				<tr>
					<td align="center"><input type="checkbox"></td>
					<td>U Point Phase 2</td>
				</tr>
			</table>
			<div style="clear:both;"></div>
		</div>
		<div style="padding:4px;height:40px;margin-top:10px">
			<input style="padding: 5px;width:100px" value=" PRINT" id="btn_print" type="button" />
			<input style="padding: 5px;width:100px" value=" EXCEL " id="btn_excel" type="button" />
		</div>
	</div>
</div>
<div>
	<div style="width:99%;background-color:#EEEEEE;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<?php echo form_open() ?>
		<div>Filter:</div>
		<div style="float:left;position:relative;width:110px;padding-left:40px">
			Year : <select size="1" class="input" name="year" style="width:120px">
			<option value="<?php echo date('Y') ?>">Choose year</option>
				<?php for($i=date('Y');$i>=date('Y')-10;$i--) : ?>
					<option value="<?php echo $i ?>"><?php echo $i ?></option>
				<?php endfor; ?>
			</select>
		</div>
		<div style="float:left;position:relative;width:350px;padding-left:20px">
			<br>
			<input style="padding: 5px;" value=" Search " name="search" id="refreshdatabutton" type="submit" />
			<input style="padding: 5px;" value=" Clear Filter " id="clearfilteringbutton" type="button" />
			<input style="padding: 5px;" value=" Refresh Data " id="refreshdatabutton" type="button" />
		</div>
		<div style="float:right;position:relative;width:450px;">
			<br>
			<?php if($this->session->userdata('level')!="researcher"){?>
			<!--<input style="padding: 5px;width:150px" value=" Import Excel Data" id="btn_import" type="button" />-->
			<input style="padding: 5px;" value=" Add New Project " id="btn_add" type="button" /><?php }?>
			<!--<input style="padding: 5px;width:150px" value=" Generate Report" id="btn_report" type="button" />-->
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id="jqxgrid"></div>
	</div>
	</form>
	<br>
	<br>
	<br>
</div>