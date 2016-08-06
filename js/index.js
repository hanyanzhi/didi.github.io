$(function(){
    function preloadimages(obj, complete_cb, progress_cb) {
        var loaded = 0;
        var toload = 0;
        var images = obj instanceof Array ? [] : {};
        toload = obj.length;
        for (var i = 0; i < obj.length; i++) {
            images[i] = new Image();
            images[i].src = obj[i];
            images[i].onload = load;
            images[i].onerror = load;
            images[i].onabort = load;
        }
        if (obj.length == 0) {
            complete_cb(images);
            console.log(images);
        }
        function load() {
            ++loaded;
            if (progress_cb) {
                progress_cb(loaded / toload);
            }
            if (loaded >= toload) {
                complete_cb(images);
            }
        }
    }
    var preloadImageList = [
       'dialog_fail_.png',
       'dialog_success.png',
       'page_cai_bg.jpg',
       'page_cai_collection2.png',
       'page_cai_collection3.png',
       'page_cai_collection4.png',
       'page_great_eye.png',
       'page_home-bg.jpg',
       'page_home_btn.png',
       'page_home_car.png',
       'page_home_identify.png',
       'page_home_intro.png',
       'page_home_true.png',
       'page_level1_fail.jpg',
       'page_level1_icon.jpg',
       'page_level1_list.jpg',
       'page_level2_fail.jpg',
        'page_level2_icon.jpg',
       'page_level2_list.jpg',
       'page_level3_fail.jpg',
       'page_level3_icon.jpg',
       'page_level3_list.jpg',
       'page_level4_fail.jpg',
       'page_level4_icon.jpg',
       'page_level4_list.jpg',
       'page_level5_fail.jpg',
       'page_level5_icon.jpg',
       'page_loading_bg.jpg',
       'page_loading_car.png',
       'page_result_bad_bg.jpg',
       'page_result_great_bg.jpg',
       'page_result_ok_arrow.png',
       'page_result_ok_bg.jpg',
       'page_result_ok_heng.png',
       'page_share_guide.png'
    ];

    for (var i = 0; i < preloadImageList.length; i++) {
        preloadImageList[i] = 'images/' + preloadImageList[i];
    }
    preloadimages(preloadImageList, function(images){
        setTimeout(function(){
            $('#loading').hide();
            $('#home').show();
        },1000)
    },function(progress){
        var v ='translate('+(-20*progress)+'rem)';
        $('.car').css({
            transform: v,
            webkitTransform: v
        });
        $('.progress').text((progress*100).toFixed(0)+'%');
    })

    // 背景音乐按钮
    $(document).on('touchstart','.music_open',function(){
        $(this).removeClass('music_open');
        $(this).addClass('music_close');
        $('audio')[0].pause();
    })
    $(document).on('touchstart','.music_close',function(){
        $(this).addClass('music_open');
        $(this).removeClass('music_close');
        $('audio')[0].play();
    })
    // 开始吧
    $('.begin_btn').on('touchstart',function(){
        $(this).closest('.page').hide();
        $('#game').show();
        $('audio')[0].play();
    })

    // word点击
    var charPositions = [
        '0% 0%','0% 2.6%','0% 5.2%','0% 7.7%','0% 10.3%','0% 12.8%','0% 15.4%','0% 18%',
        '0% 20.5%','0% 23%','0% 25.7%','0% 28.2%','0% 30.8%','0% 33.3%','0% 35.8%','0% 38.4%',
        '0% 41.1%','0% 43.6%','0% 46.1%','0% 48.7%','0% 51.3%','0% 53.8%','0% 56.4%','0% 58.9%',
        '0% 61.6%','0% 64.1%','0% 66.7%','0% 69.2%','0% 71.8%','0% 74.4%','0% 76.9%','0% 79.5%',
        '0% 82.1%','0% 84.7%','0% 87.2%','0% 89.8%','0% 92.4%','0% 95%','0% 97.5%','0% 100.1%'
    ]

    var level = 1;
    var showNum;
    var allShowNum;
    var charNum;
    var answers;
    var score = 0;
    var clickAble;
    function gamelevel(n){
        console.log('封装：'+level);
        showNum = 0;
        answers = [];
        clickAble = true;
        allShowNum = $('.answer').eq(level-1).children().length;
        $('.word-btn').removeAttr('flag');
        $('.pic img').attr('src', 'images/page_level'+n+'_icon.jpg');
        $('.answer').hide().eq(n-1).show();
        $('.answer-char').css({
            background: 'none'
        })
        $('.word img').attr('src', 'images/page_level'+n+'_list.jpg');
    }
    function showWord(){
        $('.answer').eq(level-1).children().eq(showNum).css({
            background: "url('images/cn_char-s8b150cd475.png') no-repeat",
            backgroundSize: "100% 4000%",
            backgroundPosition: charPositions[charNum]
        })
        answers.push(charPositions[charNum]);
    }
    // 每关结果判断
    function levelResult(n){
        rightAnswers=[
            '0% 10.3%,0% 18%',
            '0% 23%,0% 20.5%,0% 38.4%',
            '0% 51.3%,0% 43.6%,0% 58.9%',
            '0% 74.4%,0% 71.8%,0% 66.7%,0% 79.5%',
            '0% 92.4%,0% 97.5%,0% 89.8%,0% 82.1%'
        ]
        return rightAnswers[n].toString();
    }
    // 每一关答对
    function levelRight(n){
        rightTexts=[
            "桃花运加持,<br>这就把纯洁的拼车友谊<br>升华一下~",
            "2016年必须知道的<br>七大定律之一:<br>拼车一口价,车费不变定律",
            "你们要的虐狗套餐,<br>拼车相当于<br>两人同行一人免单!<br>上限两人哦~",
            "老板发的红包太小,<br>买不起汉堡......<br>快车我还坐得起哒~",
            "新年出门不怕堵,<br>这有一百种捷径让所有路线<br>都顺理成章!"
        ]
        $('#level-right').height($('#game').height());
        $('.right-text').html(rightTexts[n-1]);
        setTimeout(function(){
            $('#level-right').show();
        },1000)
        setTimeout(function(){
            $('#level-right').hide();
        },2500)
    }
    // 每一关打错
    function levelWrong(n){
        wrongTexts=[
            "单身怪我咯?<br>不拼哪来的爱情!",
            "这都不造哎,<br>注定一辈子吃土!",
            "除了基友,<br>你木有盆友了咩?",
            "歪!脚气很重么朋友!",
            "想象力已突破天际,<br>还是甩不掉路痴的命"
        ]
        $('.wrong-text').html(wrongTexts[n-1]);
        $('#level-wrong').height($('#game').height());
        $('.pic img').attr('src', 'images/page_level'+n+'_fail.jpg');
        setTimeout(function(){
            $('#level-wrong').show();
        },1000)
        setTimeout(function(){
            $('#level-wrong').hide();
        },2500)
    }
    //游戏结果
    // 随机获取指定范围内的函数
    function random(min,max){
        return Math.round(Math.random()*(max-min));
    }
    function gameResult(n){
        $('#game').hide();
        $('.bg_music_btn').hide();
        switch (n) {
            case 5:{
                $('#result-great').show();
                break;
            }
            case 0:case 1:{
                $('#result-bad').show();
                $('#result-bad .result-percent').css({
                    background: 'url("images/page_result_bad_'+random(0,1)+'.png") no-repeat',
                    backgroundSize: '100% 100%'
                })
                break;
            }
            case 2:case 3:case 4:{
                $('#result-ok').show();
                $('#result-ok .result-percent').css({
                    background: 'url("images/page_result_ok_'+random(0,2)+'.png") no-repeat',
                    backgroundSize: '100% 100%'
                })
                break;
            }
            default:
        }
    }
    // 游戏再来一次
    function gameAgain(){
        level = 1;
        score = 0;
        $('#game').show();
        gamelevel(level);
    }
    gamelevel(level);
    $('.word-btn').on('touchstart',function(){
        if ($(this).attr('flag') || clickAble == false) {
            return;
        }
        $(this).attr('flag', true);
        charNum = (level-1)*8 + parseInt($(this).attr('data-char'));
        showWord();
        showNum++;
        if (showNum >= allShowNum) {
            clickAble = false;
            // 判断游戏结果
            if (answers.toString() == levelResult(level-1)) {
                score++;
                levelRight(level);
            }else {
                levelWrong(level);
            }
            level++;
            if (level <= 5) {
                setTimeout(function(){
                    console.log('延迟'+level);
                    gamelevel(level);
                },2500)
            }
        }
        if (level > 5) {
            console.log('大于5'+level);
            setTimeout(function(){
                gameResult(score);
            },2500)
            return;
        }
    })
    $('.btn-prize').on('touchstart',function(){
        $(this).closest('.page').hide();
        window.location.href = 'http://gsactivity.diditaxi.com.cn/gulfstream/activity/v2/giftpackage/index?g_channel=1c40d771aa39662db4b41b2903cded35';
    })
    $('.btn-again').on('touchstart',function(){
        $(this).closest('.page').hide();
        gameAgain();
    })
    $('.btn-share').on('touchstart',function(){
        $('#share').show();
    })






})
