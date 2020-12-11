<?php /* Smarty version 2.6.25-dev, created on 2020-12-11 10:08:45
         compiled from index.html */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>有奖征集活动</title>
<style>
#tel, #code, #submit {
    color:#333;
    line-height:normal;
    font-family:"Microsoft YaHei",Tahoma,Verdana,SimSun;
    font-style:normal;
    font-variant:normal;
    font-size-adjust:none;
    font-stretch:normal;
    font-weight:normal;
    margin-top:0px;
    margin-bottom:0px;
    margin-left:0px;
    padding-top:4px;
    padding-right:4px;
    padding-bottom:4px;
    padding-left:4px;
    font-size:15px;
    outline-width:medium;
    outline-style:none;
    outline-color:invert;
    border-top-left-radius:3px;
    border-top-right-radius:3px;
    border-bottom-left-radius:3px;
    border-bottom-right-radius:3px;
    text-shadow:0px 1px 2px #fff;
    background-attachment:scroll;
    background-repeat:repeat-x;
    background-position-x:left;
    background-position-y:top;
    background-size:auto;
    background-origin:padding-box;
    background-clip:border-box;
    background-color:rgb(255,255,255);
    margin-right:8px;
    border-top-color:#ccc;
    border-right-color:#ccc;
    border-bottom-color:#ccc;
    border-left-color:#ccc;
    border-top-width:1px;
    border-right-width:1px;
    border-bottom-width:1px;
    border-left-width:1px;
    border-top-style:solid;
    border-right-style:solid;
    border-bottom-style:solid;
    border-left-style:solid;
}

#code {
    display:none;
}
.desc {
    display:-moz-inline-box; 
    display:inline-block; 
    width:150px;
    text-align:right

}
#submit {
    margin-left:160px;
    margin-top:20px;
}
.pop{width:500px; height:500px; position:absolute;left:-250px; top:-250px; border:2px solid red; }
#main {position: absolute; left:30%; top:20%}
.highlight-box{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
.highlight-area{
    position: absolute;   
    border-radius: 100px;   
    box-shadow: rgba(0,0,0,.2) 0px 0px 0px 2000px;   
    z-index: 100; 
}
.highlight-text{
    padding: 5px;
    background: #fff;
    color: #000;
    position: absolute;
    left: 100px;
    top: 70px;
    z-index: 101;
    border-radius: 5px;
}
.success {
    background-color: gray;   
    position: absolute;
    width: 300px;
    height: 220px;
    top:40%;
    left:40%
}

.md-perspective,
.md-perspective body {
    height: 100%;
    overflow: hidden;
}

.md-perspective body  {
    background: #222;
    -webkit-perspective: 600px;
    -moz-perspective: 600px;
    perspective: 600px;
}

.container {
    background: #e74c3c;
    min-height: 100%;
}

.md-modal {
    position: fixed;
    top: 50%;
    left: 50%;
    width: 50%;
    max-width: 630px;
    min-width: 320px;
    height: auto;
    z-index: 2000;
    visibility: hidden;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transform: translateX(-50%) translateY(-50%);
    -moz-transform: translateX(-50%) translateY(-50%);
    -ms-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%);
}

.md-show {
    visibility: visible;
}

.md-overlay {
    position: fixed;
    width: 100%;
    height: 100%;
    visibility: hidden;
    top: 0;
    left: 0;
    z-index: 1000;
    opacity: 0;
    background: rgba(143,27,15,0.8);
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    transition: all 0.3s;
}

.md-show ~ .md-overlay {
    opacity: 1;
    visibility: visible;
}

/* Content styles */
.md-content {
    color: #fff;
    background: #e74c3c;
    position: relative;
    border-radius: 3px;
    margin: 0 auto;
}

.md-content h3 {
    margin: 0;
    padding: 0.4em;
    text-align: center;
    font-size: 2.4em;
    font-weight: 300;
    opacity: 0.8;
    background: rgba(0,0,0,0.1);
    border-radius: 3px 3px 0 0;
}

.md-content > div {
    padding: 15px 40px 30px;
    margin: 0;
    font-weight: 300;
    font-size: 1.15em;
}

.md-content > div p {
    margin: 0;
    padding: 10px 0;
}

.md-content > div ul {
    margin: 0;
    padding: 0 0 30px 20px;
}

.md-content > div ul li {
    padding: 5px 0;
}

.md-content button {
    display: block;
    margin: 0 auto;
    font-size: 0.8em;
}

.button {
    border: none;
    padding: 0.6em 2.2em;
    background: #c0392b;
    color: #fff;
    font-family: 'Lato', Calibri, Arial, sans-serif;
    font-size: 1em;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
    display: inline-block;
    border-radius: 2px;
}

.button:hover {
    background: #A5281B;
       }
</style>
</head>
<body>
<div  id="main">
    <div>
        <span class="desc">手机号：</span><input  id="tel" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" maxlength="11" size="14" type="text" onblur="isIpone()"  placeholder="请输入您的手机号"/><input id="code"  type="text"  placeholder="请输入验证码"/>
        <input onclick="getCode()" type="button" id="btn" value="获取验证码" />
    </div>
    <br/>
    <br/>
    <div>
        <span class="desc" style="vertical-align:top;">您的寄语：</span>
        <textarea id="article" placeholder="请输入不大于500字内容" style="width:400px;height:120px"></textarea>
    </div>
    <div>
        <input onclick="sendArticle()" type="button" id="submit" value="提交你的祝福">
    </div>
</div>

<div class="md-modal md-effect-1 md-show highlight-area" id="modal-1" style="display:none">
    <div class="md-content">
        <h3 id="title">文章投递成功</h3>
        <div>
            <button class="button" onclick="turnTo()">去抽奖</button>
        </div>
    </div>
</div>
</body>
<script>
        
        
    //textarea 长度限制
    document.getElementById('article').onkeydown = function() 
    { 
         if(this.value.length >= 500) 
               event.returnValue = false; 
    } 


    //手机号验证
    function isIpone() {
        var ipone = document.getElementById("tel").value;
    　　var reg = /^((13[0-9])|(14[0-9])|(15[0-9])|(17[0-9])|(18[0-9]))[0-9]{8}$/;
    　　if(ipone != "") {
    　　　　if(reg.test(ipone) === false) {
    　　　　　　alert("手机号输入不合法");
    　　　　　　return false;
    　　　　}
    　　}else{
    　　　　alert("手机号不能为空");
    　　　　return false;
    　　}
        return ipone;
    }  

    //点击获取验证码
    function getCode(){  
        document.getElementById("btn").disabled=true;  
        ipone = isIpone();
        if(ipone == false){
            return false;
        }
        // 异步对象
        var xhr = new XMLHttpRequest();

        // 设置属性
        xhr.open('post', 'getCode.php', true);

        // 如果想要使用post提交数据,必须添加此行
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // 将数据通过send方法传递
        xhr.send('tel='+ipone);

        // 发送并接受返回值
        xhr.onreadystatechange = function () {
            // 这步为判断服务器是否正确响应
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("btn").disabled=false;  
                var res = JSON.parse(xhr.responseText);
                if(res.status == 0){//表示处理成功
                    alert(res.data.code);
                    settime();
                    var code = document.getElementById("code");
                    code.style.display = 'inline-block';
                    code.value = res.data.code;
                }else{//表示处理失败
                    document.getElementById("title").innerHTML = "手机号已注册";
                    document.getElementById("modal-1").style.display="block";
                }
                
            }
        };
    };  
    //验证码倒计时效果
    var countdown=60;  
    var _generate_code = document.getElementById("btn");  
    function settime() {  
        if (countdown == 0) {  
            _generate_code.disabled=false;    
            _generate_code.value = "获取验证码";  
            countdown = 60;  
            return false;  
        } else {  
            _generate_code.disabled=false;    
            _generate_code.value = "重新发送(" + countdown + ")";  
            countdown--;  
        }  
        setTimeout(function() {  
            settime();  
        },1000);  
    }


//提交表单
function sendArticle(){
    //防止重复点击
    document.getElementById("submit").disabled=true;
    var code = document.getElementById("code").value;
    var article = document.getElementById('article').value;
    //验证手机号
    ipone = isIpone();
    //验证验证码
    if(code == ''){
        alert("请输入验证码");
        return false;
    }
    //验证文章是否超过词数
    var xhr = new XMLHttpRequest();
    var reg1 = "/^[\u4e00-\u9fa5]+$/";//中文
    var reg2 = "/@\"^[（）！？。，《》{}【】“”·、：；‘’……]+$/";//中文标点
    var re1 = new RegExp(reg1);
    var re2 = new RegExp(reg2);
    if(re1.test(article) || re2.test(article) || article.length>500){
        aler("不能为数字或者英文，汉字数不能大于500");
    }

    // 设置属性
    xhr.open('post', 'sendArticle.php', true);

    // 如果想要使用post提交数据,必须添加此行
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // 将数据通过send方法传递
    xhr.send('tel='+ipone+'&code='+code+'&article='+article);

    // 发送并接受返回值
    xhr.onreadystatechange = function () {
        // 这步为判断服务器是否正确响应
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("submit").disabled=false;
            var res = JSON.parse(xhr.responseText);
            var statu = res.status;
            if(statu == 0){
                document.getElementById("modal-1").style.display="block";
            }else if(statu == 1000){
                //手机号已注册
                document.getElementById("title").innerHTML = "手机号已注册";
                document.getElementById("modal-1").style.display="block";
            }else{
                alert(res.data.result);
            }
        }
    };
}

function turnTo(){
    window.location.href="draw.php";
}



</script>
</html>