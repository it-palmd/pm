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


$dataPoints = array();
//Best practice is to create a separate file for handling connection to database
try{
     // Creating a new connection.
    // Replace your-hostname, your-db, your-username, your-password according to your database
    $link = new \PDO(   'mysql:host=localhost;dbname=pds_pm;charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
                        'root', //'root',
                        '', //'',
                        array(
                            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                    );

    $handle = $link->prepare('SELECT product_name, product_price FROM tbl_products');
    $handle->execute();
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);

    foreach($result as $row){
        array_push($dataPoints, array("label"=> $row->product_name, "y"=> $row->product_price));
    }
	$link = null;

}
catch(\PDOException $ex){
    print($ex->getMessage());
}

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
        .print_panel { margin:0px; }

        #control_event, #p_data_length, #p_data_filter, #p_data_paginate, #p_data_info { display: none; }
        #report_logo { display: block!important; margin: 5px 0px 0px 0px; }
        #content { padding:0px!important; }
        .table-responsive { margin: 0px -10px; padding: 10px!important; }
        .pagination{ margin-bottom: 0px!important; }
        .control_nav { display: none!important; }

      }

      @page { size: landscape; }

/* End for Print */

      body{ background: #ffffff!important;}
      #p_data_length, #p_data_info { float: left; margin: 10px; }
      #p_data_filter, #p_data_paginate { float: right; margin: 10px; text-align: right!important;}
      .table-responsive { overflow-x: hidden; }
      #report_logo { display: none; }
      #chartKPI_ALL { width: 30%; }


      @media screen and (max-width: 769px) {
        .print_panel, .control_box_lr, #p_iso_start_use { display: none!important; }
        #chartKPI_ALL { width: 100%; }
      }

      #control_container_nav ,#control_container {
        display: flex;
        align-items: center;
        justify-content: space-around;
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

    </style>

    <script type="text/javascript">

        window.onload = function() {

          CanvasJS.addColorSet("greenShades",
                [//colorSet Array

                "#69f160", //เขียว
                "#ff4c4c" //แดง
                ]);

          var options = {
          	exportEnabled: true,
          	animationEnabled: true,
            theme: "light1", //"light1", "dark1", "dark2"
            colorSet: "greenShades",
          	title:{
          		text: "แจ้งซ่อมทั้งหมด",
              fontSize: 22,
              margin: 10,
              padding: 10,
          	},
          	legend:{
          		horizontalAlign: "center",
          		verticalAlign: "top",
              cursor: "pointer",
              fontStyle: "italic",
              itemMaxWidth: 250
          	},
          	data: [{
              indexLabelFontColor: "white",
              // indexLabelFontSize: 10,
              indexLabelFontWeight: "bold",
          		type: "pie",
          		showInLegend: true,
          		toolTipContent: "{name}: {y} งาน (#percent%)", //<b>{name}</b>: {y} งาน (#percent%)
          		indexLabel: "{y} งาน (#percent%)",
          		legendText: "{name}",
          		indexLabelPlacement: "inside",
          		dataPoints: [
          			{ y: 70, name: "แจ้งซ่อมปิดงานแล้ว", indexLabelMaxWidth: 70 },
          			{ y: 14, name: "แจ้งซ่อมค้าง", indexLabelMaxWidth: 70 },
          		]
          	}]
          };
          $("#chartKPI_ALL").CanvasJSChart(options);

          console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);

          var chart = new CanvasJS.Chart("chartContainer", {
          	animationEnabled: true,
          	exportEnabled: true,
          	theme: "light1", // "light1", "light2", "dark1", "dark2"
          	title:{
          		text: "Data From DB Tbl Products"
          	},
          	data: [{
          		type: "area", //change type to bar, line, area, pie, etc
          		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
          	}]
          });
          chart.render();

        }




    </script>

  </head>
  <body>

   <div class="wrapper" style="display:none;">
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
      <div class="panel-heading"><h4><span class="glyphicon glyphicon-file" aria-hidden="true"></span>KPI</h4></div>
  </div>

        <div id="chartKPI_ALL" style="height:370px;"></div>

</div>

<!-- End control_event -->

          <div id="" class="print_panel clearfix" style="clear:both;display:none; margin:0px;">

            <!-- <div id="control_container">

              <div class="control_box_lr" style="text-align:left;">
                <img src="images/PDS-Logo-03.jpg" alt="pds-logo" width="170px;" id="report_logo"/>
              </div>

                <div class="control_box_c text-center">
                  <h4 style="margin-bottom:0px!important;">ทะเบียนใบแจ้งซ่อมแยกตามกลุ่มช่าง</h4>
                  <p>(Reaister a Repair Log By Department)</p>
                  <h5 id="tech_name_report"></h5>
                  <h5 style="margin-bottom:0px!important;"><span id="s_date"></span><span id="e_date"></span></h5>
                </div>

                <div class="control_box_lr" style="text-align:right;">
                  <h5></h5>
                </div>

            </div> -->

            <div class="">

              <div id="chartContainer" style="height: 370px; width:100%;"></div>


            </div>

            <div id="p_iso_start_use" class="control_box_lr" style="text-align:left; width:350px!important;">
                <p></p>
            </div>


		    </div>
<!-- end ส่วนข้อมูล set_department -->

    </div>

</div>



</body>
</html>



<script type="text/javascript">
$( document ).ready(function() {

  $('.wrapper').fadeIn('slow');
  
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

  updateText('');
  fetch_data('', '', '');

           $(function() {

              $('input[name="date_range"]').daterangepicker({
                  autoUpdateInput: false,
                  showDropdowns: true,
                  opens: 'center',
                  autoApply: true,
                  showCustomRangeLabel: true,
                  ranges: {
                     'วันนี้': [moment(), moment()],
                     'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                     'ย้อนหลัง 7 วัน': [moment().subtract(6, 'days'), moment()],
                     'ย้อนหลัง 30 วัน': [moment().subtract(29, 'days'), moment()],
                     'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
                     'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                 },
                  locale: {
                    applyLabel: 'ยืนยัน',
                    cancelLabel: 'ยกเลิก',
                    customRangeLabel: 'กำหนดเอง'
                  }
              });

              $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {

                  $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));

                  var start_date = picker.startDate.format('YYYY-MM-DD');
                  var end_date = picker.endDate.format('YYYY-MM-DD');
                  var tech = $('#tech_group').val();
                  // alert(start_date+' - '+ end_date);
                  validate($(this).val());
                  fetch_data(tech, start_date, end_date);

                  // $('#range').val(start_date+' - '+ end_date);
                  $('#s_date').text('จากวันที่ : '+picker.startDate.format('DD/MM/YYYY'));
                  $('#e_date').text(' ถึงวันที่ : '+picker.endDate.format('DD/MM/YYYY'));

                  $('#start_date').val(start_date);
                  $('#end_date').val(end_date);

                });

              $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                  $(this).val('');
              });

            });






});

function fetch_data(tech, start_date, end_date)
{

 $('#p_data').fadeOut(100).fadeIn('slow');
 $('#p_data').DataTable().destroy();

 var dataTable = $('#p_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "scrollX": false,
    "dom": '<lf<t>ip>',
    "paging":   true,
    "ordering": true,
    "stateSave": false, //เวลากด refresh หน้าเว็บจะค้างไว้ที่ page ที่เราเลือก
    "info":     true,
    "language": {
         search: "ค้นหา:",
         info: "แสดงข้อมูล _START_ ถึง _END_ จากข้อมูลที่ค้นพบ  _TOTAL_ รายการ ",
         infoFiltered: "(จากข้อมูลทั้งหมด _MAX_ รายการ)",
         processing: "กำลังดำเนินการ...",
         lengthMenu: "แสดง _MENU_ รายการ/หน้า",
         infoEmpty: "กรุณารอสักครู่...",
         zeroRecords: "ไม่พบข้อมูล",
         paginate: {
              "first": "หน้าแรก",
	            "previous": "ก่อนหน้า", // เปลี่ยน ในส่วนของการ control page
	            "next": "ถัดไป",
              "last": "หน้าสุดท้าย",
	         },
     },
    "pagingType": "full_numbers", //แสดงปุ่ม paginage แบบเต็ม
    "order": [[ 1, "desc" ]],
    "pageLength": -1, //-1 = All
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "ทั้งหมด"]],
    "columnDefs": [
                 { "width": "1%", "targets": 0 },
                 { "width": "8%", "targets": 1 },
                 { "width": "8%", "targets": 2 },
                 { "width": "8%", "targets": 3 },
                 { "width": "6%", "targets": 4 },
                 { "width": "20%", "targets": 5 },
                 { "width": "10%", "targets": 6 },
                 { "width": "21%", "targets": 7 },
                 { "width": "9%", "targets": 8 },
                 { "width": "10%", "targets": 9 }
               ],
    "ajax" : {
       url:"report/fetch_department_report.php",
       type:"POST",
       // data:{ 'tech_group': tech, 'start_date':start_date, 'end_date':end_date } //ส่งค่าแบบทั่วไปไม่กี่ค่า

       //ส่งค่าแบบกรณีต้องการส่งค่าไปค้นหาเองใน datatable ส่งแบบ Json
       data: function (d) {
                // Custom search ตรงนี้ครับจะส่งอะไรไปก็ได้
                d["tech_group"] = tech;
                d["start_date"] = start_date;
                d["end_date"] = end_date;

                return d;
            }

       // ส่วนฝั่ง php ก็รับค่า $_POST["textbox1"] , $_POST["textbox2"]ไป where ต่อได้เลย

    }
 });

 //End dataTable

 $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();

        // Get the column API object
        var column = dataTable.column( $(this).attr('data-column') );

        // Toggle the visibility
        column.visible( ! column.visible() );
    } );

}

function ckJOB_CODE(){
  var s_job_code = document.getElementById("s_job_code");
  var i_job_code = document.getElementById("i_job_code");

  if(i_job_code.value == '')
  {
    alert('ยังไม่ได้ระบุรหัสอะไหล่ที่ต้องการค้นหา!');
    document.getElementById("i_job_code").focus();
    return false;
  }else{
    return true;
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

function updateText(value){
  // alert(value);
  if(value==''){
    $('#tech_name_report').text('ทุกแผนก');
  }else{
    $('#tech_name_report').text('แผนก ' + $('#tech_group').val());
  }
}

function validate(data){
  // alert(data);
  if(data == ''){
    $('#btn_print').attr('disabled','disabled');
  }else{
    $('#btn_print').removeAttr('disabled');
  }
}

</script>
