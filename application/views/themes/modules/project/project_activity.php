<script>
	$(function(){
		$("#jqxgrid_activity").jqxGrid('updatebounddata', 'cells');
	   $("#btn_add3").jqxButton({ height: 28, theme: theme });
	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'id_encrypt', type: 'string' },
			{ name: 'step_name', type: 'string' },
			{ name: 'nik', type: 'string' },
			{ name: 'emp.name', type: 'string' },
			{ name: 'activity_detail', type: 'string' },
			{ name: 'location', type: 'string' },
			{ name: 'status', type: 'string' },
			{ name: 'activity_start_date', type: 'date' },
			{ name: 'activity_end_date', type: 'date' },
			{ name: 'is_lock', type: 'bolean' }
        ],
		url: "<?php echo site_url('project/activity/activity_json/' . $id_project); ?>",
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
			selectionmode: 'singlerow',
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100', '200'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: '#', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_activity").jqxGrid('getrowdata', row);
					if(dataRecord.is_lock == false){
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit_activity("+dataRecord.id+");'></a> <a href='javascript:void(0)'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='return del("+dataRecord.id+")'></a></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><img border=0 src='<?php echo base_url(); ?>media/images/16_lock.gif'></div>";
					}
                 }
                },
				{ text: 'NIK', datafield: 'nik', columntype: 'textbox', filtertype: 'textbox', width: '7%' },
				{ text: 'Name', datafield: 'emp.name', columntype: 'textbox', filtertype: 'textbox', width: '18%' },
				{ text: 'Step', datafield: 'step_name', columntype: 'textbox', filtertype: 'textbox', width: '10%' },
				{ text: 'Date Start', datafield: 'activity_start_date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '9%' },
				{ text: 'Date End', datafield: 'activity_end_date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '9%' },
				{ text: 'Location', datafield: 'location', columntype: 'textbox', filtertype: 'textbox', width: '12%' },
				{ text: 'Description', datafield: 'activity_detail', columntype: 'textbox', filtertype: 'textbox', width: '20%' },
				{ text: 'Status', datafield: 'status', columntype: 'textbox', filtertype: 'textbox', width: '10%' }
            ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid_activity").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid_activity").jqxGrid('updatebounddata', 'cells');
		});

		$('#btn_add3').click(function () {
			add_activity(<?php echo $id_project ?>);
		});

	});

	function add_activity(id){
		$("#popupactivity_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		var offset = $("#jqxgrid").offset();
		$.post("<?php echo site_url('project/activity/add/');?>", 'id_project=' + id, function(response) {
			$("#popupactivity_content").html(response);
		});
		$("#popupactivity").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 420,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popupactivity").jqxWindow('open');
	}

	function edit_activity(id){
		$("#popupactivity_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		var offset = $("#jqxgrid").offset();
		$.post("<?php echo site_url('project/activity/add/');?>", 'id_act='+id+'&id_project=<?php echo $id_project ?>', function(response) {
			$("#popupactivity_content").html(response);
		});
		$("#popupactivity").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 420,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popupactivity").jqxWindow('open');
	}

	function del() {
		var confirms = confirm("Delete Activity?");
		if(confirms == true){
			$.post('<?php echo site_url("project/activity/delete") ?>', 'id=' + id, function(){
				alert('data berhasil dihapus');

				$("#jqxgrid_activity").jqxGrid('updatebounddata', 'cells');
			});
		}
	}


</script>
<div id="popupactivity" style="display:none">
	<div id="popupactivity_title">Project Activity</div><div id="popupactivity_content">{popup}</div>
</div>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div style="float:right;padding:2px">
			<button style='width:200px' id='btn_add3' type='button'>ADD NEW</button>
		</div>
        <div id="jqxgrid_activity"></div>
	</div>
</div>