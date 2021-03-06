<?php /* Smarty version 2.6.25-dev, created on 2020-12-11 10:08:53
         compiled from drawPage.html */ ?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        #prize,#rest{
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: block;
            width: 320px;
            height: 40px;
            background-color: rgb(255, 255, 255);
            border-radius: 2px;
            box-shadow: rgba(0, 0, 0, 0.3) 0 0 3px 2px;
            letter-spacing: 2px;
            text-align: center;
            line-height: 40px;
        }
        #prize {
            top: 100px;
        }
        #rest {
            top: 50px;
        }
        div{
            width: 330px;
            height: 330px;
            position: relative;
            left: 50%;
            top:50%;
            transform:translate(-50%,50%);
        }
        div>span{
            float: left;
            width: 100px;
            height: 100px;
            margin: 5px;
            background: rgb(22, 186, 236);
            color: white;
            text-align: center;
            line-height: 100px;
            
        }
        div>span:nth-of-type(4){
            position: relative;
            left: 220px;
        }
        div>span:nth-of-type(5){
            position: relative;
            left: 110px;
            top:110px;
        }
        div>span:nth-of-type(6){
            position: relative;
            left: -110px;
            top:110px;
        }
        div>span:nth-of-type(8){
            position: relative;
            left: -110px;
            top:-110px;
        }
        div>span:nth-of-type(9){
            cursor: pointer;
            background: rgb(255, 148, 61);
            position: relative;
            left: -110px;
            top:-110px;
        }
        div .aa{
            background: rgb(78, 78, 78);
        }
    </style>
</head>
<body>
    <p id="rest"> 今日剩余<?php echo $this->_tpl_vars['rest']; ?>
次机会 </p>
    <p id="prize">祝您中大奖</p>
    <div>
        <span class="">一等奖</span>
        <span class="">二等奖</span>
        <span class="">三等奖</span>
        <span class="">三等奖</span>
        <span class="">二等奖</span>
        <span class="">一等奖</span>
        <span class="">三等奖</span>
        <span class="">三等奖</span>
        <span style="cursor: pointer;">开始</span>
    </div>

<script>
    var prize= document.getElementById('prize');
    var rest= document.getElementById('rest');
    var spans = document.querySelectorAll("div>span");
        function start(){
            //开启post传递
            var xhr = new XMLHttpRequest();
            // 设置属性
            xhr.open('post', 'getDraw.php', true);

            // 如果想要使用post提交数据,必须添加此行
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // 将数据通过send方法传递
            xhr.send();

            // 发送并接受返回值
            xhr.onreadystatechange = function () {
                // 这步为判断服务器是否正确响应
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var res = JSON.parse(xhr.responseText);
                    if(res.data.errno != 0 ){
                        alert(res.data.result);
                        return false;
                    }
                    spans.forEach(function(el,index){
                        if(index!=0){
                            el.classList.remove('aa'); // 清空上一次结果
                        }
                    })
                    var arr = new Array();
                    if(res.data.result == 3){//三等奖
                        arr[0] = 2;
                        arr[1] = 3;
                        arr[2] = 6
                        arr[3] = 7;
                        
                    }else if(res.data.result == 2){//二等奖
                        arr[0] = 1;
                        arr[1] = 4;
                    }else if(res.data.result == 1){//一等奖
                        arr[0] = 0;
                        arr[1] = 5;
                    }
                    var num = arr[Math.floor((Math.random()*arr.length))]
                    prize.textContent='';   
                    spans[8].style.cursor="not-allowed";
                    spans[8].onclick=null;
                    //let times=parseInt(Math.random()*(30-18+1)+18,10);

                    let time=0;     //当前的旋转次数
                    let speed=100;  //转盘速度
                        timer = setInterval(function(){
                        time++;
                        if(num > 7){
                            num = 0;
                            spans[0].classList.add('aa');
                            spans[7].classList.remove('aa');
                        }else if(num==0){
                            spans[num].classList.add('aa');
                            spans[7].classList.remove('aa');
                        }else{
                            spans[num].classList.add('aa');
                            spans[num-1].classList.remove('aa');
                        } 
                        if(time>num){
                            spans[8].onclick=start;
                            spans[8].style.cursor="pointer";
                            clearInterval(timer);
                            prize.textContent='恭喜您抽中了'+res.data.result+'等奖!!!';
                            rest.textContent='今日剩余0次机会';
                        }
                    },speed)
                }
            };
        }
    if(<?php echo $this->_tpl_vars['rest']; ?>
 != 0){
        spans[8].onclick=start;
    }else{
        spans[8].style.cursor="not-allowed";
        spans[8].onclick=null;
        
    }
</script>
</body>
</html>