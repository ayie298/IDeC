<script>
	$(function(){
       $("#bar_profile").click();
	   $("#clearfilteringbutton, #refreshdatabutton,#btn_add,#btn_back").jqxButton({ height: 25, theme: theme });

	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'unit', type: 'string' },
			{ name: 'tgl', type: 'date' },
			{ name: 'status', type: 'string' }
        ],
		url: "<?php echo base_url(); ?>idec_pms/performance_list_json",
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
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: true, pagesizeoptions: ['10', '25', '50', '100', '200'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: '#', align: 'center', filtertype: 'none', sortable: false, width: '6%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'></a> <a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit("+dataRecord.id+");'></a> <a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='edit("+dataRecord.id+");'></a></div>";
                 }
                },
				{ text: 'Name', datafield: 'name', columntype: 'textbox', filtertype: 'textbox', width: '35%' },
				{ text: 'Performance For', datafield: 'unit', columntype: 'textbox', filtertype: 'textbox', width: '35%' },
				{ text: 'Date Added', datafield: 'tgl', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '12%'},
				{ text: 'Status', datafield: 'status', columntype: 'textbox', filtertype: 'textbox', width: '12%' }
            ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
		});

 		$('#btn_add').click(function () {
			window.location.href="<?php echo base_url();?>idec_pms/performance_new";
		});

 		$('#btn_back').click(function () {
			window.location.href="<?php echo base_url();?>idec_pms/performance";
		});

	});

	function edit(id){
		window.location.href="<?php echo base_url();?>idec_pms/performance_new";
	}

	function close_dialog(s){
		$("#popup").jqxWindow('close');
		if(s==1){
			$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
		}
	}
</script>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Performance List
	   </h3>
   </div>
</div>
<div id="popup" style="display:none"><div id="popup_title">Performance</div><div id="popup_content">{popup}</div></div>
<div>
	<div style="width:99%;background-color:#EEEEEE;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div>Filter:</div>
		<div style="float:left;position:relative;width:110px;padding-left:40px">
			Year : <select size="1" class="input" name="gendre" style="width:120px">
				<option>2014</option>
				<option>2013</option>
			</select>
		</div>
		<div style="float:left;position:relative;width:250px;padding-left:40px">
			<br>
			<input style="padding: 5px;" value=" Search " id="refreshdatabutton" type="button" />
			<input style="padding: 5px;" value=" Clear Filter " id="clearfilteringbutton" type="button" />
			<input style="padding: 5px;" value=" Refresh Data " id="refreshdatabutton" type="button" />
		</div>
		<div style="float:left;position:relative;width:250px;padding-left:40px">
			<br>
			<input style="padding: 5px;" value=" Add New Performance " id="btn_add" type="button" />
			<input style="padding: 5px;" value=" Back " id="btn_back" type="button" />
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id="jqxgrid"></div>
	</div>
	<br>
	<br>
	<br>
</div>