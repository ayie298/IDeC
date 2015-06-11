<script>
	$(function(){
	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'id_emp', type: 'number' },
			{ name: 'id_encrypt', type: 'string' },
			{ name: 'training.name', type: 'string' },
			{ name: 'type.type', type: 'string' },
			{ name: 'category', type: 'string' },
			{ name: 'organizer', type: 'string' },
			{ name: 'start_time', type: 'date' }
        ],
		url: "<?php echo base_url(); ?>idec/employee/training?id=<?php echo md5($employee->id_employee) ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_training").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_training").jqxGrid('updatebounddata', 'sort');
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
     
		$("#jqxgrid_training").jqxGrid(
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
				    var dataRecord = $("#jqxgrid_training").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit_training("+dataRecord.id_emp+","+dataRecord.id+");'></a> <a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='del_training("+dataRecord.id+");'></a></div>";
                 }
                },
				{ text: 'Name', datafield: 'training.name', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Category', datafield: 'category', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Type ', datafield: 'type.type', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Date ', datafield: 'start_time', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '10%' },
				{ text: 'Organizer ', datafield: 'organizer', columntype: 'textbox', filtertype: 'textbox', width: '20%' }
            ]
		});
        
		$('#btn_add3').click(function () {
			add_training('<?php echo $employee->id_employee ?>');
		});

	});

	function edit_training(id_emp, id){
		$.get("<?php echo site_url('idec/training/add');?>/" + id_emp, 'id_train=' + id, function(response) {
			$("#popup_training_content").html(response);
		});
		$("#popup_training").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 350,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_training").jqxWindow('open');
	}

	function add_training(id){
		$.get("<?php echo site_url('idec/training/add/');?>/" + id, function(response) {
			$("#popup_training_content").html(response);
		});
		$("#popup_training").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 350,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_training").jqxWindow('open');
	}

	function del_training(id){
		var confirms = confirm("Delete Training?");
		if(confirms == true){
			$.post('<?php echo site_url("idec/training/delete/") ?>', 'id='+id, function(){
				alert('data deleted');

				$("#jqxgrid_training").jqxGrid('updatebounddata', 'cells');
			});
		}
	}

</script>
<div id="popup_training" style="display:none">
	<div id="popup_training_title">Researcher Training</div>
	<div id="popup_training_content"></div>
</div>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div style="float:right;padding:2px">
			<input type="button" style='width:180px' id='btn_add3' value='ADD NEW'>
		</div>
        <div id="jqxgrid_training"></div>
	</div>
</div>