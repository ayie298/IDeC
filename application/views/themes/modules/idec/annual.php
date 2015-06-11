<script>
	$(function(){
       $("#bar_general").click();

	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'thn', type: 'number' },
			{ name: 'url', type: 'string' },
			{ name: 'jml', type: 'number' },
			{ name: 'keterangan', type: 'string' }
        ],
		url: "<?php echo site_url('idec/annual/json'); ?>",
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
			showfilterrow: false, filterable: false, sortable: true, autoheight: true, pageable: false, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: 'Tahun', datafield: 'thn', columntype: 'textbox', filtertype: 'textbox', width: '20%' },
				{ text: 'Jumlah', datafield: 'jml', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Deskripsi', datafield: 'keterangan', columntype: 'textbox', filtertype: 'textbox', width: '58%' },
				{ text: 'View', width: '7%', align: 'center', filtertype: 'none', sortable: false, cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='gourl(\""+dataRecord.url+"\");'></a> </div>";
                 }
				}
            ]
		});
        
	});

	function gourl(url){
		window.location.href="<?php echo base_url();?>"+url;
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
		 Annual Data
	   </h3>
   </div>
</div>
<div id="popup" style="display:none"><div id="popup_title">Annual Data</div><div id="popup_content">{popup}</div></div>
<div>
	<div style="width:50%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id="jqxgrid"></div>
	</div>
	<br>
	<br>
	<br>
</div>