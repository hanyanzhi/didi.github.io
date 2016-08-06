<?php
require_once "../jssdk.php";
$jssdk = new JSSDK("wxfa08bb4993bb6283", "7d0f26c39ca3ba58e93e3bd0349c9c7a");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>滴滴快车</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <script type="text/javascript">
    (function (doc, win) {
        var docEl = doc.documentElement,
                resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
                recalc = function () {
                    window.clientWidth = docEl.clientWidth;
                    if (!window.clientWidth) return;
                    docEl.style.fontSize = 40 * (window.clientWidth / 640) + 'px';
                    window.base = 40 * (window.clientWidth / 640);
                    document.getElementById('video_mp4').width = window.base*28.8;
                    document.getElementById('video_mp4').height = window.base*16.1;
                };

        try {
            recalc();
        } catch (e) {

        }
        if (!doc.addEventListener) return;
        win.addEventListener(resizeEvt, recalc, false);
        doc.addEventListener('DOMContentLoaded', recalc, false);
    })(document, window);
    window.canvasWidth = document.documentElement.clientWidth;
    window.canvasHeight = document.documentElement.clientHeight;
    if (document.documentElement.clientWidth/document.documentElement.clientHeight>0.66) {
     document.documentElement.style.height=document.documentElement.clientWidth/0.62+ 'px';
      document.documentElement.style.overflow="auto";

     }
    </script>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/animate.css">
</head>
<body>
    <div id="container">
        <audio src="audio/bg.mp3" autoplay loop>
            您的设备不支持播放！
        </audio>
        <div class="bg_music_btn music_open"></div>
        <div class="page" id="loading">
            <div class="inner">
                <div class="car"></div>
                <h3 class="progress">0%</h3>
            </div>
        </div>
        <div class="page" id="home" style="display: none">
            <div class="inner">
                <div class="identify animated fadeInDown"></div>
                <div class="truth animated rotateIn"></div>
                <div class="intro animated fadeIn"></div>
                <div class="home_car"></div>
                <div class="begin_btn animated fadeIn"></div>
            </div>
        </div>
        <div class="page" id="game" style="display: none">
            <div class="inner">
                <div class="pic">
                    <!-- <img src="images/page_level1_icon.jpg" alt="" /> -->
                </div>
                <div class="answer answer-level1 answer2">
                    <span class="answer-char"></span>
                    <span class="answer-char"></span>
                </div>
                <div class="answer answer-level2 answer3" style="display:none">
                    <span class="answer-char"></span>
                    <span class="answer-char"></span>
                    <span class="answer-char"></span>
                </div>
                <div class="answer answer-level3 answer3" style="display:none">
                    <span class="answer-char"></span>
                    <span class="answer-char"></span>
                    <span class="answer-char"></span>
                </div>
                <div class="answer answer-level4 answer4" style="display:none">
                    <span class="answer-char"></span>
                    <span class="answer-char"></span>
                    <span class="answer-char"></span>
                    <span class="answer-char"></span>
                </div>
                <div class="answer answer-level5 answer4" style="display:none">
                    <span class="answer-char"></span>
                    <span class="answer-char"></span>
                    <span class="answer-char"></span>
                    <span class="answer-char"></span>
                </div>
                <div class="word">
                    <div class="word-btns">
                        <span class="word-btn" data-char="0"></span>
                        <span class="word-btn" data-char="1"></span>
                        <span class="word-btn" data-char="2"></span>
                        <span class="word-btn" data-char="3"></span>
                        <span class="word-btn" data-char="4"></span>
                        <span class="word-btn" data-char="5"></span>
                        <span class="word-btn" data-char="6"></span>
                        <span class="word-btn" data-char="7"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="page result" id="result-great" style="display:none">
            <div class="inner">
                <div class="eyes left"></div>
                <div class="eyes right"></div>
                <div class="btn btn-prize"></div>
                <div class="btn btn-share"></div>
            </div>
        </div>
        <div class="page result" id="result-ok" style="display:none">
            <div class="inner">
                <div class="arrow arrowBig"></div>
                <div class="result-percent"></div>
                <div class="heng"></div>
                <div class="btn btn-prize"></div>
                <div class="btn btn-again"></div>
            </div>
        </div>
        <div class="page result" id="result-bad" style="display:none">
            <div class="inner">
                <div class="arrow arrowBig"></div>
                <div class="result-percent"></div>
                <div class="tears"></div>
                <div class="btn btn-prize"></div>
                <div class="btn btn-again"></div>
            </div>
        </div>


        <div class="layer" id="level-right" style="display:none">
            <div class="inner">
                <div class="light animated flash"></div>
                <div class="right-car"></div>
                <p class="right-text">桃花运加持,<br>这就把纯洁的拼车友谊<br>升华一下~</p>
            </div>
        </div>
        <div class="layer" id="level-wrong" style="display:none">
            <div class="inner">
                <div class="wrong-car"></div>
                <p class="wrong-text">孬！脚气很重么朋友！</p>
                <div class="rain"></div>
            </div>
        </div>
        <div class="layer" id="share" style="display:none">
            <div class="inner">
                <div class="share-guide"></div>
            </div>
        </div>


    </div>

</body>
<script type="text/javascript" src="lib/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" charset="utf-8"></script>
<script type="text/javascript">
// 测试
// $('#loading').hide();
// $('#home').hide();
// // $('#game').show();
// // $('#result-great').show();
// $('#result-ok').show();
 // $('#result-bad').show();
 wx.config({
   debug: true,
   appId: '<?php echo $signPackage["appId"];?>',
   timestamp: <?php echo $signPackage["timestamp"];?>,
   nonceStr: '<?php echo $signPackage["nonceStr"];?>',
   signature: '<?php echo $signPackage["signature"];?>',
   jsApiList: [
     // 所有要调用的 API 都要加到这个列表中
       "onMenuShareTimeline",
       "onMenuShareAppMessage",
       "onMenuShareQQ",
       "onMenuShareWeibo",
       "openLocation",
       "chooseImage",
   ]
 });
 wx.ready(function () {
   document.querySelector(".location-btn").onclick = function(){
       wx.openLocation({
           latitude: 60, // 纬度，浮点数，范围为90 ~ -90
           longitude: 100, // 经度，浮点数，范围为180 ~ -180。
           name: '宇宙', // 位置名
           address: '欢迎来到浩瀚的宇宙中', // 地址详情说明
           scale: 10, // 地图缩放级别,整形值,范围从1~28。默认为最大
           infoUrl: 'https://www.baidu.com/' // 在查看位置界面底部显示的超链接,可点击跳转
       });
   };
   document.querySelector(".upimg").onclick = function(){
       wx.chooseImage({
           count: 1, // 默认9
           sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
           sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
           success: function (res) {
               var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
           }
       });
   }
   // 分享给朋友
   wx.onMenuShareAppMessage({
       title: '画', // 分享标题
       desc: '而你就像，不远前方默默张开手的港湾。。。', // 分享描述
       link: 'http://v.yinyuetai.com/video/2571642', // 分享链接
       imgUrl: 'https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=733417015,367501698&fm=111&gp=0.jpg', // 分享图标
       type: '', // 分享类型,music、video或link，不填默认为link
       dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
       success: function () {
           // 用户确认分享后执行的回调函数
           alert("分享成功");
       },
       cancel: function () {
           // 用户取消分享后执行的回调函数
       }
   });
   // 分享到朋友圈
   wx.onMenuShareTimeline({
   title: '邓紫棋-画', // 分享标题
   link: location.herf, // 分享链接
   imgUrl: 'http://b.hiphotos.baidu.com/image/h%3D300/sign=6a5025bb29dda3cc14e4be2031e93905/b03533fa828ba61e89b5740b4634970a304e59be.jpg', // 分享图标
   success: function () {
       // 用户确认分享后执行的回调函数
       alert('分享成功');
   },
   cancel: function () {
       // 用户取消分享后执行的回调函数
   }
    });
});

</script>
</html>
