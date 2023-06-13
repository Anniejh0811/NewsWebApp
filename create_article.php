<?php
var_dump($_POST);

$conn = new mysqli("localhost","root","root","THENEWS","8889");

$filtered = array(
    'title'=>mysqli_real_escape_string($conn, $_POST['title']),
    'pic'=>mysqli_real_escape_string($conn, $_POST['pic']),
    'content'=>mysqli_real_escape_string($conn, $_POST['content']),
    'topic'=>mysqli_real_escape_string($conn, $_POST['topic']),
    'likes'=>mysqli_real_escape_string($conn, $_POST['likes']),
    'hates'=>mysqli_real_escape_string($conn, $_POST['hates']),
    'recommended'=>mysqli_real_escape_string($conn, $_POST['recommended']),
    // 'created'=>mysqli_real_escape_string($conn, $_POST['created']),
    'breakingNews'=>mysqli_real_escape_string($conn, $_POST['breakingNews']),
    'author'=>mysqli_real_escape_string($conn, $_POST['author'])
);

$sql = "
  INSERT INTO newsarticle
    (title, pic, content, topic, likes, hates, recommended, created, breakingNews, author)
    VALUES(
        '{$filtered['title']}',
        '{$filtered['pic']}',
        '{$filtered['content']}',
        '{$filtered['topic']}',
        {$filtered['likes']},
        {$filtered['hates']},
        {$filtered['recommended']},
        NOW(),
        {$filtered['breakingNews']},
       ' {$filtered['author']}'

    )
";
// die($sql);
$result = mysqli_query($conn, $sql);
if($result === false){
  echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
} else {
  echo '성공했습니다. <a href="index.php">돌아가기</a>';
}

?>