// JavaScript Document
// common lib
// 認証碼產生函數，配合imagecode.php
// 範例
// gencode01(55,30,10,6,"black","white",5,50,"yzm2","new");
//codewidth=影象寬
//codeheight=影像高
//ftx=文字定位x
//fty=文字定位y
//bgcolor=影像背景顏色black,white,gray,green,red,blue可用
//ftcolor=文字顏色black,white,gray,green,red,blue可用
//ftsize=文字大小
//codecomplex=碼畫面複雜度1-200
//wfield=要寫入的欄位id
//selmod=選擇模式(new：第一次產生，renew：更新認証碼)
function gencode01(codewidth,codeheight,ftx,fty,bgcolor,ftcolor,ftsize,codecomplex,wfield,selmode){
	var num1=Math.round(Math.random()*1000000);//随机小数放大
 	var num=num1.toString().substr(0,4);//取4位整数
 	var yzm2=document.getElementById(wfield);
	if(selmode=="new"){
		document.write("<img name='codeimg' id='codeimg' src='/php/imagecode.php?num="+num+"&codewidth="+codewidth+"&codeheight="+codeheight+"&ftx="+ftx+"&fty="+fty+"&bgcolor="+bgcolor+"&ftcolor="+ftcolor+"&ftsize="+ftsize+"&codecomplex="+codecomplex+"'>");
 	}
	else {
		document.codeimg.src="/php/imagecode.php?num="+num+"&codewidth="+codewidth+"&codeheight="+codeheight+"&ftx="+ftx+"&fty="+fty+"&bgcolor="+bgcolor+"&ftcolor="+ftcolor+"&ftsize="+ftsize+"&codecomplex="+codecomplex;
	}
		
	yzm2.value=num;
}
function gencode02(codewidth,codeheight,ftx,fty,bgcolor,ftcolor,ftsize,codecomplex,wfield,selmode){
	var num1=Math.round(Math.random()*1000000);//随机小数放大
 	var num=num1.toString().substr(0,4);//取4位整数
 	var yzm2=document.getElementById(wfield);
	if(selmode=="new"){
		document.write("<img name='codeimg02' id='codeimg02' src='/php/imagecode.php?num="+num+"&codewidth="+codewidth+"&codeheight="+codeheight+"&ftx="+ftx+"&fty="+fty+"&bgcolor="+bgcolor+"&ftcolor="+ftcolor+"&ftsize="+ftsize+"&codecomplex="+codecomplex+"'>");
 	}
	else {
		document.codeimg02.src="/php/imagecode.php?num="+num+"&codewidth="+codewidth+"&codeheight="+codeheight+"&ftx="+ftx+"&fty="+fty+"&bgcolor="+bgcolor+"&ftcolor="+ftcolor+"&ftsize="+ftsize+"&codecomplex="+codecomplex;
	}
		
	yzm2.value=num;
}
//認證碼產生generateCode(characters) ，characters產生的字元長度
function generateCode(characters) {
        /* list all possible characters, similar looking characters and vowels have been removed */
        var possible = '23456789bcdfghjkmnpqrstvwxyz';
        var code = '';
        var i = 0;
		var len=possible.length;
        while (i < characters) { 
            // code += substr(possible, mt_rand(0, strlen(possible)-1), 1);
			code=code+possible.substr(Math.floor(Math.random()*len),1);
            i++;
        }
        return code;
}
// JavaScript Document
// common lib
// 認証碼產生函數，配合CaptchaSecurityImages.php
// 範例
// getcaptcha_img(影象寬,影象高,亂數字碼長度，"影像背景顏色16進位","文字顏色16進位",雜訊顏色16進位,50,"yzm2","new");
//codewidth=影象寬
//codeheight=影像高
//ftx=文字定位x
//fty=文字定位y
//bgcolor=影像背景顏色black,white,gray,green,red,blue可用
//ftcolor=文字顏色black,white,gray,green,red,blue可用
//ftsize=文字大小
//codecomplex=碼畫面複雜度1-200
//wfield=要寫入的欄位id
//selmod=選擇模式(new：第一次產生，renew：更新認証碼)
function getcaptcha_img(width,height,chart,hex_bg_color,hex_text_color,hex_noise_color,wfield,selmode){
	var rand=generateCode(chart);	
 	var yzm2=document.getElementById(wfield);
	if(selmode=="new"){
		document.write("<img name='codeimg03' id='codeimg03' src='CaptchaSecurityImages.php?width="+width+"&height="+height+"&characters="+chart+"&hex_bg_color="+hex_bg_color+"&hex_text_color="+hex_text_color+"&hex_noise_color="+hex_noise_color+"&code="+rand+"'>");
 	}
	else {
		document.codeimg03.src="CaptchaSecurityImages.php?width="+width+"&height="+height+"&characters="+chart+"&hex_bg_color="+hex_bg_color+"&hex_text_color="+hex_text_color+"&hex_noise_color="+hex_noise_color+"&code="+rand;
	}
	yzm2.value=rand;
}

/*
// <script type="text/javascript">
//check form 表單參數檢查
//起動參數
//
// YY_checkform('表單名稱','欄位名稱','檢查參數','控制訊息','錯誤訊息',......一直設定所有欄位);return document.MM_returnValue
// 檢查參數
	#1_100=數字1-100間(手機：#0_9999999999)
	#q=需要輸入值，值不限
	S=需要輸入email格式
  ^\([0-9][0-9]\)\/\([0-9][0-9]\)\/\([0-9]{4}\)$#2#1#3=日期dd/mm/yyyy
  ^\([0-9][0-9]\)\\-\([0-9]{4}\)$#3#1#2 =日期mm-yyyy，值取得阵列只有2个，dd=没有设定#3,mm=#1,yyyy=#2
  ^\(0[0-9]|1[0-9]|2[0-3]\)\:\([0-5][0-9]\)$','4'=時間24:59(24小時制)，同时可用来检查通用格式比对
  ^\([0-9]{10}\)$','4'=10码比对手机门号  
	#field=需相同內容的欄位名稱
// 控制訊息
	0：文字
	1：數字
	2：需要輸入email格式
	3：日期
	4：時間，同时可用来检查通用格式比对
	6：配合檢查參數的欄位名稱，內容需相同#field
// 例：
// <form onsubmit="YY_checkform('form1','id','#1_100','1','Field \'id\' is not valid.','username','#q','0','Field \'username\' is not valid.','mobile','#1_9','1','Field \'mobile\' is not valid.','special','S','2','Field \'special\' is not valid.','ordertime','^\([0-9][0-9]\)\/\([0-9][0-9]\)\/\([0-9]{4}\)$#2#1#3','3','Field \'ordertime\' is not valid.','captcha','#recaptcha','6','Field \'captcha\' is not valid.','select','#q','1','Field \'select\' is not valid.');return document.MM_returnValue">
// 最後YY_checkform需加上return document.MM_returnValue
// javascript程式如下：
*/
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function YY_checkform() { //v4.65
//copyright (c)1998,2002 Yaromat.com
  var args = YY_checkform.arguments; var myDot=true; var myV=''; var myErr='';var addErr=false;var myReq;
  for (var i=1; i<args.length;i=i+4){
    if (args[i+1].charAt(0)=='#'){myReq=true; args[i+1]=args[i+1].substring(1);}else{myReq=false}
    var myObj = MM_findObj(args[i].replace(/\[\d+\]/ig,""));
    myV=myObj.value;
    if (myObj.type=='text'||myObj.type=='password'||myObj.type=='hidden'){
      if (myReq&&myObj.value.length==0){addErr=true}
      if ((myV.length>0)&&(args[i+2]==1)){ //fromto
        var myMa=args[i+1].split('_');if(isNaN(parseInt(myV))||myV<myMa[0]/1||myV > myMa[1]/1){addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==2)){
          var rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-z]{2,4}$");if(!rx.test(myV))addErr=true;
      } else if ((myV.length>0)&&(args[i+2]==3)){ // date
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);
        if(myAt){
          var myD=(myAt[myMa[1]])?myAt[myMa[1]]:1; var myM=myAt[myMa[2]]-1; var myY=myAt[myMa[3]];
          var myDate=new Date(myY,myM,myD);
          if(myDate.getFullYear()!=myY||myDate.getDate()!=myD||myDate.getMonth()!=myM){addErr=true};
        }else{addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==4)){ // time
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);if(!myAt){addErr=true}
      } else if (myV.length>0&&args[i+2]==5){ // check this 2
            var myObj1 = MM_findObj(args[i+1].replace(/\[\d+\]/ig,""));
            if(myObj1.length)myObj1=myObj1[args[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!myObj1.checked){addErr=true}
      } else if (myV.length>=0&&args[i+2]==6){ // the same	  
            var myObj1 = MM_findObj(args[i+1]);
            if(myV!=myObj1.value){addErr=true}
      } else if (myV.length>=0&&args[i+2]==7){ // the same 允许栏位空白比对
		  	addErr=false;
            var myObj1 = MM_findObj(args[i+1]);
            if(myV!=myObj1.value){addErr=true}
      }
    } else
    if (!myObj.type&&myObj.length>0&&myObj[0].type=='radio'){
          var myTest = args[i].match(/(.*)\[(\d+)\].*/i);
          var myObj1=(myObj.length>1)?myObj[myTest[2]]:myObj;
      if (args[i+2]==1&&myObj1&&myObj1.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
      if (args[i+2]==2){
        var myDot=false;
        for(var j=0;j<myObj.length;j++){myDot=myDot||myObj[j].checked}
        if(!myDot){myErr+='* ' +args[i+3]+'\n'}
      }
    } else if (myObj.type=='checkbox'){
      if(args[i+2]==1&&myObj.checked==false){addErr=true}
      if(args[i+2]==2&&myObj.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
    } else if (myObj.type=='select-one'||myObj.type=='select-multiple'){
      if(args[i+2]==1&&myObj.selectedIndex/1==0){addErr=true}
    }else if (myObj.type=='textarea'){
      if(myV.length<args[i+1]){addErr=true}
    }
    if (addErr){myErr+='* '+args[i+3]+'\n'; addErr=false}
  }
  // if (myErr!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+myErr)}
	if (myErr!=''){alert(myErr);}
  document.MM_returnValue = (myErr=='');
}
