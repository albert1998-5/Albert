$(function () {
    // 自訂格式驗證
    jQuery.validator.addMethod("ascii", function (value, element, param) {
        var ascii =/[\u0000-\u00ff]/g;
        return this.optional(element) || (ascii.test(value));
    }, "請以半形輸入");

    jQuery.validator.addMethod("checkid", function (value, element, param) {
        var checkid = /^[a-zA-Z]$/;
        return this.optional(element) || (checkid.test(value));
    }, "帳號設定不能同密碼");

    jQuery.validator.addMethod("checkpw", function (value, element, param) {
        var checkpw = /^[0]{1}[9]{1}[0-9]{8}$/;
        return this.optional(element) || (checkpw.test(value));
    }, "至少2個英文與數字，且不含空白、雙引號、單引號、星號");

    //自訂規則 
    $('#form1').validate({
        rules: {
            uid: {
                required: true,
                maxlength:50,
                minlength:4,
                checkid: true,
                ascii:true,
            },
            email: {
                required: true,
                email: true,
                remote: 'checkemail.php',
                ascii:true,
            },
            checkemail: {
                required: true,
                equalTo: '#email',
                ascii:true,
            },
            password: {
                required: true,
                maxlength:12,
                minlength:8,
                checkpw:true,
                ascii:true,
            },
            checkpassword: {
                required: true,
                equalTo: '#password',
                ascii:true,
            },
        },
        messages: {
            uid: {
                required: '使用者名稱不得為空白',
                maxlength: '密碼最大長度為50位(4-50位英文字母、數字的組合)',
                minlength: '密碼最小長度為4位(4-50位英文字母、數字的組合)',
                checkid:'帳號設定不能同密碼',
                ascii:'請以半形輸入',
            },
            email: {
                required: '信箱不得為空白',
                email: '信箱格式有誤',
                remote: '信箱已註冊',
                ascii:'請以半形輸入',
            },
            checkemail:{
                required: '確認信箱不得為空白',
                equalTo: '兩次輸入的信箱不一致',
                ascii:'請以半形輸入',
            },
            password: {
                required: '密碼不得為空白',
                maxlength: '密碼最大長度為12位(8-12位英文字母、數字的組合)',
                minlength: '密碼最小長度為8位(8-12位英文字母、數字的組合)',
                checkpw:'至少2個英文與數字，且不含空白、雙引號、單引號、星號',
                ascii:'請以半形輸入',
            },
            checkpassword: {
                required: '確認密碼不得為空白',
                equalTo: '兩次輸入的密碼不一致',
                ascii:'請以半形輸入',
            },
        },
    });
})