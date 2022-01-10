//Validation Check Form
function check_form(obj){
    $(".is-invalid").removeClass("is-invalid");
    var formObj = $(obj);
    var required_count = formObj.find("[data-required]").length; // มีรายการที่จะเช็คกี่รายการ
    var valid_check = true;
    if(required_count && required_count>0){
        var requiredObj = formObj.find("[data-required]"); // ได้รายการที่จะเช็คเป็น array ของ object
        $.each(requiredObj,function(k,v){ // วนลูปรายการที่จะเช็ค
            var typeObj_required = requiredObj.eq(k)[0].tagName.toLowerCase();
            var nameObj = requiredObj.eq(k).attr("name");
            var nodeObj_required = '';
            var requiredText = "";
            if(typeObj_required=='input' || typeObj_required=='select' || typeObj_required=='textarea'){
                nodeObj_required = requiredObj.eq(k).attr("type");
                requiredText = requiredObj.eq(k).data("required");
                if(nodeObj_required=='radio'){
                    if(formObj.find(":radio[name='"+nameObj+"']:checked").length==0){
                        $('html, body').animate({ // สร้างการเคลื่อนไหว
                            scrollTop: requiredObj.eq(k).offset().top-100 // ให้หน้าเพจเลื่อนไปทำตำแหน่งบนสุด
                        }, 0); // ภายในเวลา 0.5 วินาที ---- 1000 เท่ากับ 1 วินาที
                        valid_check = false;
                        var textAlert = "เลือกหรือกรอกข้อมูลที่จำเป็นให้ครบถ้วน\n-- "+requiredText;
                        alert(textAlert);
                        return false;
                    }
                }
                if(nodeObj_required=='checkbox'){
                    if(formObj.find(":checkbox[data-required='"+requiredText+"']:checked").length==0){
                        $('html, body').animate({ // สร้างการเคลื่อนไหว
                            scrollTop: requiredObj.eq(k).offset().top-100 // ให้หน้าเพจเลื่อนไปทำตำแหน่งบนสุด
                        }, 0); // ภายในเวลา 0.5 วินาที ---- 1000 เท่ากับ 1 วินาที
                        valid_check = false;
                        var textAlert = "เลือกหรือกรอกข้อมูลที่จำเป็นให้ครบถ้วน\n-- "+requiredText;
                        alert(textAlert);
                        return false;
                    }
                }
            }
            if(requiredObj.eq(k).val()==""){
                $('html, body').animate({ // สร้างการเคลื่อนไหว
                        scrollTop: requiredObj.eq(k).offset().top-100 // ให้หน้าเพจเลื่อนไปทำตำแหน่งบนสุด
                    }, 0); // ภายในเวลา 0.5 วินาที ---- 1000 เท่ากับ 1 วินาที
                requiredObj.eq(k).addClass("is-invalid").focus();
                valid_check = false;
                var textAlert = "เลือกหรือกรอกข้อมูลที่จำเป็นให้ครบถ้วน\n-- "+requiredText;
                alert(textAlert);
                return false;
            }
        });
        if(valid_check==false){
            return false;
        }else{
            return true;
        }
    }
}
