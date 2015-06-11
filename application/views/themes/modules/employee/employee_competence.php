<script>
	$(function(){
	   showGrid();
        
		$('#btn_add1').click(function () {
			add_competence('<?php echo $employee->id_employee ?>');
		});

	});

	function showGrid()
	{
		var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'id_employee', type: 'number' },
			{ name: 'mas_competence.name', type: 'string' },
			{ name: 'description', type: 'string' }
        ],
		url: "<?php echo base_url(); ?>idec/employee/competence?id=<?php echo md5($employee->id_employee) ?>",
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
				{ text: '#', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit_competence("+dataRecord.id_employee+","+dataRecord.id+");'></a> <a href='javascript:void(0)' onclick='del_competence("+dataRecord.id_employee+","+dataRecord.id+");'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif'></a></div>";
                 }
                },
				{ text: 'Competance Name', datafield: 'mas_competence.name', columntype: 'textbox', filtertype: 'textbox', width: '35%' },
				{ text: 'Description', datafield: 'description', columntype: 'textbox', filtertype: 'textbox', width: '60%' }
            ]
		});
	}

	function edit_competence(id_emp, id){
		$.get("<?php echo base_url();?>idec/competence/add/" + id_emp, 'id_comp='+id, function(response) {
			$("#popup_competence_content").html(response);
		});
		$("#popup_competence").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 350,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_competence").jqxWindow('open');
	}

	function add_competence(id){
		$.get("<?php echo base_url();?>idec/competence/add/" + id, function(response) {
			$("#popup_competence_content").html(response);
		});
		$("#popup_competence").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 350,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_competence").jqxWindow('open');
	}

	function del_competence(id_emp, id){
		var confirms = confirm("Delete Competence?");
		if(confirms == true){
			$.get('<?php echo site_url("idec/competence/delete/") ?>/' + id_emp + '/' + id, '', function(){
				alert('data deleted');

				$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
			});
		}
	}

</script>
<div id="popup_competence" style="display:none">
	<div id="popup_competence_title">Researcher Competence</div>
	<div id="popup_competence_content"></div>
</div>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div style="float:right;padding:2px">
			<input type="button" style='width:180px' id='btn_add1' value='ADD NEW'>
		</div>
        <div id="jqxgrid"></div>
	</div>
</div>