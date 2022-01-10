<?php
session_start();
 //echo $_SESSION["pm_user"];
if(!isset($_SESSION["pm_user"]))
{
 header('location:../webapp/login/login.php');
}
// date_default_timezone_set('Asia/Bangkok');

$page = $_SESSION['pm_ses_page'];
$u_level = $_SESSION["pm_level"];
$emp_code = $_SESSION["pm_emp_code"];
// echo $emp_code;

include_once('../include/connect_oop_db.php');

 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="images/icons/construction-and-tools.png" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css" >
    <link rel="stylesheet" href="../bootstrap_v3.3.6/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/bootstrap-select.min.css">

    <title>PDS PM Systems :: ระบบซ่อมบำรุง บริษัท ปาล์มดีศรีนคร จำกัด</title>

    <style>

        @media screen and (max-width: 769px) {
          /* .print_panel, .control_box_lr, #p_iso_start_use { display: none!important; } */
          .table-responsive { font-size: 80%; }
          .control_box_c { width:800px!important; }
          .navbar {  width: 325px; margin:0 auto; padding: 10px 0px; }
          p { font-size: 80%; }
          .dropdown-menu { max-width: 300px;}
        }

        @media screen and (min-width: 769px) {
          #page { width:40%; margin:0 auto; }
          small { font-size: 100%; }
          #top-title { font-size: 18px; color: #195f42; }
          .dropdown-menu { max-width: 325px;}
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

        .bootstrap-select>.dropdown-toggle.bs-placeholder,
        .bootstrap-select>.dropdown-toggle.bs-placeholder:active,
        .bootstrap-select>.dropdown-toggle.bs-placeholder:focus,
        .bootstrap-select>.dropdown-toggle.bs-placeholder:hover {
            text-align: center;
            background: #fff;
        }

        .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
            overflow: hidden;
            text-align: center;
            font-size: 14px;
            background: #fff;
            padding: 15px 15px;
        }
        .btn-light {
            color: #212529;
            background-color: #ffffff;
            border-color: #f8f9fa;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #f3f3f3;
            color: #6f6f6f;
            transition: all 0.3s;
            font-size: 0.85em;
        }

    </style>

  </head>

  <body>

   <div class="wrapper" style="display:none;">
     <?php include('nav.php'); ?>

   	<div id="content">

    <!-- Begin menu_bar -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light col-12">

      <button type="button" id="sidebarCollapse" class="btn btn-light">
        <i class="fa fa-align-justify"></i> <span></span>
      </button>

      <div id="top-title" class="mx-auto px-3 py-1 mb-0"><strong>ระบบแจ้งซ่อมปาล์มดีศรีนคร</strong></div>

      <a href="#" onclick="history.go(-1); return false;" class="invisible"><i class="fa fa-chevron-circle-left text-primary" aria-hidden="true"></i> <span class="text-primary">กลับ</span></a>
    </nav>

    <!-- End menu_bar -->

    <div id="page" class="container">
      <div id="top" class="row mb-5 mr-auto ml-auto">

        <div class="col-xs col-sm">
          <form id="frmSearch" method="post" action="" onSubmit="JavaScript:return ckSP_CODE();">

            <div class="form-group pt-5 pb-4">
              <label for="sp_code">ค้นหา:</label><span class="text-danger">*</span>
              <select class="form-control selectpicker" id="sp_code" name="sp_code" data-live-search="true" title=" --- ระบุ รหัส / ชื่ออะไหล่ --- ">
                <option value=""> --- ไม่ระบุ --- </option>
                <?php
                  $sql1 = "SELECT * FROM tbl_sparepart ORDER BY spare_name_th ASC ";
                          $rs1 = $mysqli->query($sql1);
                          while ($r1 = $rs1->fetch_object()) {
                            echo '<option value="'.$r1->spare_code.'">'.$r1->spare_code.' - '.$r1->spare_name_th.' ('.$r1->spare_name_en.')</option>';
                          }//end while
                ?>
              </select>
            </div>

            <button type="button" id="btn_search" class="btn btn-lg btn-primary w-100">ค้นหา</button>
          </form>

        </div>
      </div>
      <br/>
      <br/>
      <div id="body" class="text-center my-5">
        <h2>ระบบแจ้งซ่อมบำรุง</h2>
        <div><img src="../images/logo/PDS-Logo-250x102px.png" alt="" width="100%"></div>
      </div>
      <div id="bottom" class="w-100 mr-auto ml-auto">
        <div class="" style="position:relative; margin-top:-390px;">
          <div class="list-group" id="show-list">

          </div>
        </div>
      </div>
   	</div>
</div>



   </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="../js/jquery/jquery-3.3.1.slim.js" integrity="" crossorigin="anonymous"></script>
    <script src="../js/jquery/popper.js" integrity="" crossorigin="anonymous"></script> -->
    <script src="../js/jquery/jquery.min.js"></script>
    <script src="../js/jquery/bootstrap.bundle.js"></script>
    <script src="../js/bootstrap-select.min.js"></script>

    <script>
	    $(document).ready(function(){

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

        $('#sp_code').val('');
        $('#sp_code').focus();

        $('#btn_search').click(function(){

          if($("#sp_code").val()==''){
            alert('คุณยังไม่ได้ระบุอะไหล่ที่ต้องการ');
            $("#sp_code").focus();
          }else{
            window.location.href = 'spare_detail.php?sp_code='+ $("#sp_code").val();
          }


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

		});

    function ckSP_CODE(){
      var s_sp_code = document.getElementById("s_sp_code");
      var i_sp_code = document.getElementById("i_sp_code");

      if(i_sp_code.value == '')
    	{
    		alert('ยังไม่ได้ระบุรหัสอะไหล่ที่ต้องการค้นหา!');
    		document.getElementById("i_sp_code").focus();
    		return false;
    	}else{
        return true;
      }

    }

    function getCount(action_name){

      var username = '<?php echo $_SESSION["pm_emp_code"]; ?>';
      var level = '<?php echo $_SESSION["pm_level"]; ?>';

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

	</script>





  </body>
</html>
