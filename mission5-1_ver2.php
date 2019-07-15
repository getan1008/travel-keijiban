<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
        <title>好きな旅行先</title>
    </head>
<body>
    <form method="post"
          accept-charset="utf-8">
        あなたの好きな旅行先は?
        <br>
<?PHP
        //データベース接続
$username='ユーザー名';
$passwd='パスワード';
$dsn = 'データベース名';
$pdo = new PDO($dsn,$username,$passwd,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        
//テーブル作成
$sql = "CREATE TABLE IF NOT EXISTS Bulletinboard2"
	." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT,"
    . "date char(32),"
    . "passwd char(32)"
	.");";
	$stmt = $pdo->query($sql);
        
        //削除の時のパスワードが違う場合に表示される文字列
        if(isset($_POST['deletepass'])){
            $deletenumber=$_POST['deletenumber'];
            $deletepass=$_POST['deletepass'];
            //パスワードを抽出
        $id = $deletenumber;
        $sql = 'SELECT * FROM Bulletinboard2 where id=:id';
        $stmt = $pdo->prepare($sql);   
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch();
        $resultspasswd = $results['passwd'];
        if(isset($resultspasswd)){
            //パスワードをチェック
            if($resultspasswd != $deletepass){
                echo "パスワードが違います。<br>";
            }
        }
        }
        //編集の時のパスワードが違う場合に表示される文字列
           if(isset ($_POST['changepass'])){
            //パスワードを抽出
               $changenumber=$_POST['changenumber'];
               $changepass = $_POST['changepass'];
            $id = $changenumber;
            $sql = 'SELECT * FROM Bulletinboard2 where id = :id';
        $stmt = $pdo->prepare($sql); 
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch();
        $resultspasswd = $results['passwd'];
       
               //パスワードをチェック
               if(isset($resultspasswd)){
               if($resultspasswd != $changepass){
                echo "パスワードが違います。<br>";
            }
           }
           }
        $sql=null;
    $dsn=null;
?>
    
            <?PHP
//新規入力の場合
if(empty($_POST['changenumber'])){
    echo"名前：<input type='text' name='yourname'><br>";
    echo " コメント:<input type='text' name='comment'><br>";
    echo " パスワード：<input type='text' name='pass'><br>";
        }elseif(isset($_POST['changenumber'])){
        $changenumber=$_POST['changenumber'];
        $beforepass= $_POST['changepass'];
     //変更前の文字列を抽出
        $id = $changenumber;
        $sql = 'SELECT * FROM Bulletinboard2 where id =:id;';
        $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch();
        $changename = $results['name'];
        $changecomment = $results['comment'];
        $changepass = $results['passwd'];
    if($beforepass == $changepass){
        echo "名前：<input type='text' name='yourname' value='".$changename."'><br>";
        echo "コメント：<input type='text' name='comment' value='".$changecomment."'><br>";
        echo "パスワード：<input type='text' name='pass' value='".$changepass."'><br>";
        }else{
        echo"名前：<input type='text' name='yourname'><br>";
    echo " コメント:<input type='text' name='comment'><br>";
    echo " パスワード：<input type='text' name='pass'><br>";
    }
        }
         ?>
        
         <?PHP
        if(isset($_POST['changenumber']) && !empty($_POST['changepass'])){
//データベース接続
$username='ユーザー名';
$passwd='パスワード';
$dsn = 'データベース名';
$pdo = new PDO($dsn,$username,$passwd,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
     $changenumber=$_POST['changenumber'];
         $changepass=$_POST['changepass'];
            //パスワードを抽出
        $id = $changenumber;
        $sql = 'SELECT * FROM Bulletinboard2 where id =:id;';
        $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch();
        $resultspasswd = $results['passwd'];
            if($resultspasswd == $changepass && !empty($changepass)){
                 echo "<input type='hidden' name='hensyuunumber' value='".$changenumber."'>";
                    echo "編集モードです。<br>";
            } 
        }
        $sql=null;
    $dsn=null;
        ?>
        <input type="submit" name="sousin" value="送信する" >
        <br>
        
      
        削除したい番号:<input type="number" name="deletenumber">
        <br>
        パスワード：<input type="text" name="deletepass">
        <br>
        <input type="submit" name="sakujyo" value="削除"><br>
    <br>
        
    編集番号:<input type="number" name=changenumber ><br>                 
    パスワード：<input type="text" name="changepass">
        <br>
        <input type="submit" name="hensyuu" value="編集">
        </form>

<?PHP
//データベース接続
$username='ユーザー名';
$passwd='パスワード';
$dsn = 'データベース名';
$pdo = new PDO($dsn,$username,$passwd,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
//新規入力
if(isset($_POST['sousin']) && empty($_POST['hensyuunumber'])) {
if(isset($_POST['comment'],$_POST['yourname'] ))
{
$comment=$_POST['comment'];
$yourname=$_POST['yourname'];
$pass=$_POST['pass'];
 $day= date('Y年m月d日 H:i:s');
    //テーブル入力
$sql = $pdo -> prepare('INSERT INTO Bulletinboard2 (name, comment,date,passwd) VALUES (:name, :comment,:date,:passwd2)');
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment1, PDO::PARAM_STR);
    $sql -> bindParam(':date', $date , PDO::PARAM_STR);
    $sql -> bindParam(':passwd2', $passwd2, PDO::PARAM_STR);
	$name = $yourname;
	$comment1 =$comment;
    $date= $day;
    $passwd2=$pass;
    $sql -> execute();
	
}
    
}elseif(isset($_POST['sakujyo'])) {
    if(isset($_POST['deletenumber']) ){
    $deletenumber=$_POST['deletenumber'];
        $deletepass=$_POST['deletepass'];
        $id = $deletenumber;
        //パスワード抽出
        $sql = 'SELECT * FROM Bulletinboard2 where id =:id';
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch();
        $resultspasswd = $results['passwd'];
    if($resultspasswd == $deletepass && !empty($resultspasswd)) {
        //フィールドを削除
	$sql = 'delete from Bulletinboard2  where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();

        }    
             
            }    
}elseif(isset($_POST['hensyuunumber'],$_POST['sousin'])) {
     $changenumber=$_POST['hensyuunumber'];
        $comment1=$_POST['comment'];
        $yourname=$_POST['yourname'];
        $newpass=$_POST['pass'];
  
    //コメントを編集
	$sql = 'update Bulletinboard2 set name=:name,comment=:comment,passwd=:passwd where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':passwd', $passwd2, PDO::PARAM_STR);
     $id = $changenumber; 
	$name = $yourname;
	$comment = $comment1;
    $passwd2 = $newpass;
	$stmt->execute();
    }
    
    //テーブルを表示
   $sql = 'SELECT * FROM Bulletinboard2';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].',';
        echo $row['date']."<br>";
	    echo "<hr>";
	}
    $sql=null;
    $dsn=null;
   

?>  
    </body>
</html>