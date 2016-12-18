<html>
<head>
    <meta charset="UTF-8">
    <title>H5 API test</title>
    <script src="wechat.min.js"></script>
    <style>
        * { padding: 0; margin: 0;}
        .wrap {
            width: 1000px;
            padding: 50px;
            margin: 0 auto;
        }

        h1 {
            color: #666;
        }

	li {
	    font-size: 24px; 
        }

	#debug {
	    font-size: 40px;
	}
    </style>
</head>
<body>
<div class="wrap">
    <p id="debug"></p>
    <h1>Wechat API Test</h1>

    <ul>
        <li class="chooseImage"><span>选择图片</span></li>
    </ul>
</div>

<?php
    require_once "wechat_jsSDK.php";
    $jssdk = new JSSDK("wx37fcdf2b531a3be4", "c7a43b67d70bc3841685e22d856db6ac");
    $signPackage = $jssdk->GetSignPackage();
?>

<script type="text/javascript">
    /**
     *      Wechat Config
     */
function $$(selector) { return document.querySelector(selector);}    

    wx.config({
        debug: false, //  debug
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            'chooseImage'
	]
    });

wx.ready(function(){
    console.log('Success to connect to wechat server.');
    
    //  choose img
    $$('.chooseImage').onclick = function (){
        wx.chooseImage({
            success: function (res) {
                var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
            }
	});
    };	
});

wx.error(function (res) {
	document.querySelector('#debug').innerHTML = JSON.stringfy(res);
});
</script>
</body>
</html>
