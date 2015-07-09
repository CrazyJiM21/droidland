var xmlhttp
	/*@cc_on @*/
	/*@if (@_jscript_version >= 5)
	  try {
	  xmlhttp=new ActiveXObject("Msxml2.XMLHTTP")
	 } catch (e) {
	  try {
	    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")
	  } catch (E) {
	   xmlhttp=false
	  }
	 }
	@else
	 xmlhttp=false
	@end @*/
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	 try {
	  xmlhttp = new XMLHttpRequest();
	 } catch (e) {
	  xmlhttp=false
	 }
	}
	function myXMLHttpRequest() {
	  var xmlhttplocal;
	  try {
	    xmlhttplocal= new ActiveXObject("Msxml2.XMLHTTP")
	 } catch (e) {
	  try {
	    xmlhttplocal= new ActiveXObject("Microsoft.XMLHTTP")
	  } catch (E) {
	    xmlhttplocal=false;
	  }
	 }

	if (!xmlhttplocal && typeof XMLHttpRequest!='undefined') {
	 try {
	  var xmlhttplocal = new XMLHttpRequest();
	 } catch (e) {
	  var xmlhttplocal=false;
	  alert('couldn\'t create xmlhttp object');
	 }
	}
	return(xmlhttplocal);
}

function sndReq(vote,id_num,ip_num,units) {
	var theUL = document.getElementById('unit_ul'+id_num);
	theUL.innerHTML = '<div class="loading"></div>';
    xmlhttp.open('get', 'rpc.php?j='+vote+'&q='+id_num+'&t='+ip_num+'&c='+units);
    xmlhttp.onreadystatechange = handleResponse;
    xmlhttp.send(null);	
}
function handleResponse() {
  if(xmlhttp.readyState == 4){
		if (xmlhttp.status == 200){
       	
        var response = xmlhttp.responseText;
        var update = new Array();

        if(response.indexOf('|') != -1) {
            update = response.split('|');
            changeText(update[0], update[1]);
        }
		}
    }
}
function changeText( div2show, text ) {
    var IE = (document.all) ? 1 : 0;
    var DOM = 0; 
    if (parseInt(navigator.appVersion) >=5) {DOM=1};
	if (DOM) {
        var viewer = document.getElementById(div2show);
        viewer.innerHTML = text;
    }  else if(IE) {
        document.all[div2show].innerHTML = text;
    }
}
var ratingAction = {
		'a.rater' : function(element){
			element.onclick = function(){

			var parameterString = this.href.replace(/.*\?(.*)/, "$1");
			var parameterTokens = parameterString.split("&");
			var parameterList = new Array();
			for (j = 0; j < parameterTokens.length; j++) {
				var parameterName = parameterTokens[j].replace(/(.*)=.*/, "$1"); // j
				var parameterValue = parameterTokens[j].replace(/.*=(.*)/, "$1"); // 1
				parameterList[parameterName] = parameterValue;
			}
			var theratingID = parameterList['q'];
			var theVote = parameterList['j'];
			var theuserIP = parameterList['t'];
			var theunits = parameterList['c'];
			sndReq(theVote,theratingID,theuserIP,theunits); return false;		
			}
		}
	};
Behaviour.register(ratingAction);