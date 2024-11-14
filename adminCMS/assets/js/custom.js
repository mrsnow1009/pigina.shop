/* ********************************** */
/* menu-left */
function menuLeft(){
	$('#nav-left,#container-wrapper').toggleClass('nav-hide');
}
jQuery( document ).ready( function () {
	/* ********************************** */
	/* menu-left */
	if(screen.width < 768){
		$('#nav-left,#container-wrapper').addClass('nav-hide');
	}
});

/* tooltip */
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

/* validation */
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()

/* email invalid */
function isValidEmail(str) {
  return (str.indexOf('@') > 0) && (str.lastIndexOf('.') > str.indexOf('@')) && (str.lastIndexOf('.') < (str.length-1));
}	

/******************* conver to seo, format: duong-dan-seo *****************************/ 
function convertVNstring(str) {
  str= str.toLowerCase();
  str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
  str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
  str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
  str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
  str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
  str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
  str= str.replace(/đ/g,"d");
  str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-"); /* tim va thay the cac ki tu dac biet trong chuoi sang ki tu - */
  str= str.replace(/\-+\-/g,"-"); /* thay the -- thanh - */
  str= str.replace(/^\-+|\-+$/g,"");/* cat bo - o dau va cuoi chuoi */
  return str;
} 

/* check all checkbox delete in datatable */
$("#tb-checked-item").click(function(){
  $('table.table tbody').find('input.tb-checked-click:checkbox').prop('checked', this.checked);
}); 

/* delete record in datatable */
function getDelRecord(mod, id){
  var val = [];
  if(typeof id === "undefined"){
    num = $("input.tb-checked-click:checked").length;
    if(num < 1){
      alert(LANG['_NOTE_CHOOSE_OBJECT_TO_DELETE']);  
      return false;
    }
    $('input.tb-checked-click:checkbox:checked').each(function(i){
      val[i] = $(this).val();
    });
  }else{ 
    val[0] = ""+id+"";
  }
  if(confirm(LANG['_NOTE_DELETE_OBJECT'])) {
    jQuery.ajax({
      type: "POST",
      url: path_admin+"ajax_admin.php?q="+mod,
      dataType:"json",
      data: 'value='+val,
      /*  beforeSend: function(){ },*/
      success: function(data){    
        /*
        if(data.error == 'true'){
          $("#msgTips").html('<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Thông báo!</strong> Xóa đối tượng thành công.</div>').show().delay(5000).fadeOut();
          window.location.reload();
        }else{
          $("#msgTips").html('<div class="alert alert-danger fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Thông báo!</strong>Có lỗi xảy ra, vui lòng chờ giây lát và thử lại. </div>').show().delay(5000).fadeOut();
        }
        */
        alert(data.html);
        window.location.reload();
      },
      error:function (xhr, ajaxOptions){
        alert(LANG['_ERROR_TRY_AGAIN']);
        window.location.reload();
        /*
        $("#msgTips").html('<div class="alert alert-danger fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Thông báo!</strong>'  +xhr.status + ' </div>');//.show().delay(wait).fadeOut();
        */
      }   
    });
  }else return false;
}

/* start - convert number input */
function convert_number(field){
  var strk=field.value;
  str=clearDot(strk);
  var temp="";
  if (str!=""){
    var l=str.length-1;
    k=0;
    for (i=l;i>=0;i--){
      k++;
      temp= str.substr(i,1) + temp;
      if (str.substr(i,1)=="."){
        k=0;
      }
      if ((k==3)&&(i>0)){
        k=0;
        temp= "." + temp;
      }
    }
  }
  field.value=temp;
}
function clearDot(st){
  var temp="";
  if (st!=""){
    var l=st.length;
    for (i=0;i<l;i++){
      if ((st.substr(i,1)!=".")&&(st.substr(i,1)!="-")&&(!isNaN(st.substr(i,1))))
        temp= temp+st.substr(i,1);
    }
  }
  return temp;
}
/* end - convert number input */