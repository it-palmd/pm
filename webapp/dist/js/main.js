
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
