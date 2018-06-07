<div id="chart_div"></div>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {ldelim}packages:["corechart"]{rdelim});
google.setOnLoadCallback(drawChart);
function drawChart() {ldelim}

    var data = google.visualization.arrayToDataTable({$args._d});

    var options = {$args._o};
    var chart = new google.visualization.{$args._t}(document.getElementById("chart_div"));
     google.visualization.events.addListener(chart, 'ready', function () {
        document.write('<img src="' +  chart.getImageURI() + '">');
      });
    chart.draw(data, options);
{rdelim}



</script>

