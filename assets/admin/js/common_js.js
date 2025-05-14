 /**
 * Purpose : For checking the validations like Empty field validation , Email validation , Mobile phone validation.
 **
 */
window.prevemailid = "";
function readURL(input,id = 'ImagePreivew1') {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$('.input_starttime').clockpicker({
    placement: 'bottom',
    align: 'left',
    twelvehour: true
});
$('.input_endtime').clockpicker({
    placement: 'bottom',
    align: 'left',
    darktheme: true,
    twelvehour: false
});
function checkValidations(pre_id = ''){
    var is_error = 'no';
    $(pre_id + ' .empty_validation_class').each(function (){
        if($(this).attr('type') == "checkbox"){
          var name = $(this).attr('name');
          var len = $("input[name='" + name + "']:checked").length;
          if(len == 0){
              is_error = 'yes'; 
              if(!$(this).parent().hasClass('invalid_chk')){
                $(this).parent().addClass('invalid_chk');
              }
          }else{
            $(this).parent().removeClass('invalid_chk');
          }
        }else{
          if ($.trim($(this).val()).length == 0) {
              $(this).addClass("invalid");
              is_error = 'yes';
          } else {
              $(this).removeClass("invalid");
          }

        }
    });
    $(pre_id + ' .MobileNo').each(function (){
        if($(this).val() != ""){
          if($(this).val().length < 10){
            $(this).addClass("invalid");
            is_error = 'yes';
          }else{
            $(this).removeClass("invalid");
          }
        }else{
          if(!$(this).hasClass('empty_validation_class')){
            $(this).removeClass("invalid");
          }
        }
    });
    $(pre_id + ' .FixedLength').each(function (){
        if($(this).val() != ""){
          var flength = $(this).attr('fixedlength');
          if($(this).val().length != flength){
            $(this).addClass("invalid");
            is_error = 'yes';
          }else{
            $(this).removeClass("invalid");
          }
        }else{
          if(!$(this).hasClass('empty_validation_class')){
            $(this).removeClass("invalid");
          }
        }
    });
    $(pre_id + ' .CustomLength').each(function (){
      if($(this).val() != ""){
          var min = $(this).attr('min');
          var max = $(this).attr('max');
          var len = $(this).val().length;
          if(len < min || max < len){
            $(this).addClass("invalid");
            is_error = 'yes';
          }else{
            $(this).removeClass("invalid");
          }
      }else{
        if(!$(this).hasClass('empty_validation_class')){
          $(this).removeClass("invalid");
        }
      }
    });
    $(pre_id + ' .WebsiteURL').each(function (){
      if($(this).val() != ""){
      var flag = isWebsiteURL($(this).val());
      if(!flag){
        $(this).addClass("invalid");
        is_error = 'yes';
      }else{
        $(this).removeClass("invalid");
      }
      }else{
        if(!$(this).hasClass('empty_validation_class')){
          $(this).removeClass("invalid");
        }
      } 
    });
    $(pre_id + ' :input[type="email"]').each(function (){
        if($(this).val() != ""){
          var email = isEmail($(this).val());
          if(!email){
            $(this).addClass("invalid");
            is_error = 'yes';
          }else{
            $(this).removeClass("invalid");
          }
        }else{
          if(!$(this).hasClass('empty_validation_class')){
            $(this).removeClass("invalid");
          }
        }
    });
    return is_error;
}

    /**
     * Purpose : combo box check empty validation.
     * 
     * Developer : Nilay
     */
function checkComboBox(field_ids = []){
    var is_error = 'no';
    var field_ids_array_length = field_ids.length;
    for (var i = 0; i < field_ids_array_length; i++) {
        if($('#' + field_ids[i]).length > 0) {
          var field_value = $('#' + field_ids[i]).val();
          if (field_value === "" || field_value == null){

              $("#" + field_ids[i]).parent().find("input").addClass("invalid");
              $("#select2-"+field_ids[i]+"-container").parent().css({
                        "border-bottom":"1px solid red",
                        "border-radius":"3px",
                        "height":"26px"
                    
                    });
              is_error = 'yes';
          }else{
              $("#select2-"+field_ids[i]+"-container").parent().css({
                        "border-bottom":"1px solid #9e9e9e",
                        "border-radius":"3px",
                        "height":"26px"
                    });
              $("#" + field_ids[i]).parent().find("input").removeClass("invalid");
          }
        }
    }
    return is_error;
}

/*
Developer Name :Nilay
used for email validation on keypress 
*/
$(document).on("keypress",":input[type='email']",function (event){
  var charCode = event.which;
  // this condition for tab,Enter,Esc,shift,backspace
    if(charCode == 0 || charCode == 8 || charCode == 13){
            return true;
    } 
    if ((charCode < 48 && charCode > 32) || (charCode < 64 && charCode > 57) || (charCode < 97 && charCode > 90) || (charCode < 127 && charCode > 122) || charCode > 256){      
      if(charCode == 46 || charCode == 95){
          if(charCode == 46 && prevemailid == 46){
            return false;
          }
          prevemailid = charCode;
          return true
      }
      event.preventDefault(); 
      return false;
    }else{
      if(charCode == 64 && $(this).val().indexOf('@') > -1){
          return false;
      }
    prevemailid = charCode;
    return true;
    }
  });
  /*
  Developer Name :Nilay
  used : take only letters
  */
  $(document).on("keypress" ,".LetterOnly",function (event){
  var charCode = event.which;
      if(charCode == 0 || charCode == 8 || charCode == 13){
              return true;
      } 
      if ((charCode < 65 && charCode > 32) || (charCode < 97 && charCode > 90) || (charCode > 122 && charCode < 127) || charCode > 256){
          event.preventDefault(); 
          return false;
      }else{
      return true;
      }
  });
  /*
  Developer Name :Nilay
  used : take only Numbers
  */
  $(document).on("keypress" ,".NumberOnly",function (event){
  var charCode = event.which;
    // this condition for tab,Enter,Esc,shift,backspace
      if(charCode == 0 || charCode == 8 || charCode == 13){
          return true
      } 
        if (charCode > 31 && (charCode < 48 || charCode > 57)){      
         if (charCode == 32) { 
            event.preventDefault();   
         }
        return false;
      }else{
      
    return true;
  }
  });
  /*
  Developer Name :Nilay
  used : take Numbers,Letter
  */
  $(document).on("keypress" ,".NumberLetter",function (event){
  var charCode = event.which;
  // this condition for tab,Enter,Esc,shift,backspace
      if(charCode == 0 || charCode == 8 || charCode == 13){
              return true;
      }
    if (charCode < 48 || (charCode > 57 && charCode < 65) || (charCode < 97 && charCode > 90) || (charCode > 122 && charCode < 127)){      
        if(charCode == 0 || charCode == 8 || charCode == 13){
          return true
        }      
        event.preventDefault(); 
        return false;
    }else{
    return true;
    }
  });
  /*
  Developer Name :Nilay
  used : take year Format
  */
  $(document).on("keypress" ,".YearOnly",function (event){
  var charCode = event.which;
  // this condition for tab,Enter,Esc,shift,backspace
    if(charCode == 0 || charCode == 8 || charCode == 13){
            return true;
    }
    if (charCode > 31 && (charCode < 48 || charCode > 57)){      
      if(charCode == 0 || charCode == 8 || charCode == 13){
        return true
      }
      if(charCode === 45 && $(this).val().indexOf('-') == -1){
        return true;
      }
        return false;
    }else{
      return true;
    }
});
/*
Developer Name :Nilay
used : take Numbers and dot(.)
*/
$(document).on("keypress" ,".AmountOnly",function (event){
  var charCode = event.which;
  // this condition for tab,Enter,Esc,shift,backspace
    if(charCode == 0 || charCode == 8 || charCode == 13){
            return true;
    }
  if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){      
         if (charCode == 32) { 
            event.preventDefault();   
         }
        return false;
      }else{
        if(charCode == 46 && $(this).val().indexOf('.') > -1){
        return false;
      }
    return true;
  }
});
/*
Developer Name :Nilay
used : Maximum value Validation with Decimal Value
*/
$(document).on("keyup" ,".AmountOnly",function (event){
    var attr = $(this).attr('max');
    var decimal = parseInt($(this).attr('decimal-length'));
      if(typeof decimal !== typeof undefined && decimal !== false){
        window.intOnly = 'false';
        decimal += 1;
      }else{
        window.intOnly = 'true';
        decimal = 3;
      }
      if(typeof attr !== typeof undefined && attr !== false){
        window.returnflag = false;
        var thisJ = $(this);
        var max = thisJ.attr("max") * 1;
        var min = 0;
        window.intOnly = String(window.intOnly).toLowerCase() == "true";
            var test = function (str) {
              
              if(str.substring(str.indexOf('.')).length > decimal){
                window.returnflag=false;
                return false;
              }
            return str == "" || window.returnflag ||  (window.intOnly && str == ".") ||  ($.isNumeric(str) && str * 1 <= max && str * 1 >= min && (!window.intOnly || str.indexOf(".") == -1) && str.match(/^0\d/) == null);
            // commented out code would allow entries like ".7"
        };
            thisJ.keydown(function () {
                var str = thisJ.val();
                if (test(str)) 
                    thisJ.data("dwnval", str);
            });
            thisJ.keyup(function () {
                var str = thisJ.val();
                if (!test(str)) 
                    thisJ.val(thisJ.data("dwnval"));
            });
      }
  });
$(document).on("click",".ChangeFilter",function(){
  var filter_option = $(this).val();
  var mydiv = $(this).attr('data-div');
  if(typeof mydiv === "undefined"){
      mydiv = "";
  }else{
    mydiv = "#"+mydiv;
  }
  if(filter_option == "Filter"){ 
    setTimeout(function(){
        $(mydiv+" .SearchAction.card-panel input").first().focus();
        }, 500);
    $(mydiv+" .SearchAction").show();
    $(mydiv+" .FieldDisplay").removeClass("mdi-hardware-keyboard-arrow-down" )
    $(mydiv+" .FieldDisplay").addClass( "mdi-hardware-keyboard-arrow-up" );
  }else{
    $(mydiv+" .SearchAction").find("input[type=text],input[type=password],input[type=email], textarea").not(".select-wrapper input").val("");
    $(mydiv+" .SearchAction").find("select.select_materialize").val('').material_select();
    $(mydiv+" .SearchAction").find("select.select2_class").val('').trigger('change');
    $(mydiv+" .SearchAction").find('input').not('.select-wrapper input').parent('.input-field').find("label.active").removeClass('active');
    $(mydiv+' .SearchAction input[type="radio"][value="-1"],.SearchAction input[type="radio"][value="All"]').prop("checked", true);
    $(mydiv+" .SearchAction").hide();
    $(mydiv+" .SearchAction .SearchSubmit").click();
    $(mydiv+" .FieldDisplay").removeClass("mdi-hardware-keyboard-arrow-up" )
    $(mydiv+" .FieldDisplay").addClass( "mdi-hardware-keyboard-arrow-down" );
  }         
})
$(document).on("click",".FieldDisplay",function(){
  var mydiv = $(this).attr('data-div');
  if(typeof mydiv === "undefined"){
      mydiv = "";
  }else{
    mydiv = "#"+mydiv;
  }
  if($(mydiv+" .FieldDisplay").hasClass('mdi-hardware-keyboard-arrow-down')){
      setTimeout(function(){
        $(mydiv+" .SearchAction input").first().focus();
      }, 500);
      $(mydiv+" .ChangeFilter[value='Filter']").click();
      $(mydiv+" .FieldDisplay").removeClass("mdi-hardware-keyboard-arrow-down" )
      $(mydiv+" .FieldDisplay").addClass( "mdi-hardware-keyboard-arrow-up" );
  }else{
      $(mydiv+" .FieldDisplay").removeClass("mdi-hardware-keyboard-arrow-up" )
      $(mydiv+" .FieldDisplay").addClass( "mdi-hardware-keyboard-arrow-down" );
      $(mydiv+" .ClearAllFilter").click();
      return;
  }  
});
$(document).on("click",".ClearAllFilter",function(){
  var mydiv = $(this).attr('data-div');
  if(typeof mydiv === "undefined"){
      mydiv = "";
  }else{
    mydiv = "#"+mydiv;
  }
  $(mydiv+" .ChangeFilter[value='All']").click();
});


// End Advance Search Functions
// Start Image upload Chnages 
$(document).on("change","input.csv[type='file']",function (event){
  if($(this).val() != ""){
      var ext = $(this).val().split('.').pop().toLowerCase();
      if($.inArray(ext, ['csv']) == -1) {
          $("#Editimportgroup").val('');
          alertify.error("Upload only .csv formats");
          return false;
      }
  }  
});

$(document).on("change","input.images[type='file']",function (event){
  var cross = $(this).attr('data-cross');
  var img = $(this).attr('data-img');
  var edit = $(this).attr('data-edit');
  if($(this).val() != ""){
    var ext = $(this).val().split('.').pop().toLowerCase();
    if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
        alertify.error("Upload only .jpeg, .png, .jpg formats");
        $(this).val('');
        $('#'+cross).addClass('hide');
        $('#'+edit).val('');
        var path = base_url+"assets/admin/img/noimage.gif";
        $('#'+img).attr("src",path);
        return false;
    }else{
        var filepath = $(this).val();
        var filename = filepath.substr(filepath.lastIndexOf('\\') + 1);
        if($("#"+edit).val() == ""){
          $("#"+edit).val(filename);
        }
        $('#'+cross).removeClass('hide');
        readURL(this,img);
    }
  }
});

$(document).on("click",".cross1",function() {
  var img = $(this).attr('data-img');
  var file = $(this).attr('data-file');
  var edit = $(this).attr('data-edit');

  var path = base_url+"assets/admin/img/noimage.gif";
  $('#'+file).val('');
  $('#'+edit).val('');
  $('#'+img).attr("src",path);
  $(this).addClass('hide');
});
// End 
function isEmail(Email){
    var re = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    var flag = re.test(Email);
    return flag;
}
function isPassword(Password){
  var digitcount = Password.replace(/[^0-9]/g,"").length;
  var alphacount = Password.replace(/[^a-zA-Z]/g,"").length;
  var specialcount = (Password.match(/[@#$%^&*~`()_+\-=\[\]{};':"\\|,.<>\/?]/g) || []).length;
  if(Password.length < 8){
    return 1;
  }
  if(Password.length > 32){
    return 1;
  }
  if(digitcount == 0 || alphacount == 0 || specialcount == 0){
    return 1;
  }
  return 0;
}

function isUrlValid(url) {
    var re = /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
  var flag = re.test(url);
  return flag;
}

/*$("textarea").on("keyup" ,function (event){
  
  var max = $(this).attr('maxlength');
  var mylg = this.value.length;
  if(mylg == 0) {
    $(this).parent().find('p').html('');
    return true;
  }
  var ctxt = "You have used " + this.value.length + " of "+ max +" characters";
  var cnt = $(this).parent().find('p').length;
  if(cnt == 0){
    $(this).parent().append("<p class='txtcheck'></p>");
  }
  $(this).parent().find('p').html(ctxt);
});*/

/*
Developer Name :Nilay
used for mobile on keypress 
*/

$(document).on("keypress",".MobileNo" ,function (event){
  var charCode = event.which;
    // this condition for tab,Enter,Esc,shift,backspace
    if(charCode == 0 || charCode == 8 || charCode == 13){
            return true;
    }
    if(charCode == 43 ){
    var cnt = $(this).val().length;
      if(cnt == 0){
        return true;  
      }
    } 
    if (charCode > 31 && (charCode < 48 || charCode > 57)){      
     if (charCode == 32) { 
        event.preventDefault();   
     }
      return false;
    }else{
      return true;
    }
  });
function ResetDiv(Div = '',IsClass = 0,NoAppy = "#lorem"){
  if(IsClass == 0){
    Div = "#" + Div;
  }else{
    Div = "." + Div;
  }
  $(Div).find("input[type=text],input[type=password],input[type=email], textarea").not(".select-wrapper input,"+NoAppy).val("");
  $(Div).find("select.select_materialize").not(NoAppy).val('').material_select();
  $(Div).find("select.select2_class").not(NoAppy).val('').trigger('change');
  $(Div).find('input').not('.select-wrapper input').not(NoAppy).parent('.input-field').find("label.active").removeClass('active');
  $(Div+' input[type="radio"][value="-1"],input[type="radio"][value="All"]').not(NoAppy).prop("checked", true);
}
function isWebsiteURL(website){
 var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
 flag = urlregex.test(website);
  return flag;
}




$(document).on("change","input.imagespdf[type='file']",function (event){
  var cross = $(this).attr('data-cross');
  var img = $(this).attr('data-img');
  var edit = $(this).attr('data-edit');
  if($(this).val() != ""){
    var ext = $(this).val().split('.').pop().toLowerCase();
    if($.inArray(ext, ['png','jpg','jpeg','pdf']) == -1) {
        alertify.error("Upload only .jpeg, .png, .jpg, .pdf formats");
        $(this).val('');
        $('#'+cross).addClass('hide');
        $('#'+edit).val('');
        var path = base_url+"assets/admin/img/noimage.gif";
        $('#'+img).attr("src",path);
        return false;
    }else{
        var filepath = $(this).val();
        var filename = filepath.substr(filepath.lastIndexOf('\\') + 1);
        if($("#"+edit).val() == ""){
          $("#"+edit).val(filename);
        }
      if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
        var path = base_url+"assets/admin/img/noimage.gif";
        $('#'+img).attr("src",path);
      }else{
        $('#'+cross).removeClass('hide');
        readURL(this,img);
      }
        
    }
  }
});


function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}