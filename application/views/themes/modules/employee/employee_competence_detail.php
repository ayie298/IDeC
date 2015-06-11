<script>
	$(function(){
	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'id_employee', type: 'number' },
			{ name: 'name', type: 'string' },
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
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, 
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: false, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: 'Competance Name', datafield: 'name', columntype: 'textbox', filtertype: 'textbox', width: '35%' },
				{ text: 'Description', datafield: 'description', columntype: 'textbox', filtertype: 'textbox', width: '60%' }
            ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
		});

	});

	function edit(id){
		document.location.href="<?php echo base_url();?>idec_rms/researcher_detail";
	}

</script>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id="jqxgrid"></div>
	</div>
</div>