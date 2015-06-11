<script type="text/javascript" src="<?php echo base_url();?>plugins/js/jquery/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>plugins/js/jquery/jquery.sparkline.min.js"></script>
<script>
	$(function(){
       $("#bar_pms").click();
        
        showGrid();

        $('#btn_filter').click(function() {
	   		$.ajax({
	   			url : "<?php echo site_url('review');?>",
	   			type : "POST",
	   			data : $('form').serialize(),
	   			success : function() {
	   				showGrid();
	   			}
	   		})

	   		return false;
	   })

		$('#btn_view').click(function () {
			$.get("<?php echo base_url();?>idec_pms/review_popup/", function(response) {
				$("#popup_content").html(response);
			});
			$("#popup").jqxWindow({
				theme: theme, resizable: false,
				width: 600,
				height: 420,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popup").jqxWindow('open');
		});

	});

	function closepopup(){
			$("#popup").jqxWindow('close');
	}

	function detail(id){
		document.location.href="<?php echo site_url('review/detail/');?>/" + id;
	}

	function showGrid()
	{
		var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number'},
			{ name: 'id_encrypt', type: 'string'},
			{ name: 'org_name', type: 'string'},
			{ name: 'bagian', type: 'string'},
			{ name: 'review', type: 'string'},
			{ name: 'date', type: 'date'},
			{ name: 'program.name', type: 'string'}
        ],
		url: "<?php echo site_url('review/home/json'); ?>",
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
				{ text: 'Show', align: 'center', filtertype: 'none', sortable: false, width: '4%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_view.gif' onclick='detail(\""+dataRecord.id_encrypt+"\");'></a></div>";
                 }
                },
				{ text: 'Program Name', datafield: 'program.name', columntype: 'textbox', filtertype: 'textbox', width: '35%' },
				{ text: 'Unit', datafield: 'org_name', columntype: 'textbox', filtertype: 'textbox', width: '20%' },
				{ text: 'Bagian / Lab', datafield: 'bagian', columntype: 'textbox', filtertype: 'textbox', width: '20%' },
				{ text: 'Review', datafield: 'review', columntype: 'textbox', filtertype: 'textbox', width: '12%' },
				{ text: 'Last Update', datafield: 'date', columntype: 'date', sortable:false, filtertype: 'date', cellsformat: 'yyyy-MM-dd', width: '9%'}
            ]
		});
	}

</script>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Review Management
	   </h3>
   </div>
</div>
<div id="popup" style="display:none"><div id="popup_title">Review Management</div><div id="popup_content">{popup}</div></div>
<div>
	<div style="width:99%;background-color:#EEEEEE;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div style="float:right;position:relative;width:600px;padding-right:10px;height:50px;text-align:right">
			<?php echo form_open() ?>
			<select size="1" class="input" name="year" style="width:150px;margin-top:10px;">
				<?php for($i=date('Y');$i>date('Y')-5;$i--) : ?>
				<option value="<?php echo $i ?>"><?php echo $i ?></option>
				<?php endfor; ?>
			</select>
			<button id='btn_filter' type='button'>FIlter</button>
			<!--<button id='btn_view' type='button'>SET PROGRAM VIEW</button>-->
			</form>
		</div>
		<div style="float:left;position:relative;width:550px;padding:5px;">
			<div style="font-size:20px">Review Management IDeC Tahun 2014</div>
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id="jqxgrid"></div>
	</div>
	<br>
	<br>
	<br>
</div>
<br>
