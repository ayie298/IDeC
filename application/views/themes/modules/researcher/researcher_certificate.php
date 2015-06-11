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
			{ name: 'category', type: 'string' },
			{ name: 'organizer', type: 'string' },
			{ name: 'expired', type: 'date' }
        ],
		url: "<?php echo base_url(); ?>idec_rms/researcher_certificate_json",
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
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100', '200'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: '#', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_certificate").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit("+dataRecord.id+");'></a> <a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='edit("+dataRecord.id+");'></a></div>";
                 }
                },
				{ text: 'Name', datafield: 'nama', columntype: 'textbox', filtertype: 'textbox', width: '28%' },
				{ text: 'Category', datafield: 'category', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Organizer ', datafield: 'organizer', columntype: 'textbox', filtertype: 'textbox', width: '22%' },
				{ text: 'Expired Date ', datafield: 'expired', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '10%' },
				{ text: 'Download ',  filtertype: 'none', sortable: false, width: '10%' , cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_certificate").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/download.gif' onclick='edit("+dataRecord.id+");'></a></div>";
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
		<div style="float:right;padding:2px">
			<button class='btn' id='btn_add2' type='button'>ADD NEW</button>
		</div>
        <div id="jqxgrid_certificate"></div>
	</div>
</div>