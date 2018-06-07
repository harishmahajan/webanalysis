<div id="chart_div_{$args.unique_id}" style="width: {$args._w}px;height: {$args._h}px;"></div>

<script type="text/javascript">
function drawChart_{$args.unique_id}(i) {ldelim}
    var data = google.visualization.arrayToDataTable({$args._d});
    var options = {$args._o};
    var chart = new google.visualization.{$args._t}(document.getElementById("chart_div_{$args.unique_id}"));
    chart.draw(data, options);
{rdelim};
google.load("visualization", "1", {ldelim}packages:["corechart"]{rdelim});
google.setOnLoadCallback(drawChart_{$args.unique_id});

var res_{$args.unique_id};
$( window ).resize(function() {ldelim}
    if (res_{$args.unique_id}){ldelim} clearTimeout(res_{$args.unique_id}); {rdelim};
    res_{$args.unique_id} = setTimeout(function(){ldelim} drawChart_{$args.unique_id}(1); {rdelim},100);
{rdelim});

</script>

