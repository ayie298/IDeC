<script>
	$(function(){
	   <?php if($this->session->userdata('level')!="researcher"){?>
		   $("#btn_add6").jqxButton({ height: 28, theme: theme });
	   <?php }?>

	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'name', type: 'string' },
			{ name: 'org_name', type: 'string' },
			{ name: 'status', type: 'string' },
			{ name: 'percent_progress', type: 'string' },
			{ name: 'position', type: 'string' },
			{ name: 'start_date', type: 'date' },
			{ name: 'end_date', type: 'date' }
        ],
		url: "<?php echo site_url('researcher/detail/project_json/'); ?>/<?php echo $id_employee ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_project").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_project").jqxGrid('updatebounddata', 'sort');
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
     
		$("#jqxgrid_project").jqxGrid(
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
				<?php if($this->session->userdata('level')!="researcher"){?>{ text: '#', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_project").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_view.gif' onclick='edit_project("+dataRecord.id+");'></a> <a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='delproject("+dataRecord.id+");'></a></div>";
                 }
                },<?php }else{ ?>
				{ text: '#', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_project").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_view.gif' onclick='edit_project("+dataRecord.id+");'></a></div>";
                 }
                },<?php } ?>
				{ text: 'Name', datafield: 'name', columntype: 'textbox', filtertype: 'textbox', width: '18%' },
				{ text: 'Unit', datafield: 'org_name', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Date Start', datafield: 'start_date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '10%' },
				{ text: 'Date End', datafield: 'end_date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '10%' },
				{ text: 'Status', datafield: 'status', columntype: 'textbox', filtertype: 'textbox', width: '10%' },
				{ text: 'Progress', datafield: 'percent_progress', columntype: 'textbox', filtertype: 'textbox', width: '10%' },
				{ text: 'Position', datafield: 'position', columntype: 'textbox', filtertype: 'textbox', width: '12%' }
            ]
		});
        
		$('#btn_add6').click(function () {
			var offset = $("#jqxgrid").offset();
			$.get("<?php echo base_url();?>idec_rms/researcher_add_project/", function(response) {
				$("#popupproject_content").html(response);
			});
			$("#popupproject").jqxWindow({
				theme: theme, resizable: false,
				width: 600,
				height: 420,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popupproject").jqxWindow('open');
		});

	});

	function edit_project(id){
		document.location.href="<?php echo base_url();?>idec_rms/project_detail";
	}

	function delproject(id){
		confirm("Delete Project");
	}

	$(function(){
		// prepare chart data
            var data = <?php echo $json_project ?>;

            var toolTipCustomFormatFn = function (value, itemIndex, serie, group, categoryValue, categoryAxis) {
                var dataItem = data[itemIndex];
                return '<DIV style="text-align:left"><b>Project: ' + categoryValue + 
                        '</b><br />Bulan Mulai: ' +  value.from + 
                        '<br />Bulan Selesai: ' + value.to;
            };

            // prepare jqxChart settings
            var settings = {
                title: "Timeline Researcher per Project",
                description: "Tahun 2015",
                enableAnimations: true,
                showLegend: false,
                padding: { left: 15, top: 15, right: 20, bottom: 15 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: data,
                categoryAxis:
                    {
                        text: 'Category Axis',
                        dataField: 'Project',
                        showTickMarks: true,
                        tickMarksInterval: 1,
                        tickMarksColor: '#888888',
                        unitInterval: 1,
                        showGridLines: true
                    },
                colorScheme: 'scheme03',
                seriesGroups:
                    [
                        {
                            orientation: 'horizontal',
                            type: 'rangecolumn',
                            columnsGapPercent: 100,
                            toolTipFormatFunction: toolTipCustomFormatFn,
                            valueAxis:
                            {
                                flip: true,
                                unitInterval: 1,
                                displayValueAxis: true,
                                description: 'Bulan',
                                axisSize: 'auto',
                                tickMarksColor: '#888888',
                                minValue: 1,
                                maxValue: 12
                            },
                            series: [
                                    { dataFieldFrom: 'M1_From', dataFieldTo: 'M1_To', displayText: 'Project Timeline', opacity: 1 }
                                ]
                        }

                    ]
            };

            // setup the chart
            $('#jqxChart').jqxChart(settings);
	});
</script>
<div id="popupproject" style="display:none">
	<div id="popupproject_title">Researcher Project</div>
	<div id="popupproject_content"></div>
</div>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div id='jqxChart' style='width:100%; height:300px; position: relative; left: 0px; top: 0px;'></div>
	</div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<?php if($this->session->userdata('level')!="researcher"){?><div style="float:right;padding:2px">
			<button id='btn_add6' type='button'>ADD PROJECT</button>
		</div><?php }?>
        <div id="jqxgrid_project"></div>
	</div>
</div>