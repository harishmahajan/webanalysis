<div id="fb-root"></div>

<form id="getPdfForm" method="post" action="/reports/view/{$accountID}">
    <input type="hidden" id="pdf_date_from" name="report_date_from" value="">
    <input type="hidden" id="pdf_date_to" name="report_date_to" value="">
</form>

<div class="panel panel-default" style="margin-top:20px;">
    <div class="panel-heading">Facebook connection</div>
    <div class="panel-body">
        <p>

            <div id="facebook_connect">
                <div class="row">
                    <div class="col-xs-4">
                        <button id="fb_connect_link" class="btn btn-primary">Load data from Facebook</button>
                    </div>
                    <div class="col-xs-8 text-right strong">
                        <strong>
                        {if $oConnections.facebook}
                            Data loaded from {$oConnections.facebook->FromDate|date_format:"%D"} to {$oConnections.facebook->ToDate|date_format:"%D"}
                        {/if}
                        </strong>
                    </div>
                </div>
            </div>

            <div id="facebook_select_page" style="display: none">
                <div class="form-group">
                    {if $oConnections.facebook->ExternalConnectionID}
                        <div id="fb_external_pageid" style="display: none">{$oConnections.facebook->ExternalConnectionID}</div>
                    {/if}

                    <label for="fb_select_page">Select page:</label>
                    <select class="form-control" id="fb_select_page"></select>
                </div>
                <div class="form-group">
                    <label for="fb_date_from">Select data range:</label>
                    <div class="row">
                        <div class="col-xs-6">
                            <input class="form-control" type="text" id="fb_date_from" name="fb_date_from" value="{$fb_date_from}">
                        </div>
                        <div class="col-xs-6">
                            <input class="form-control" type="text" id="fb_date_to" name="fb_date_to" value="{$fb_date_to}">
                        </div>
                    </div>
                </div>

                <button id="fb_link_page" class="btn btn-primary">Load data</button>
                <input id="accountID" type="hidden" name="accountID" value="{$accountID}">
            </div>

            <div id="facebook_loading" style="display: none">
                <img src="/resources/img/loading.gif">
            </div>

            <div id="facebook_requesting" style="display: none">
                Requesting data from facebook:

                <div class="progress">
                    <div id="fb_progressbar" class="progress-bar" role="progressbar" style="width: 0%;"></div>
                </div>

            </div>


        </p>
    </div>
</div>
<div class="panel panel-default" style="margin-top:20px;">
    <div class="panel-heading">Twitter connection</div>
    <div class="panel-body">
        <p>
            <div id="twitter_connect">
                {if $oConnections.twitter->ExternalConnectionID}
                    <div class="col-xs-5">
                        Twitter live stream connected to: <b>@{$oConnections.twitter->Name}</b>
                        <div>
                            Connected starting from: {$oConnections.twitter->FromDate|date_format:"%D"}
                        </div>
                    </div>
                    <div class="col-xs-7 text-center">
                        <div class="well well-sm">
                            <div>
                                <strong>Import Twitter historical data</strong>
                            </div>
                            {if $import_msg}
                                <div style="color:red">
                                    <strong>{$import_msg}</strong>
                                </div>
                            {/if}
                            <form class="form-inline" role="form" method="post" action="/account/connections/{$accountID}" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="file" name="twitter_cvs" class="btn btn-default">
                                </div>
                                <input type="hidden" name="action" value="twitter_cvs">
                                <input type="submit" value="import" class="btn btn-primary" onclick='$("#tw_loading").show();$(this).hide();'>
                                <img style="display: none" id="tw_loading" src="/resources/img/loading.gif">
                            </form>
                        </div>
                    </div>
                {else}
                    <button id="tw_connect_link" class="btn btn-primary">Connect to Twitter live data stream</button>
                {/if}
            </div>
        </p>
    </div>
</div>


<script type="text/javascript">
<!--
var fb_app_id = '{$fb_app_id}';

{literal}
function dateConverter(timestamp)
{
    var date = new Date(timestamp * 1000),
        year = date.getFullYear(),
        month = date.getMonth(),
        day = date.getDate();

    month++;
    return year +'-'+ (month<10?'0':'') + month + '-' + (day<10?'0':'') + day;
}

var t = 0;
function fb_save(accountID, pageID, action, data, from, to){
    $.ajax({
        type: "POST",
        url: "/ajax/fb_datain",
        data: {
            accountID : accountID,
            pageID : pageID,
            action : action,
            from : dateConverter(from),
            to : dateConverter(to),
            data : data
        },
        dataType: 'text'
    });
};

var fb_req = {};
function fb_requesting_reset(){
    // update
    fb_req = {req:0,res:0};
    $("#fb_progressbar").css('width', "0%").text('0%');
};

var fb_cache;
var fb_data_cache = {};
$(function(){

    // download indicator
    $( document ).ajaxSend(function() {
        fb_req['req']++;
        //console.log('request send: '+fb_req['req']);
    });
    $( document ).ajaxComplete(function() {

        fb_req['res']++;
        var presentage = parseInt(fb_req['res'] * 100 / fb_req['req'],10);
        // update
        $("#fb_progressbar").css('width', presentage+'%').text(presentage+'%');

        // do not redirect
        /*
        if(fb_req['res'] == fb_req['req']){
            $("#pdf_date_from").val($("#fb_date_from").val());
            $("#pdf_date_to").val($("#fb_date_to").val());
            $("#getPdfForm").submit();
        }
        */

    });

    var fb_get_accounts = function(userID){

        FB.api(userID + "/accounts", function (response){

            var fb_select = $("#fb_select_page");
            var fb_external_pageid = $("#fb_external_pageid").text() || false;

            // flush the cache
            fb_cache = [];

            // clear the selectbox
            fb_select.find('option').remove();

            if(!fb_external_pageid)
            {
                fb_select.append('<option value="">Select page...</option>');
            }

            $.each(response.data, function() {
                if(fb_external_pageid)
                {
                    if(fb_external_pageid != this.id)
                        return;
                }
                fb_cache[this.id] = this.access_token;
                fb_select.append($("<option />").val(this.id).text(this.name));
            });

            $("#facebook_loading").hide();
            $("#facebook_select_page").show();

        });

    };

    // IN example: 2014-01-20T06:19:24+0000
    // OUT example: 2014-01-19
    var utc_datetime_to_pst_date = function(uts_datetime){
        var d = new Date(uts_datetime);
        var utc_time = d.getTime()/1000;

        var pst_time = ( utc_time - ( 8 * 60 * 60 ) );

        var d2 = new Date((pst_time*1000));
        return '' + d2.getUTCFullYear() + '-' + (d2.getUTCMonth()<9?'0':'') + (1+d2.getUTCMonth()) + '-' + (d2.getUTCDate()<10?'0':'') + d2.getUTCDate();
    }

    var fb_getUpdateData = function(accountID, pageID, accTok, from, to){

        //fb_requesting_new(4);
        FB.api('/' +pageID + '/insights', 'get', {
            fields: 'page_fan_adds',
            period: 'lifetime',
            since : from,
            until : to,
            access_token : accTok
        }, function (response) {

            // lets store the data
            if (response.error) {
      console.log('Error - ' + response.error.message);
      return
} 
            for (var j = 0, jlen = response.data.length; j < jlen; j++) {

                if (response.data[j].name == "page_fans") {

                    var data = {};
                    for (var i = 0, ilen = response.data[j].values.length; i < ilen; i++) {
                        if(response.data[j].values[i].value == 0) continue;

                        /*
                        var d = response.data[j].values[i].end_time.split("-");
                        data[d[0]+'-'+d[1]+'-'+d[2].substr(0,2)] = response.data[j].values[i].value || 0;
                        */
                        data[utc_datetime_to_pst_date(response.data[j].values[i].end_time)] = response.data[j].values[i].value || 0;

                    };
                    fb_save(accountID, pageID, 'page_fans',data, from, to);
                };

                if (response.data[j].name == "page_fans_city" || response.data[j].name == "page_fans_country" || response.data[j].name == "page_fans_gender_age") {

                    var data = {};
                    for (var i = 0, ilen = response.data[j].values.length; i < ilen; i++) {

                        /*
                        var d = response.data[j].values[i].end_time.split("-");
                        var dd = d[0]+'-'+d[1]+'-'+d[2].substr(0,2);
                        */
                        var dd = utc_datetime_to_pst_date(response.data[j].values[i].end_time);

                        if(response.data[j].values[i].value.length == 0) continue;

                        data[dd] = {};
                        for(var key in response.data[j].values[i].value){
                            data[dd][key] = response.data[j].values[i].value[key] || 0;
                        };

                    };
                    fb_save(accountID, pageID, response.data[j].name,data, from, to);
                };

            };

        });

        //fb_requesting_new(4);
        FB.api('/' +pageID + '/insights', 'get', {
            fields: 'page_fan_adds',
            period: 'day',
            since : from,
            until : to,
            access_token : accTok
        }, function (response) {

            // data to main table
            var udata = {};

            // lets store the data
            for (var j = 0, jlen = response.data.length; j < jlen; j++) {


                if (
                        response.data[j].name == "page_storytellers" ||
                        response.data[j].name == "page_impressions_unique" ||
                        response.data[j].name == "page_impressions" ||
                        response.data[j].name == "page_engaged_users" ||
                        response.data[j].name == "page_fans_online_per_day" ||
                        response.data[j].name == "page_impressions_paid" ||
                        response.data[j].name == "page_impressions_organic" ||
                        response.data[j].name == "page_fan_removes" ||
                        response.data[j].name == "page_fan_adds_unique" ||
                        response.data[j].name == "page_consumptions"
                ) {
                    udata[response.data[j].name] = {};

                    for (var i = 0, ilen = response.data[j].values.length; i < ilen; i++) {
                        /*
                        var d = response.data[j].values[i].end_time.split("-");
                        udata[response.data[j].name][d[0]+'-'+d[1]+'-'+d[2].substr(0,2)] = response.data[j].values[i].value || 0;
                        */
                        udata[response.data[j].name][utc_datetime_to_pst_date(response.data[j].values[i].end_time)] = response.data[j].values[i].value || 0;
                    };
                };

                if ( response.data[j].name == "page_positive_feedback_by_type" ){
                    udata['page_comment'] = {};
                    udata['page_like'] = {};
                    udata['page_link'] = {};

                    for (var i = 0, ilen = response.data[j].values.length; i < ilen; i++) {
                        /*
                        var d = response.data[j].values[i].end_time.split("-");
                        var dd = d[0]+'-'+d[1]+'-'+d[2].substr(0,2);
                        */
                        var dd = utc_datetime_to_pst_date(response.data[j].values[i].end_time);

                        udata['page_comment'][dd] = response.data[j].values[i].value.comment || 0;
                        udata['page_like'][dd] = response.data[j].values[i].value.like || 0;
                        udata['page_link'][dd] = response.data[j].values[i].value.link || 0;
                    };
                };

                if (response.data[j].name == "page_fans_by_like_source" || response.data[j].name == "page_storytellers_by_age_gender" || response.data[j].name == "page_views_external_referrals") {

                    var data = {};
                    for (var i = 0, ilen = response.data[j].values.length; i < ilen; i++) {
                        /*
                        var d = response.data[j].values[i].end_time.split("-");
                        var dd = d[0]+'-'+d[1]+'-'+d[2].substr(0,2);
                        */
                        var dd = utc_datetime_to_pst_date(response.data[j].values[i].end_time);

                        if(response.data[j].values[i].value.length == 0) continue;
                        data[dd] = {};

                        for(var key in response.data[j].values[i].value){
                            data[dd][key] = response.data[j].values[i].value[key] || 0;
                        };

                    };
                    fb_save(accountID, pageID, response.data[j].name,data, from, to);
                };

            };

            fb_save(accountID, pageID, 'DataFb',udata, from, to);

        });

        FB.api('/' +pageID + '/posts', 'get', {
            period: 'day',
            since : from,
            until : to,
            access_token : accTok
        }, function (response) {

            $(response.data).each(function (index, element){

                if (element.message == undefined){
                    element.message = element.story || element.description;
                }

                //fb_requesting_new(1);
                FB.api('/' +element.id + '/insights', 'get', {
                    access_token : accTok
                }, function (response) {

                    var dataset = {};
                    dataset['id'] = element.id;
                    /*
                    dataset['day'] = element.created_time.substr(0, 10);
                    */
                    dataset['day'] = utc_datetime_to_pst_date(element.created_time);
                    dataset['link'] = element.link;
                    dataset['message'] = element.message.substr(0, 50);

                    $(response.data).each(function (index, elementIn) {

                        if( elementIn.name == "post_story_adds" ||
                            elementIn.name == "post_consumptions" ||
                            elementIn.name == "post_impressions_unique" ||
                            elementIn.name == "post_impressions_fan_unique" ||
                            elementIn.name == "post_impressions" ||
                            elementIn.name == "post_impressions_viral_unique" ||
                            elementIn.name == "post_engaged_users" ||
                            elementIn.name == "post_stories_by_action_type"
                        ){
                            dataset[elementIn.name] = elementIn.values[0].value;
                        }

                        // last element just to save values
                        if (elementIn.name == "post_stories_by_action_type") {
                            fb_save(accountID, pageID, 'DataFb_Posts',dataset, from, to);
                        }

                    });


                });

            });

        });

    };

    $("#fb_link_page").click(function(){

        var tFrom = $("#fb_date_from").val().toString("MM.dd.yyyy")+ " 00:00:00";
alert(toTimestamp(tFrom));
//alert (Date.parse(tFrom).getTime()/1000);
        var from = ($.datepicker.formatDate('@', $.datepicker.parseDate('mm/dd/yy',$("#fb_date_from").val()))/1000);
        var to = ($.datepicker.formatDate('@', $.datepicker.parseDate('mm/dd/yy',$("#fb_date_to").val()))/1000);

        alert ("first "+from+" "+to);
        // deduct 1 day at from
        from -= ( 60 * 60 * 24 );

        // lets add 23:59:59
        to += (( 60 * 60 * 24 ) - 1);
alert ("2 "+from+" "+to);
        
       /* $("#facebook_select_page").hide();
        $("#facebook_requesting").show();
        fb_requesting_reset();

        var pageID = $("#fb_select_page").val();
        var accountID = $("#accountID").val();
        var accTok = fb_cache[pageID];

        // sent short access token to server, so ve can request long access topen and store it to db :)
        $.ajax({
            type: "POST",
            url: "/ajax/fb_short_token",
            data: {
                accountID : accountID,
                pageID : pageID,
                accTok : accTok
            },
            dataType: 'text'
        });

        var tendays = ( 10 * 60 * 60 * 24 );
        // if more than 10 days - split to chunks
        var _to = to, _from = to;
        do
        {
            _to = _from;
            _from -= tendays;

            // on last iteration, period may be smaller
            if(_from < from) _from = from;

            // and action
            fb_getUpdateData(accountID, pageID, accTok, _from, _to);
        }
        while( (_to - tendays)  > from );*/

    });

    $("#fb_connect_link").click(function(){

        $("#facebook_connect").hide();
        $("#facebook_loading").show();

        FB.init({
            appId : fb_app_id,
            status : false,
            cookie : true,
            xfbml : true
        });

        FB.login(function (response) {
            if (response.authResponse) {
                fb_get_accounts(response.authResponse.userID);
            }
        }, { scope: 'manage_pages,read_insights' });

    });

    $("#tw_connect_link").click(function(){
        window.open("/twitter/connect", "Secure Login", "location=1, status=1, scrollbars=1, width=800, height=455");
    });

});

// lets load the facebook js
(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$(function() {
    $( "#fb_date_from" ).datepicker({
        changeMonth: true,
        onClose: function( selectedDate ) {
            $( "#fb_date_to" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fb_date_to" ).datepicker({
        changeMonth: true,
        onClose: function( selectedDate ) {
            $( "#fb_date_from" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
});

// -->
</script>
{/literal}