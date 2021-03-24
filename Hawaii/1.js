var code ; //在全域性定義驗證碼
    //產生驗證碼
    function createCode(){
        code = "";
        var codeLength = 4;//驗證碼的長度
        var checkCode = document.getElementById("code");
        var random = new Array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R', 'S','T','U','V','W','X','Y','Z');//隨機數
        for(var i = 0; i < codeLength; i++) {//迴圈操作
            var index = Math.floor(Math.random()*36);//取得隨機數的索引（0~35）
            code += random[index];//根據索引取得隨機數加到code上
        }
        checkCode.value = code;//把code值賦給驗證碼
    }
    //校驗驗證碼
    document.getElementById("Yzm").addEventListener("change",validate);

    function validate(){
        var inputCode = document.getElementById("Yzm").value.toUpperCase(); //取得輸入的驗證碼並轉化為大寫
        if(inputCode.length <= 0) { //若輸入的驗證碼長度為0
            alert("請輸入驗證碼！"); //則彈出請輸入驗證碼
            $("#Yzm").focus();
            YZM = false;
        }
        else if(inputCode != code ) { //若輸入的驗證碼與產生的驗證碼不一致時
            alert("驗證碼輸入錯誤！@_@"); //則彈出驗證碼輸入錯誤
            createCode();//重新整理驗證碼
            $("#Yzm").val("");//清空文字框
            $("#Yzm").focus();//重新聚焦驗證碼框
            YZM = false;
        }
        else { //輸入正確時
            $("#Yzm").blur();//繫結驗證碼輸入正確時要做的事
            YZM = true;

        }
    };