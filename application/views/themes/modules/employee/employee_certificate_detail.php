<script>
	$(function(){
       $("#bar_rms").click();

	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'cer_name', type: 'string' },
			{ name: 'certificate.name', type: 'string' },
			{ name: 'organizer', type: 'string' },
			{ name: 'is_down', type: 'boolean' },
			{ name: 'file_upload', type: 'string' },
			{ name: 'expired_date', type: 'date' }
        ],
		url: "<?php echo base_url(); ?>idec/employee/certificate?id=<?php echo md5($employee->id_employee) ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_certificate").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_certificate").jqxGrid('updatebounddata', 'sort');
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
     
		$("#jqxgrid_certificate").jqxGrid(
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
				{ text: 'Name', datafield: 'cer_name', columntype: 'textbox', filtertype: 'textbox', width: '28%' },
				{ text: 'Category', datafield: 'certificate.name', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Organizer ', datafield: 'organizer', columntype: 'textbox', filtertype: 'textbox', width: '22%' },
				{ text: 'Expired Date ', datafield: 'expired_date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '10%' },
				{ text: 'Download ',  filtertype: 'none', sortable: false, width: '10%' , cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_certificate").jqxGrid('getrowdata', row);
				    if(dataRecord.is_down) {
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/download.gif' onclick='edit("+dataRecord.id+");'></a></div>";
					}
                 }
                }
            ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid_certificate").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid_certificate").jqxGrid('updatebounddata', 'cells');
		});

	});

	function edit(id){
		document.location.href="<?php echo base_url();?>idec_rms/researcher_detail";
	}

</script>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id="jqxgrid_certificate"></div>
	</div>
</div>