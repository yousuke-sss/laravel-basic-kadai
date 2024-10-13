<?php
$dsn = 'mysql:dbname=nwmyim9hmc2b2vcj;
host=q0h7yf5pynynaq54.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;
charset=utf8mb4';
$user = 'sh0dbtig658bj2t5';
$password = 'htoxakwoouep8bcm'; 
 try {
     $pdo = new PDO($dsn, $user, $password);
 
     // orderパラメータの値が存在すれば（並び替えボタンを押したとき）、その値を変数$orderに代入する
     if (isset($_GET['order'])) {
        $order = $_GET['order'];
    } else {
        $order = NULL;
    }
 
     // orderパラメータの値によってSQL文を変更する    
     if ($order === 'asc') {
        $sql = 'SELECT id, name, age FROM users ORDER BY id ASC';
    } elseif ($order === 'desc') {
        $sql = 'SELECT id, name, age FROM users ORDER BY id DESC';
    } else {
        $sql = 'SELECT id, name, age FROM users ORDER BY id';
    }

     // SQL文を実行する
     $stmt = $pdo->query($sql);
 
     // SQL文の実行結果を配列で取得する
     $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
 } catch (PDOException $e) {
     exit($e->getMessage());
 }
 ?>
 
 <!DOCTYPE html>
 <html lang="ja">
 
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>PHP+DB</title>
     <link rel="stylesheet" href="css/style.css">
 </head>
 
 <body>
     <div class="sort">
         <a href="order-by.php?order=asc" class="sort-btn">年齢順（昇順）</a>
         <a href="order-by.php?order=desc" class="sort-btn">年齢順（降順）</a>
     </div>
     <table>
         <tr>
             <th>ID</th>
             <th>氏名</th>
             <th>年齢</th>
         </tr>
         <?php
         // 配列の中身を順番に取り出し、表形式で出力する
         foreach ($results as $result) {
            $table_row = "
            <tr>
            <td>{$result['id']}</td>
            <td>{$result['name']}</td>                                
            <td>{$result['age']}</td>                                                
            </tr>
        ";
        echo $table_row;

         }
         ?>
     </table>
 </body>
 
 </html>