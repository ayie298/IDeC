<script>
	$(function(){
	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'id_employee', type: 'number' },
			{ name: 'education_degree', type: 'string' },
			{ name: 'institute', type: 'string' },
			{ name: 'major', type: 'string' },
			{ name: 'start_year', type: 'string' },
			{ name: 'end_year', type: 'string' }
        ],
		url: "<?php echo base_url(); ?>idec/employee/education?id=<?php echo md5($employee->id_employee) ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_education").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_education").jqxGrid('updatebounddata', 'sort');
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
     
		$("#jqxgrid_education").jqxGrid(
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
				    var dataRecord = $("#jqxgrid_education").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit_education("+dataRecord.id_employee+","+dataRecord.id+");'></a> <a href='javascript:void(0)'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='del_education("+dataRecord.id+");'></a></div>";
                 }
                },
				{ text: 'Degre', datafield: 'education_degree', columntype: 'textbox', filtertype: 'textbox', width: '20%' },
				{ text: 'Institute', datafield: 'institute', columntype: 'textbox', filtertype: 'textbox', width: '35%' },
				{ text: 'Major ', datafield: 'major', columntype: 'textbox', filtertype: 'textbox', width: '20%' },
				{ text: 'Start Year ', datafield: 'start_year', columntype: 'textbox', filtertype: 'textbox', width: '10%' },
				{ text: 'End Year ', datafield: 'end_year', columntype: 'textbox', filtertype: 'textbox', width: '10%' }
            ]
		});
        
		$('#btn_add4').click(function () {
			add_education('<?php echo $employee->id_employee ?>');
		});

	});

	function edit_education(id_emp,id){
		$.get("<?php echo site_url('idec/education/add');?>/" + id_emp, 'id_edu=' + id, function(response) {
			$("#popup_education_content").html(response);
		});
		$("#popup_education").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 350,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_education").jqxWindow('open');
	}

	function add_education(id){
		$.get("<?php echo site_url('idec/education/add');?>/" + id, function(response) {
			$("#popup_education_content").html(response);
		});
		$("#popup_education").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 350,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_education").jqxWindow('open');
	}

	function del_education(id){
		var confirms = confirm("Delete Education?");
		if(confirms == true){
			$.post('<?php echo site_url("idec/education/delete/") ?>', 'id='+id, function(){
				alert('data deleted');

				$("#jqxgrid_education").jqxGrid('updatebounddata', 'cells');
			});
		}
	}

</script>
<div id="popup_education" style="display:none">
	<div id="popup_education_title">Researcher Education</div>
	<div id="popup_education_content"></div>
</div>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div style="float:right;padding:2px">
			<input type="button" style='width:180px' id='btn_add4' value='ADD NEW'>
		</div>
        <div id="jqxgrid_education"></div>
	</div>
</div>