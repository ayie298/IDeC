<script>
	$(function(){
       $("#bar_rms").click();

	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'nama', type: 'string' },
			{ name: 'type', type: 'string' },
			{ name: 'category', type: 'string' },
			{ name: 'organizer', type: 'string' },
			{ name: 'expired', type: 'date' }
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
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false,
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: false, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: 'Name', datafield: 'nama', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Category', datafield: 'category', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Type ', datafield: 'type', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Date ', datafield: 'expired', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '10%' },
				{ text: 'Organizer ', datafield: 'organizer', columntype: 'textbox', filtertype: 'textbox', width: '20%' }
            ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid_training").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid_training").jqxGrid('updatebounddata', 'cells');
		});

	});

	function edit(id){
		document.location.href="<?php echo base_url();?>idec_rms/researcher_detail";
	}

</script>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id="jqxgrid_training"></div>
	</div>
</div>