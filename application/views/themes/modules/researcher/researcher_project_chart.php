<script type="text/javascript">


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
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id='jqxChart' style='width:100%; height:300px; position: relative; left: 0px; top: 0px;'></div>
    </div>