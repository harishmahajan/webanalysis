var page = require('webpage').create();
var args = require('system').args;

var _t = args[1];
var _w = args[2];
var _h = args[3];
var _o = args[4];
var _d = args[5];

if(args[6])
{
    console.log(_d);
    phantom.exit();
}

page.onLoadFinished = function(){
    page.paperSize = { width: _w+'px', height: _h+'px', border: '0px'};
    page.clipRect = { top: 0, left: 0, width: _w, height: _h };

    var base64 = page.renderBase64('PNG');
    console.log(base64);
    phantom.exit();
};

// build the content
var content = '';
content += '<html><head><script type="text/javascript" src="https://www.google.com/jsapi"></script><script type="text/javascript">';
content += 'google.load("visualization", "1", {packages:["corechart"]});';
content += 'google.setOnLoadCallback(drawChart);';
content += 'function drawChart() {';
content += 'var data = google.visualization.arrayToDataTable('+_d+');';
content += 'var options = {		
				'+_o+'
			};';
content += 'var chart = new google.visualization.'+_t+'(document.getElementById("chart_div"));';
content += 'chart.draw(data, options);';
content += '}';
content += '</script></head><body style="margin: 0px;padding:0px"><div id="chart_div" style="width: '+_w+'px; height: '+_h+'px;"></div></body></html>';
page.content = content;