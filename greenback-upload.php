<link rel="stylesheet" href="greenback.css">
<?php

    if (isset($_POST['upload'])) {//送信ボタンが押された場合
        if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
            $image = uniqid(mt_rand(), true);//ファイル名をユニーク化
            $image .= '.jpg';# . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得

            $img = imagecreatefrompng($_FILES['image']['tmp_name']);//画像取得
            $file = "images/$image";
            // 画像を書き出す
            imagejpeg($img, $file);
            if (exif_imagetype($file)) {//画像ファイルかのチェック
                $message = 'アップロードが完了しました！';
            } else {
                $message = '画像ファイルではありません';
            }
            

        }
    }
?>

<!-- <h1 id="title">画像アップロード</h1> -->
<div class="title"><img src="title.png"></div>
<!--送信ボタンが押された場合-->
<?php if (isset($_POST['upload'])): ?>
    <p><?php 
        echo '<div class="text">';
        echo $message;
        echo '</div>';        
    ?></p>
    <img src="https://api.qrserver.com/v1/create-qr-code/?data=https://studio.kemco.keio.ac.jp/opencampus/<?php echo $file ?>&size=100x100" alt="QRコード" id="qr" />
    <a href="greenback-upload.php" class="btn">戻る</a>
    
<?php else: ?>
    <form method="post" enctype="multipart/form-data">
        <!-- <p>アップロード画像</p> -->
        <div class="upload">
            <input id="file" type="file" name="image">
            <input id="submit" type="submit" name="upload" value="送信">
        </div>
    </form>
<?php endif;?>
