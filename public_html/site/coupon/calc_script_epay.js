function click_update(){
ajaxrequest('coupon/couponcheck.php', 'context');
setTimeout('addit()',2000);
}

function click_go() {
// wrapper function, 2 second delay
    setTimeout('addit()',2000);
}

function addit() {

//document.getElementById(groupon_code).focus();

var Groupon = $("#discCode").val();
d1 = document.fin.plan_total.value;
d2 = document.fin.facebook_like.value;
var $gc = document.getElementById('groupon_code');
if ($gc = ""){
	d3 = 0.00;
	} else {
	d3 = document.fin.groupon_code.value;
}
d4 = document.fin.final_total.value;

var num_1 = d1 * 1  //PRODUCT #xxx
var num_2 = d2 * 1  //PRODUCT #xxx
var num_3 = d3 * 1 // PRODUCT #xxx
var num_4 = d1 + d2 + d3 // PRODUCT #xxx

  document.fin.groupon_code.value = currencyPad(Groupon,10)
  var fTotal = d1 - d2 - Groupon;
document.getElementById('final_total').innerHTML = '$' + fTotal.toFixed(2);
//document.getElementById('final_total').innerHTML = '$' + fTotal;
  document.fin.final_total.value = currencyPad(fTotal,10);
  var cci = fTotal.toFixed(2);
  document.cc.ccamount.value = cci.replace(/\s/g, "");

}

function disableEnterKey(e) {
     var key;
     if(window.event)
          key = window.event.keyCode;     //IE
     else
          key = e.which;     //firefox
     if(key == 13)
          return false;
     else
          return true;
}

function currencyPad(anynum,width) {
		//returns number as string in $xxx,xxx.xx format.
		anynum = "" + eval(anynum)
		//evaluate (in case an expression sent)
                intnum=0
                if (anynum >= 1) {
        	         intnum = parseInt(anynum)
                }    
		//isolate integer portion
		intstr = ""+intnum
		//add comma in thousands place.
		if (intnum >= 1000) {
			intlen = intstr.length
			temp1=parseInt(""+(intnum/1000))
			temp2=intstr.substring(intlen-3,intlen)
			intstr = temp1+","+temp2
	        }

		if (intnum >= 1000000) {
			intlen = intstr.length
			temp1=parseInt(""+(intnum/1000000))
			temp2=intstr.substring(intlen-7,intlen)
			intstr = temp1+","+temp2        
		}
		decnum = Math.abs(parseFloat(anynum)-intnum) //isolate decimal portion
		decnum = decnum * 100 // multiply decimal portion by 100.
		decstr = "" + Math.abs(Math.round(decnum))
		while (decstr.length < 2) {
			decstr="0"+decstr
		}
		retval = intstr + "." + decstr
		if (intnum < 0) {
			retval=retval.substring(1,retval.length)
			retval="("+retval+")"        
		}       
		retval = "$"+retval
		while (retval.length < width){
			retval=" "+retval
		}
		return retval
	}