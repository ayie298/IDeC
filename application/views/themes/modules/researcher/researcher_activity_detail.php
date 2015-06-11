<script>
	$(function(){
	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'step_name', type: 'string' },
			{ name: 'pr.name', type: 'string' },
			{ name: 'activity_detail', type: 'string' },
			{ name: 'step.weight', type: 'number' },
			{ name: 'pr.percent_progress', type: 'string' },
			{ name: 'position', type: 'string' },
			{ name: 'status', type: 'string' },
			{ name: 'activity_start_date', type: 'date' },
			{ name: 'activity_end_date', type: 'date' }
        ],
		url: "<?php echo site_url('researcher/project_member/ongoing_json/' . $id_employee . '/' . $id_status) ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_activity2").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_activity2").jqxGrid('updatebounddata', 'sort');
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
     
		$("#jqxgrid_activity2").jqxGrid(
		{		
			width: '100%',
			selectionmode: 'singlerow',
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100', '200'],
			showfilterrow: false, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: 'Project', datafield: 'pr.name', columntype: 'textbox', filtertype: 'textbox', width: '24%' },
				{ text: 'Step', datafield: 'step_name', columntype: 'textbox', filtertype: 'textbox', width: '18%' },
				{ text: 'Date Start', datafield: 'activity_start_date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '12%' },
				{ text: 'Date End', datafield: 'activity_end_date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '12%' },
				{ text: 'Position', datafield: 'position', columntype: 'textbox', filtertype: 'textbox', width: '11%' },
				{ text: 'Bobot', datafield: 'step.weight', columntype: 'textbox', filtertype: 'textbox', width: '6%' },
				{ text: 'Progress', datafield: 'pr.percent_progress', columntype: 'textbox', filtertype: 'textbox', width: '8%' },
				{ text: 'Status', datafield: 'status', columntype: 'textbox', filtertype: 'textbox', width: '9%' }
            ]
		});
        
	});




	$(function(){
		// prepare chart data
            var data = <?php echo $json_project ?>

            var toolTipCustomFormatFn = function (value, itemIndex, serie, group, categoryValue, categoryAxis) {
                var dataItem = data[itemIndex];
                return '<DIV style="text-align:left"><b>Project: ' + categoryValue + 
                        '</b><br />Bulan Mulai: ' +  value.from + 
                        '<br />Bulan Selesai: ' + value.to;
            };

            // prepare jqxChart settings
            var settings = {
                title: "Timeline Researcher per Project",
                description: "Tahun <?php echo date('Y') ?>",
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
<div id="popupactivity" style="display:none">
	<div id="popupactivity_title">Researcher Activity</div>
	<div id="popupactivity_content"></div>
</div>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div id='jqxChart' style='width:100%; height:300px; position: relative; left: 0px; top: 0px;'></div>
	</div>
</div>	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id="jqxgrid_activity2"></div>
	</div>
</div>