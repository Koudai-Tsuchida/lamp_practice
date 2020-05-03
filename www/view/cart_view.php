<!DOCTYPE html>
<html lang="ja">
<head>
//初期の設定をしている
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  //タイトルの入力
  <title>カート</title>
  //cssにて写真の大きさを設定STYLE_PATH=最初にcssにつけた名前
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'cart.css'); ?>">
</head>
<body>
//初期の設定をしている。ログインをしていた入れる。
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>カート</h1>
  <div class="container">
//メッセージを表示するようにしている。エラーか正常化。
    <?php include VIEW_PATH . 'templates/messages.php'; ?>
//カートの商品が0以上の場合、表示する
    <?php if(count($carts) > 0){ ?>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>購入数</th>
            <th>小計</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($carts as $cart){ ?>
          
          <tr>
          //写真を表示する。
            <td><img src="<?php print htmlspecialchars(IMAGE_PATH . $cart['image']);?>" class="item_image"></td>
            //名前を表示する。
            <td><?php print htmlspecialchars($cart['name']); ?></td>
            //値段を表示する。
            <td><?php print htmlspecialchars(number_format($cart['price'])); ?>円</td>
            //購入数を表示する。
            <td>
            //購入数が記載されているphpから
              <form method="post" action="cart_change_amount.php">
              //amountの数を表示
                <input type="number" name="amount" value="<?php print htmlspecialchars($cart['amount']); ?>">
                個
                //変更のボタンを装置
                <input type="submit" value="変更" class="btn btn-secondary">
                //cart_idが同じなものを変更する。
                <input type="hidden" name="cart_id" value="<?php print htmlspecialchars($cart['cart_id']); ?>">
              </form>
            </td>
            //合計金額を表示する。
            <td><?php print htmlspecialchars(number_format($cart['price'] * $cart['amount'])); ?>円</td>
            <td>
//削除するを追加
              <form method="post" action="cart_delete_cart.php">
              //削除するボタンを追加
                <input type="submit" value="削除" class="btn btn-danger delete">
                //cart_idが同じものを削除する。
                <input type="hidden" name="cart_id" value="<?php print htmlspecialchars($cart['cart_id']); ?>">
              </form>

            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      //右側表示で、合計金額を表示する。
      <p class="text-right">合計金額: <?php print number_format($total_price); ?>円</p>
      //ボタンを推したら購入完了ボタンに移動。
      <form method="post" action="finish.php">
    //購入ボタンを追加。
        <input class="btn btn-block btn-primary" type="submit" value="購入する">
      </form>
    //cartに商品が無かったら、商品がないと表示。
    <?php } else { ?>
      <p>カートに商品はありません。</p>
    <?php } ?> 
  </div>
  <script>
  //削除ボタン
    $('.delete').on('click', () => confirm('本当に削除しますか？'))
  </script>
</body>
</html>