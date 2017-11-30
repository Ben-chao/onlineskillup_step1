<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>PHPのサンプル</title>
  </head>
  <body>
    <?php
      $date = date("Y/m/d H:i:s");
      print($date);
    ?>
    <br/>
    <?php
    //$iが0から10未満の間、1ずつ加算しながら繰り返し
    for($i = 0; $i < 10; $i++){
      print("$i ");
    }
    ?>
    <br/>
    <?php
    $a = 5;
    if($a == 3) {
      print("$a is 3");
    } else {
      print("$a is not 3");
    }
    ?>
    <br/>
    <?php
    //引数の文字列を2回表示する関数
    function double_print($text){
      print($text . $text);
    }

    double_print("a");
    double_print("bc");
    ?>
    <br/>
    <?php
    //$hash["one"]が"いち", $hash["two"]が"に", $hash["three"]が"さん"となる連想配列を作成
    $hash = array("one" => "いち", "two" => "に", "three" => "さん");
    $hash["four"] = "し";
    print_r($hash);
    //$hashの各要素を取り出して処理
    foreach($hash as $key => $val)
      print("$key is $val. ");
    ?>
    <br/>
    <?php
    if(preg_match('/(-?)[0-9]+(\.[0-9]+)?/', 'q-6.83p', $m)){
      print("match: $m[0] ");
      if($m[1] == "-")
        print("minus! ");
      if(isset($m[2]))
        print("decimal!");
    } else {
      print("not match");
    }
    ?>
    <br/>
    <?php
      //commentがPOSTされているなら
      if(isset($_POST["comment"])){
        //エスケープしてから表示
        $comment = htmlspecialchars($_POST["comment"]);
        print("あなたのコメントは「 ${comment} 」です。");
      } else {
    ?>
        <p>コメントしてください。</p>
        <form method="POST" action="post.php">
          <input name="comment" />
          <input type="submit" value="送信" />
        </form>
    <?php
      }
    ?> 
    <br/>
    <?php
    //mysqliクラスのオブジェクトを作成
    $mysqli = new mysqli('localhost', 'root', '', 'first');
    //エラーが発生したら
    if ($mysqli->connect_error){
      print("接続失敗：" . $mysqli->connect_error);
      exit();
    }
    ?>
    <br/>
    <?php
    //プリペアドステートメントを作成　ユーザ入力を使用する箇所は?にしておく
    $stmt = $mysqli->prepare("INSERT INTO datas (name, message) VALUES (?, ?)");
    //$_POST["name"]に名前が、$_POST["message"]に本文が格納されているとする。
    //?の位置に値を割り当てる
    $stmt->bind_param('ss', $_POST["name"], $_POST["message"]);
    //実行
    $stmt->execute();
    ?>
    <br/>
    <?php
    //datasテーブルから日付の降順でデータを取得
    $result = $mysqli->query("SELECT * FROM datas ORDER BY created DESC");
    if($result){
      //1行ずつ取り出し
      while($row = $result->fetch_object()){
        //エスケープして表示
        $name = htmlspecialchars($row->name);
        $message = htmlspecialchars($row->message);
        $created = htmlspecialchars($row->created);
        print("$name : $message ($created)<br>");
      }
    }
    ?>
</body>
</html>