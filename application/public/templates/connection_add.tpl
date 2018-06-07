<!--
code :
-->
<input id="FaccountID" type="hidden" name="accountID" value="{$accountID}">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true" style="min-height:100%!important;">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header" id="POPheader">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <div class="row">
              <div class="col-xs-8"> 
                <h4>
                  Manage Connections Accoount<br>
                  <small>Connect your 3rd party social accoount to Webanalysis.co</small>
                </h4>
              </div>
              <!-- <div class="col-xs-4">
                <a class="btn btn-default" href="#" id="btnAddCon">+ Add Connection</a>
              </div> -->
            </div>            
         </div>
         <!--Error msg div-->
            <div class="alert alert-danger" style="display: none" id="ErrDiv">
               <a href="#" class="close" onclick="$('#ErrDiv').hide()">
                  &times;
               </a>
               <strong>Error!</strong> <lable id="Errolab"></lable>
            </div>
            <div class="clearfix"></div>
        <!--Error msg div-->
         <!-- facebook start -->
          <div class="modal-body col-xs-12"> 
            <div class="myContener">
              <div class="row">
                 <!--Profile Slection table for Facebook-->
                <div style="overflow:auto" id="FBScroll"><!--scroll table div-->
                  <div class="col-md-12" id="page" style="display: none">                
                    <div id="pageselect" class="">                  
                      <table id="tab" class="table table-striped">
                        
                      </table>
                    </div>
                    <div class="clearfix"></div>                
                  </div>
                </div>
                  <!--profile sclection Table end-->
                <div class="col-xs-12 divBG" id="FBbtn">
                  <br>                 
                  <!--facebook button -->
                  <div class="row">
                    <div id="btndivfb" class="col-xs-10">
                      <button id="fb_connect_Add" class="btn btn-primary btn-block">Connect To Facebook</button>
                    </div> 
                    <div id="btnTogfb" class="col-xs-2">
                      <button type="button" id="togFb" onclick="togDiv('fb')" class="btn btn-link">Hide</button>
                    </div>                   
                  </div>
                  <!--facebook button end-->
                  <br>
                </div>
              </div>
            </div>
            <!-- facebook end -->
            <br>
            <!-- twitter start -->
            <div class="myContener">
              <div class="row">
                <!--Profile Slection table for Twitter-->
                <div class="col-xs-12" id="pageTwitter" style="display: none">                
                  <div id="TwProfSelect" class="">                  
                    <table id="tabTW" class="table table-striped">
                      
                    </table>
                  </div>
                  <div class="clearfix"></div>                
                </div>
                <!--profile sclection Table end-->
                <div class="col-xs-12 divBG" id="Tweetbtn">
                  <br>
                  <div class="row">
                    <div id="btndivtw" class="col-xs-10">
                      <button id="tw_connect_Add" class="btn btn-info btn-block">Connect To Twitter</button>
                    </div>
                    <div id="btnTogtw" class="col-xs-2">
                      <button type="button" id="togtw" onclick="togDiv('tw')" class="btn btn-link">Hide</button>
                    </div> 
                  </div>
                  <br>
                </div>
              </div>
            </div>
            <!-- twitter end -->
            <br>
            <!--Pinterest start-->
            <div class="myContener">
              <div class="row">
                <!--Profile Slection table for Pinterest-->
                <div style="overflow:auto" id="pinScroll"><!--scroll table div-->
                <div class="col-xs-12" id="pagePinterest" style="display: none">              
                  <div id="TwProfSelect" class="">                  
                    <table id="tabTW" class="table table-striped">                     
                      <thead><tr><th>Selection</th><th>Page ID</th><th>Facebook Page</th></tr></thead>
                      <tbody>
                        <tr>
                          <td><input type="radio" value="396851690465381" name="pageid"></td>
                          <td>396851690465381</td>
                          <td>Sach</td>
                        </tr>
                        <tr>
                          <td><input type="radio" value="1496477167293681" name="pageid"></td><td>1496477167293681</td>
                          <td>TestPage</td>
                        </tr>
                        <tr>
                          <td><input type="radio" value="1496477167293681" name="pageid"></td><td>1496477167293681</td>
                          <td>TestPage</td>
                        </tr>
                        <tr>
                          <td><input type="radio" value="1496477167293681" name="pageid"></td><td>1496477167293681</td>
                          <td>TestPage</td>
                        </tr>
                        <!-- <tr>
                          <td><input type="radio" value="1496477167293681" name="pageid"></td><td>1496477167293681</td>
                          <td>TestPage</td>
                        </tr>
                        <tr>
                          <td><input type="radio" value="1496477167293681" name="pageid"></td><td>1496477167293681</td>
                          <td>TestPage</td>
                        </tr>
                        <tr>
                          <td><input type="radio" value="1496477167293681" name="pageid"></td><td>1496477167293681</td>
                          <td>TestPage</td>
                        </tr> -->
                      </tbody>
                    </table>
                  </div>
                  <div class="clearfix"></div>                
                </div>
              </div>
                <!--profile sclection Table end-->
                <div class="col-xs-12 divBG" id="Pinbtn">
                  <br>
                  <div class="row">
                    <div id="btndivpi" class="col-xs-10">
                      <button id="pi_connect_Add" class="btn btn-danger btn-block">Connect To Pinterest</button>
                    </div>
                    <div id="btnTogpi" class="col-xs-2">
                      <button type="button" id="togpi" onclick="togDiv('pi')" class="btn btn-link">Hide</button>
                    </div> 
                  </div>
                  <br>
                </div>
              </div>
            </div>
            <!--Pinterest end-->
            <br>
            <!--Instagram end-->
            <div class="myContener">
              <div class="row">
                <div class="col-xs-12 divBG" id="Instbtn">
                  <br>
                  <div class="row">
                    <div id="btndivin" class="col-xs-10">
                      <button id="in_connect_Add" class="btn btn-block inst" ><font color="white">Connect To Instagram</font></button>
                    </div>
                    <div id="btnTogin" class="col-xs-2">
                      <button type="button" id="togin" onclick="togDiv('in')" class="btn btn-link">Hide</button>
                    </div> 
                  </div>
                  <br>
                </div>
              </div>
            </div>
            <!--Instagram end-->
            <div class="clearfix"></div>
            <div class="myContener">
              <div class="row">
                <div class="col-xs-12" id="">
                  <br>
                  <div class="row">
                    <button type="button" style="" class="btn btn-info pull-right" id="profileadd">Select Profile</button>
                  </div>
                  <br>
                </div>
              </div>
            </div>
          </div>    
         <div>
          &nbsp;
         </div>
      </div><!-- /.modal-content -->
</div><!-- /.modal -->
<form id="backToaccount" method="post" action="/account/importpage/{$accountID}">    
</form>
<input type="hidden" id="txtval" name="txtval" value="0"/ >
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript">
$(".modal-body").resize(function(){
    $('#myModal').css({ "min-height":"100%!important"});
  });
///////////////////////////////////////
//select profile button codeing start//
//////////////////////////////////////
var FBClicked=TWClicked=false;
var fb_cache,InsValid,SuccValidFB,SuccValidTW;
var pageID,TwProfid;
var TwUserID=TwScreenName=TwOauth_token=TwOauth_token_secret=0;
var accountID = $("#FaccountID").val();
$.ajaxSetup({ cache: false });
function ErrMsgSet(Errstr)
{
    $("#Errolab").empty();
    $("#Errolab").text(Errstr);
    $('#ErrDiv').show().delay(5000).fadeOut('slow');
}
$("#profileadd").on('click', function (){
        if(FBClicked==true)
        {
            var accTok = fb_cache[pageID];             
            pageID = $('input[name="pageid"]:checked').val();
            if(pageID === undefined || fb_cache[pageID] === undefined || accountID=="")
            {
              //$('#ErrDiv').show();
              ErrMsgSet("Select Your Profile");
            }
            else
            {             
              // insert record in connection table.
              $.ajax({
                  cache: false,
                  type: "POST",
                  url: "/ajax/fb_con_insert",
                  data: {
                      accountID : accountID,
                      pageID : pageID,
                      accTok : fb_cache[pageID]
                  },
                  dataType: 'text',
                  success:function(resultFB){

                      if(resultFB=="false")
                      {
                        ErrMsgSet("Selected Facebook Page Already Exists");
                        SuccValidFB=false;
                      }  
                      else
                      {              
                      SuccValidFB=true;             
                    }
                  }//suecss
              });//fb_con_insert
              //
            }
        }
        else
        {
            SuccValidFB=true;
        }

        if(TWClicked==true)      
        {
            TwProfid = $('input[name="TwProfID"]:checked').val();
            if(TwProfid === undefined)
            {
              //$('#ErrDiv').show();          
              ErrMsgSet("Select Your Profile");
            }
            else
            {             
              // insert record in connection table.             
              $.ajax({
                  cache: false,
                  type: "POST",
                  url: "/twitterpop/TwConInsert",
                  data: {
                      TwAccountID : accountID,
                      TwUserID : TwUserID,
                      TwScreenName : TwScreenName,
                      TwOauth_token : TwOauth_token,
                      TwOauth_token_secret : TwOauth_token_secret
                  },
                  dataType: 'text',
                  success:function(result){
                    if(result=="false")
                    {
                      ErrMsgSet("Selected Twitter Account Already Exists");
                      SuccValidTW=false;
                    }
                    else
                    {
                     SuccValidTW=true;
                   }
                  }//suecss
              });//$.ajax
              
            }
        }
        else
        {
          SuccValidTW=true;
        }

        var ReTimer = setInterval(function() { 
            clearInterval(ReTimer); 
            if(FBClicked==true && TWClicked==true)
            {
                if(SuccValidTW==true || SuccValidFB== true)
                {
                  //alert("redirected btn 2");
                  $("#backToaccount").submit();
                }
            }
            else
            {
              console.log(TWClicked);
              console.log(TwProfid);
              console.log(SuccValidTW);
                if(FBClicked==true && pageID !== undefined && SuccValidFB== true)
                {                  
                  //alert("redirected btn fb");
                  $("#backToaccount").submit();
                }
                else if(TWClicked==true && TwProfid !== undefined && SuccValidTW==true)
                {
                  $("#backToaccount").submit();
                  //alert("redirected btn tw");
                }
            }  
    
        }, 2000);

       
      /*if(SuccValidTW==true && SuccValidFB== true && (FBClicked==true || TWClicked==true))
      {
        alert("redirected");
      }*/

      
      
    });//on click

///////////////////////////////////////
//select profile button codeing End  //
//////////////////////////////////////




function togDiv(ac){
  
  $( "#btndiv"+ac ).toggle( "slow" );
 
}



    $(window).load(function(){
        $('#myModal').modal('show');
    }); 

    var fb_app_id = '{$fb_app_id}';

//////////////////////////
//facebook codeing start//
//////////////////////////  

  $("#fb_connect_Add").click(function(){

      /*  $("#facebook_connect").hide();
        $("#facebook_loading").show();*/

        FB.init({
            appId : '483975525054185',
            status : false,
            cookie : true,
            xfbml : true
        });

        FB.login(function (response) {
            if (response.authResponse) {              
              fb_get_accounts(response.authResponse.userID);
            }
        }, { 
            scope: 'manage_pages,read_insights' 
        });

    });

var fb_get_accounts = function(userID){
        FB.api(userID + "/accounts", function (response){
          if(response.data>=0)
           console.log("not ok");
         else
         {
              // flush the cache
              fb_cache = [];
              $("#FBbtn").hide();
              FBClicked=true;
              $('#tab').append("<thead><tr><th>Selection</th><th>Page ID</th><th>Facebook Page</th></tr></thead>");   
              $('#tab').append('<tbody>');
                $.each(response.data, function() {
                fb_cache[this.id] = this.access_token;
                $('#tab').append("<tr><td><input type='radio' value="+ this.id+" name='pageid'></td><td>"+this.id+"</td><td>"+this.name+"</td></tr>");
            }); 
            $('#tab').append("</tbody>");            
            $("#page").show();
          }  

         //  else
         // {
         //      // flush the cache
         //      fb_cache = [];
         //      $("#FBbtn").hide();
         //      FBClicked=true;
         //      $('#tab').append("<thead><tr><th>Selection</th><th>Page ID</th><th>Facebook Page</th></tr></thead>");   
         //      $('#tab').append("<tbody>");
         //        $.each(response.data, function() {
         //        fb_cache[this.id] = this.access_token;
         //        console.log("not ok");
         //        $('#tab').append("<tr><td><input type='radio' value="+ this.id+" name='pageid'></td><td>"+this.id+"</td><td>"+this.name+"</td></tr>");
         //    }); 
         //    $('#tab').append("</tbody>");
         //    $("#page").show();
         //  }                      
        });

    };// var fb_get_accounts = function(userID)

//////////////////////////
//facebook codeing end  //
//////////////////////////


//////////////////////////
//twitter codeing start //
//////////////////////////

var win;
var TwUserData;
$("#tw_connect_Add").click(function(){
      console.log("in Popup wondow");
      var win = window.open("/twitterpop/Twitterpopup1", "Secure Login", "location=1, status=1, scrollbars=1, width=800, height=455");

       var timer = setInterval(function() {   
    if(win.closed) {  
        clearInterval(timer); 
        $.ajax({
            cache: false,
              type: "POST",
              url: "/account/tstSes/",              
              dataType: 'json',
              success:function(result){ 
              if(result!=null )
              {
                TWClicked=true;
                TwUserID=result.user_id;
                TwScreenName=result.screen_name;
                TwOauth_token=result.oauth_token;
                TwOauth_token_secret=result.oauth_token_secret;
                if(TwUserID!==undefined){
                $("#Tweetbtn").hide();
                $('#tabTW').append("<thead><tr><th>Selection</th><th>ID</th><th>Twitter Profile</th></tr></thead>");   
                $('#tabTW').append("<tbody>");
                $('#tabTW').append("<tr><td><input type='radio' value="+ result.user_id+" name='TwProfID'></td><td>"+result.user_id+"</td><td>"+result.screen_name+"</td></tr>");              
                $('#tabTW').append("</tbody>");
                $("#pageTwitter").show();
                if($("#FBScroll").height()>250)
                {
                    $('#FBScroll').css({ "height":"250px"});
                }
              }
               
              }                           
        }//suecss
          });//fb_con_insert
    }  
}, 1000); 
        /*win.onunload = function() {
          if(win.closed)
          {

          alert("hi");
             
            }
        }*/
});//$("#tw_connect_Add")
  

//////////////////////////
//twitter codeing end   //
//////////////////////////

////////////////////////////
//Pinterest codeing start//
//////////////////////////

$("#pi_connect_Add").click(function(){
  /*$("#Pinbtn").hide();
  if($("#pinScroll").height()>250)
  {
      $('#pinScroll').css({ "height":"250px"});
  }
  //alert($("#pinScroll").height());
  $("#pagePinterest").show();*/
});

////////////////////////////
//Pinterest codeing start//
//////////////////////////

  $(function () { $('#myModal').on('hide.bs.modal', function () {
       window.location="/account/connections/{$accountID}";
  })
 });//$(function () { $('#myModal').on

</script>