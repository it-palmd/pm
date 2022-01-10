<?php
session_start();
// echo $_SESSION["user"];
if(!isset($_SESSION["pm_user"]))
{
 header('location:../webapp/login/login.php');
}
// date_default_timezone_set('Asia/Bangkok');

$page = $_SESSION['pm_ses_page'];
$u_level = $_SESSION["pm_level"];

date_default_timezone_set('Asia/Bangkok');

?>

<!doctype html>
<html lang="en">
  <head>
    <title>PDS PM Systems :: ระบบซ่อมบำรุง บริษัท ปาล์มดีศรีนคร จำกัด</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="dist/for_report/css/daterangepicker.css" />


    <script src="dist/jquery2.2.0/jquery.min.js" type="text/javascript" ></script>
    <script src="dist/bootstrap.min.js" type="text/javascript" ></script>

    <script src="dist/for_report/js/jquery.dataTables.js" type="text/javascript" ></script>
    <script src="dist/for_report/js/dataTables.bootstrap.js" type="text/javascript" ></script>
    <script src="dist/for_report/js/moment.min.js" type="text/javascript" ></script>
    <script src="dist/for_report/js/daterangepicker.min.js" type="text/javascript" ></script>
    <script type="text/javascript" src="dist/for_report/js/graph/jquery.canvasjs.min.js"></script>



    <style type="text/css" media="all">

/* For Print */
      @media print {

        body{ background: #ffffff!important;}
        .print_panel { width: 100%!important; margin:-10px auto!important; }

        .control_nav, #control_event { display: none!important; }
        #header_print { display: block!important; }
        #test_report { margin:20px auto 0px!important; width: 99%!important; }

      }

      @page { size: landscape; }

/* End for Print */

      body{ background: #ffffff!important;}
      .print_panel { width: 80%; margin:25px auto; }

      /* #control_container { display: none!important; } */
      #chartKPI_ALL { width: 30%; }
      #dep_total_persen, #month_total_persen { font-size: 80px; padding: 20px 0; }
      /* #chartKPI_SPLINE { width: 100%;"} */
      select { width:250px!important; }


      @media screen and (min-width: 900px) {
        #dep_total_persen, #month_total_persen { font-size: 50px; padding: 20px 0; }
      }

      @media screen and (max-width: 769px) {

        #chartKPI_ALL { width: 100%; }
        #chartKPI_SPLINE { width: 100%;}
        #test_report, #btn_print { display: none; }
        #dep_total_persen, #month_total_persen { font-size: 40px!important; padding: 20px 0; }
        select { width: 100%!important; }
        .print_panel { width: 100%; }
        .col-sm-3, .col-md-3, .col-sm-6, .col-md-6, .col-sm-12, .col-md-12 { font-size: 60%; padding: 0px; }

      }

      #control_container_nav ,#control_container {
        display: flex;
        align-items: center;
        justify-content: space-around;
        margin-bottom: 50px;
        /* background: #eeeeee; */
        /* height: 200px; */
      }

      .control_box_lr, .control_box_lr_nav {
        width: 350px;
        /* height: 50px;
        line-height: 50px; */
        text-align: center;
        /* background: #eeeeee; */
      }

      .control_box_c, .control_box_c_nav {
        width: 550px;
        /* height: 50px;
        line-height: 50px; */
        text-align: center;
        margin:auto;
      }

      .row { margin: -10px!important; }

      #backButton {
      	border-radius: 4px;
      	padding: 8px;
      	border: none;
      	font-size: 16px;
      	background-color: #2eacd1;
      	color: white;
      	position: absolute;
      	top: 10px;
      	right: 10px;
      	cursor: pointer;
        }

        .invisible {
          display: none;
        }

        /* For Test Report daily_repair */
        .number{ text-align : center;}
        .number div{
        	background: #91F7A4;
        	color : #ff0000;
        }
        #test_report th{ background-color : #21BBD6; color : #ffffff;}
        #test_report{
        	border-right : 1px solid #eeeeee;
        	border-bottom : 1px solid #eeeeee;
          width: 100%;
          margin:20px auto;
          padding: 0px 15px;
        }
        #test_report td,#test_report th{
        	border-top : 1px solid #eeeeee;
        	border-left : 1px solid #eeeeee;
        	padding : 2px;
        }
        #txt_year{ width : 70px;}
        .fail{ color : red;}

    </style>

  </head>
  <body>

   <div class="wrapper">
     <?php include('nav.php'); ?>

   	<div id="content" class="">

  <!-- Begin menu_bar -->

      <div id="control_container_nav" class="control_nav" style="padding:10px; margin-bottom:10px;">

        <div class="control_box_lr_nav" style="text-align:left;">
          <button type="button" id="sidebarCollapse" class="btn btn-light">
       			<i class="fa fa-align-justify"></i> <span></span>
       		</button>
        </div>

          <div class="control_box_c_nav text-center">
            <span class="badge badge-warning mx-auto"><strong>ระบบซ่อมบำรุง ปาล์มดีศรีนคร</strong></span>
          </div>

          <div class="control_box_lr_nav" style="text-align:right;">
            <a href="#" onclick="history.go(-1); return false;" class=""><i class="fa fa-chevron-circle-left text-primary" aria-hidden="true"></i> <span class="text-primary">กลับ</span></a>
          </div>

      </div>

  <!-- End menu_bar -->

        <div id="control_event" class="control_event">

          <div class="clearfix text-center panel panel-info">
              <div class="panel-heading"><h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>รายงานสรุปใบแจ้งซ่อมรายเดือน(KPI)</h4></div>
          </div>

            <div id="" class="text-center border panel panel-default">

          <!-- Begin panel-body -->
              <div class="panel-body">

                  <form method="post" id="frm_add" action="p_pm_monthly_report_print.php" class="form-inline">

                    <input type="hidden" name="m_text" id="m_text" value="" />
                    <input type="hidden" name="y_text" id="y_text" value="" />

                      <div class="form-group col-12">
                        <label class="">ระบุเดือน และ ปี</label>
                          <select class="form-control form-control-lg" id="month" name="month" style="margin-bottom:5px;" onchange="fetch_data($('select[name=tech_group] option:selected'), $('select[name=month] option:selected'), $('select[name=year] option:selected'));">
                            <?php
                            $i = 0;
                            $month = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                            foreach($month as $monthname)
                            {
                              $i++;
                            ?>
                              <option value="<?php if($i < 10){ echo '0'.$i; } else { echo $i; } ?>" <?php if(date("m")==$i){echo "selected=selected";} ?>> <?php echo $monthname ?></option>
                            <?php } ?>
                          </select>

                            <select class="form-control form-control-lg"  name="year" id="year" style="margin-bottom:5px;" onchange="fetch_data($('select[name=tech_group] option:selected'), $('select[name=month] option:selected'), $('select[name=year] option:selected'));" >
                              <?php for($i=0; $i<=10; $i++) { ?>
                              <option value="<?php echo date("Y")-$i?>" <?php if(date("Y")==date("Y")+$i){echo "selected=selected";}?> > <?php echo date("Y")-$i+543; ?></option>
                              <?php } ?>
                            </select>
                      </div>

                      <div class="form-group col-12">
                          <div class="form-inline">
                            <label class="">กลุ่มช่าง</label>
                            <select class="form-control" style="" id="tech_group" name="tech_group" onchange="fetch_data($('select[name=tech_group] option:selected'), $('select[name=month] option:selected'), $('select[name=year] option:selected'));" >
                              <option value="ช่างกล">ช่างกล</option>s
                              <option value="ช่างผลิต">ช่างผลิต</option>
                              <option value="ช่างไฟ">ช่างไฟ</option>
                            </select>
                          </div>
                      </div>

                    </form>

                  </div>

          <!-- End panel-body -->

              <div class="panel-footer">
                <button type="button" id="btn_print" class="btn btn-info" onclick="window.print()">
                    <span class="glyphicon glyphicon-print"></span> Print or Export PDF
                </button>

              </div>

            </div>

        </div>

<!-- End control_event -->

          <div id="" class="print_panel clearfix" style="clear:both;">

              <div id="header_print" style="display:none;">
                <div id="control_container">
                  <div class="control_box_lr" style="text-align:left;">
                    <img src="images/PDS-Logo-03.jpg" alt="pds-logo" width="170px;" id="report_logo"/>
                  </div>

                    <div class="control_box_c text-center">
                      <h4 style="margin-bottom:0px!important;">รายงานสรุปใบแจ้งซ่อมรายเดือน(KPI)</h4>
                      <p>(KPI Monthly Report)</p>
                      <h5 style="margin:-10px!important;"><span id="kpi_month" ></span> <span id="kpi_year"></span></h5>
                      <h5 id="kpi_tech_group"></h5>
                    </div>

                    <div class="control_box_lr" style="text-align:right;">
                      <h5></h5>
                    </div>
                </div>
              </div>

              <div class="col-sm-3 col-md-3">
                <div class="panel panel-waring text-center" style="border-color: #8a6d3b">
                  <div class="panel-body">

                    <p id="dep_total_persen" style=";">0%</p>

                    <div class="text-left col-sm-12 col-md-12" style="font-size:16px;">
                      <strong><div class="text-left col-xs-6 col-sm-6 col-md-6">ทั้งหมด</div><div id="dep_total" class="text-right col-xs-6 col-sm-6 col-md-6">0</div></strong>
                      <div class="text-left col-xs-6 col-sm-6 col-md-6">ปิดแล้ว</div><div id="dep_close" class="text-right col-xs-6 col-sm-6 col-md-6">0</div>
                      <div class="text-left col-xs-6 col-sm-6 col-md-6">งานค้าง</div><div id="dep_progress" class="text-right col-xs-6 col-sm-6 col-md-6">0</div>
                    </div>
                  </div>
                  <div class="panel-footer" style="background: #8a6d3b; color: #ffffff;"><h4>ทั้งหมด</h4></div>
                </div>
              </div>

              <div class="col-sm-3 col-md-3">
                <div class="panel panel-primary text-center">
                  <!-- <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                  </div> -->
                  <div class="panel-body">

                    <p id="month_total_persen" style="">0%</p>

                    <input type="hidden" id="num_close" value="0" />
                    <input type="hidden" id="num_total" value="0" />

                    <div class="text-left col-sm-12 col-md-12" style="font-size:16px;">
                      <strong><div class="text-left col-xs-6 col-sm-6 col-md-6">ทั้งหมด</div><div id="month_total" class="text-right col-xs-6 col-sm-6 col-md-6">0</div></strong>
                      <div class="text-left col-xs-6 col-sm-6 col-md-6">ปิดแล้ว</div><div id="month_close" class="text-right col-sm-6 col-xs-6 col-md-6">0</div>
                      <div class="text-left col-xs-6 col-sm-6 col-md-6">งานค้าง</div><div id="month_progress" class="text-right col-xs-6 col-sm-6 col-md-6">0</div>
                    </div>
                  </div>
                  <div class="panel-footer" style="background: #337ab7; color: #ffffff;"><h4>ประจำเดือน</h4></div>
                </div>
              </div>


              <div class="col-sm-6 col-md-6">
                <div id="chartKPI_PIE" style="height: 400px;"></div>
                <button class="btn invisible" id="backButton">&lt; Back</button>
              </div>

              <div id="daily_repair" class="col-sm-12 col-md-12"></div>

              <div class="col-sm-12 col-md-12" style="margin:25px auto;">
                <div id="chartKPI_SPLINE" style="height: 370px;"></div>
              </div>


              <div id="p_iso_start_use" class="control_box_lr" style="text-align:left; width:350px!important;">
                  <p></p>
              </div>


		    </div>
<!-- end ส่วนข้อมูล set_department -->

    </div>
    <!-- end content -->

</div>
<!-- end wrap -->

</body>
</html>


<script type="text/javascript">

$( document ).ready(function() {

  getCount('count_my_job');
  getCount('count_today_job');
  getCount('count_month_job');
  getCount('count_no_action_job');


  $('#sidebarCollapse').on('click',function(){
    $('#sidebar').toggleClass('active');
  });

  $('li').click(function(){
    $('li').removeClass('active');
    $(this).addClass('active');
  });



//ออกจากระบบ

        $(".logout").click(function(){

                            $.ajax({
                                type: "POST",
                                url: "login/logout.php",
                                success: function(result) {
                                    if (result == 0) // Success
                                    {
                                        //alert("OK");
                                        $('body').addClass('animated fadeOut');
                                        window.location.href = '../webapp/login/login.php'; //Will take you to Google.
                                    }
                                }
                            });
        });
//ออกจากระบบ

      $(document).on('click','a',function(){
        var strText = $(this).text();
        var arr = strText.split(' - ');

        $("#i_job_code").val(strText);
        $("#h_job_code").val(arr[0]);
        $("#show-list").html('');
      });


    // $(".dataTables_length").hide();

      $('.print_panel').fadeIn('slow');  //แสดงผลแบบ ค่อยๆแสดง ด้วย function fadeIn()

      $("#btn_logout_model").click(function() {
          $('#logout_model').modal('show');	//แสดงหน้าต่าง modal add_model
      });

      var s_month = $("select[name='month'] option:selected");
      var s_year = $("select[name='year'] option:selected");
      var s_tech_group = $("select[name='tech_group'] option:selected");

      fetch_data(s_tech_group, s_month, s_year);

      load_pie_chart($("#month_total").text(), $("#month_close").text(), $("#month_progress").text());
      load_spline_chart('daily_repair', $("select[name='tech_group'] option:selected").val(), $("select[name='month'] option:selected").val(), $("select[name='year'] option:selected").val());


      $('#tech_group, #month, #year').change(function(){
       if(month != '' && year !='')
       {
        fetch_data($("select[name='tech_group'] option:selected"), $("select[name='month'] option:selected"), $("select[name='year'] option:selected"));
        load_spline_chart('daily_repair', $("select[name='tech_group'] option:selected").val(), $("select[name='month'] option:selected").val(), $("select[name='year'] option:selected").val());
       }
       else
       {
        alert("ยังไม่ได้ใส่เงื่อนไข");
       }
      });





});

function fetch_data(tech_group, month, year)
{

  // console.log(tech_group.text()+', '+month.text()+', '+year.text());

  updateText(month.text(), year.text(), tech_group.text());

  get_data('month_total', tech_group.val(), month.val(), year.val());
  get_data('month_close', tech_group.val(), month.val(), year.val());
  get_data('month_progress', tech_group.val(), month.val(), year.val());
  get_data('month_total_persen', tech_group.val(), month.val(), year.val());

  get_data('dep_total', tech_group.val(), '', '');
  get_data('dep_close', tech_group.val(), '', '');
  get_data('dep_progress', tech_group.val(), '', '');
  get_data('dep_total_persen', tech_group.val(), '', '');

  get_data('daily_repair', tech_group.val(), month.val(), year.val());


}
function get_data(action, tech_group, month, year){

    $.ajax({
      url: 'report/fetch_kpi_monthly_report.php',
      method: 'post',
      data: { 'action': action, 'tech_group': tech_group, 'month':month, 'year':year },
      success:function(response){
         // alert(response);

        if(action == 'daily_repair' || action == 'dep_total_persen' || action == 'month_total_persen'){
          $('#'+action).html(response);
        }else{
          $('#'+action).text(response);
        }

        load_pie_chart($("#month_total").text(), $("#month_close").text(), $("#month_progress").text());
        // load_spline_chart(month, year);
      }
    });

}

function updateText(month, year, tech_group){
  // alert(month);
  if(month!=''){
    $('#kpi_month').text(month);
  }
  if(year!=''){
    $('#kpi_year').text(year);
  }
  if(tech_group!=''){
    $('#kpi_tech_group').text('แผนก ' + tech_group);
  }


}


function getCount(action_name){

  var username = $('.user').text();
  var level = $('.level').text();

  // alert(username.text()+' '+level.text());

    $.ajax({
      url: 'action.php',
      method: 'post',
      data: {'action':'get_'+action_name, 'username':username, 'level':level},
      success:function(response){
        $('#'+action_name).text(response);
      }
    });
}

function validate(data){
  // alert(data);
  if(data == ''){
    $('#btn_print').attr('disabled','disabled');
  }else{
    $('#btn_print').removeAttr('disabled');
  }
}


function load_pie_chart(total, success, progress) {

  // console.log(total+ ' - '+success +' - '+ progress);

  var totalData = total;
  var visitorsData = {
  	"ปิดงานแล้ว VS งานค้าง": [{
  		// click: repairChartDrilldownHandler,
  		cursor: "pointer",
  		explodeOnClick: false,
  		innerRadius: "75%",
  		legendMarkerType: "square",
  		name: "Success vs Progress Repair",
  		radius: "100%",
  		showInLegend: true,
  		startAngle: 90,
  		type: "pie", //doughnut
      indexLabelPlacement: "inside", //inside, outside
      indexLabel: "{name} ({y})",
      // indexLabelFontSize: 14,
      indexLabelFontColor: "white",
  		dataPoints:  [
        { y:success, name: "ปิดงานแล้ว" , color: "#3c763d" },
				{ y:progress, name: "งานค้าง" , color: "#E7823A" },
      ]     <?php // echo json_encode($newVsReturningVisitorsDataPoints, JSON_NUMERIC_CHECK); ?>
  	}]

  };

  var successVSprogressRepairOptions = {
  	animationEnabled: false,
  	theme: "light2",
  	title: {
  		// text: "ปิดงานแล้ว VS งานค้าง",
      // fontSize: 20,
      // margin: 10,
      // padding: 5,
      // borderThickness: 2,
  	},
  	subtitles: [{
  		// text: "คลิกที่กราฟดูรายละเอียด",
  		// backgroundColor: "#2eacd1",
  		// fontSize: 12,
  		// fontColor: "white",
  		// padding: 5
  	}],
  	legend: {
      verticalAlign: "top",  // "top" , "bottom"
      horizontalAlign: "center",
  		fontFamily: "calibri",
  		fontSize: 14,
  		itemTextFormatter: function (e) {
  			return e.dataPoint.name + ": " + Math.round(e.dataPoint.y / totalData * 100) + "%";
  		}
  	},
  	data: []
  };


  var chart = new CanvasJS.Chart("chartKPI_PIE", successVSprogressRepairOptions);
  chart.options.data = visitorsData["ปิดงานแล้ว VS งานค้าง"];
  chart.render();


}

function load_spline_chart(action, tech_group, month, year){

        dataPoints = [];
        var chart;

        chart = new CanvasJS.Chart("chartKPI_SPLINE", {
            animationEnabled: false,
            exportEnabled: false,
            title:{
              text: "แสดงเฉพาะวันที่มีการแจ้งซ่อม",
              fontSize: 13,
              margin: 5,
              fontWeight: "bold",
            },
            axisX:{
              title: "วันที่",
        			interval: 1,
      		  },
            axisY:{
              title: "ใบแจ้งซ่อม(งาน)",
              interval: 1,
            },
            subtitles: [{
            text: "(ดูความถี่ของการแจ้งซ่อม)"
            }],
            data: [{
              type: "area", //area, spline, line
              showInLegend: false,
              toolTipContent: "วันที่ {label}: แจ้งซ่อม {y} งาน", //<b>{name}</b>: {y} งาน (#percent%)
              // legendText: "วันที่",
              indexLabelFontSize: 16,
              indexLabel: "{y} งาน",
              // yValueFormatString: "#,##0",
              dataPoints: dataPoints
              <?php //echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });

        //ใส่ข้อมูลลงใน dataPoints Chart
          $.ajax({
            url: 'report/fetch_kpi_monthly_report.php',
            method: 'post',
            dataType: "json",
            data: {'action': 'daily_data', 'tech_group': tech_group, 'month':month, 'year':year},
            success:function(response){

              // var lastDayOfMonth = moment(year+"-"+month, "YYYY-MM").daysInMonth(); //หาจำนวนวันในแต่ละเดือน

                  for (var x in response) {
                    dataPoints.push( response[x] );
                    chart.render();
                  }

            }
          });



}

</script>
