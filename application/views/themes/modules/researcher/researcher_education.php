<script>
	$(function(){
       $("#bar_rms").click();

	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'degre', type: 'string' },
			{ name: 'institution', type: 'string' },
			{ name: 'major', type: 'string' },
			{ name: 'start', type: 'number' },
			{ name: 'end', type: 'number' }
        ],
		url: "<?php echo base_url(); ?>idec_rms/researcher_education_json",
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
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit("+dataRecord.id+");'></a> <a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='edit("+dataRecord.id+");'></a></div>";
                 }
                },
				{ text: 'Degre', datafield: 'degre', columntype: 'textbox', filtertype: 'textbox', width: '20%' },
				{ text: 'Institute', datafield: 'institution', columntype: 'textbox', filtertype: 'textbox', width: '35%' },
				{ text: 'Major ', datafield: 'major', columntype: 'textbox', filtertype: 'textbox', width: '20%' },
				{ text: 'Start Year ', datafield: 'start', columntype: 'textbox', filtertype: 'textbox', width: '10%' },
				{ text: 'End Year ', datafield: 'end', columntype: 'textbox', filtertype: 'textbox', width: '10%' }
            ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid_education").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid_education").jqxGrid('updatebounddata', 'cells');
		});

	});

	function edit(id){
		document.location.href="<?php echo base_url();?>idec_rms/researcher_detail";
	}

</script>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div style="float:right;padding:2px">
			<button class='btn' id='btn_add4' type='button'>ADD NEW</button>
		</div>
        <div id="jqxgrid_education"></div>
	</div>
</div>