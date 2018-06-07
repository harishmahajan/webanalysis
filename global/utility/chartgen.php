<?php
	parse_str(implode('&', array_slice($argv, 1)), $_GET);
	$content = '';
    $content += '<html><head><script type="text/javascript" src="https://www.google.com/jsapi"></script><script type="text/javascript">';
    $content += 'google.load("visualization", "1", {packages:["corechart"]});';
    $content += 'google.setOnLoadCallback(drawChart);';
    $content += 'function drawChart() {';
    $content += 'var data = google.visualization.arrayToDataTable(json_encode('$_GET["_d"]'));';
    $content += 'var options = json_encode('$_GET["_o"]');';
    $content += 'var chart = new google.visualization.'$_GET["_t"]'(document.getElementById("chart_div"));';
    $content += 'google.visualization.events.addListener(chart, "ready", function () {';
    $content += 'chart_div.innerHTML = chart.getImageURI();});';
    $content += 'chart.draw(data, options);';
    $content += '}';
    $content += '</script></head><body style="margin: 0px;padding:0px"><div id="chart_div" style="width: 500px; height: 500px;"></div></body></html>';
    
    $DOM = new DOMDocument;
    $DOM->loadHTML($content);
    echo $DOM->saveHTML();
?>