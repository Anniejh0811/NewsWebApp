<?php
$conn = new mysqli("localhost","root","root","THENEWS","8889");
if($_POST['collName'] != NULL){
    echo $_POST['collName'];
    $filtered = array(
        'collName'=>mysqli_real_escape_string($conn, $_POST['collName']),
    );
    
    $sql11 = "
        ALTER TABLE collection_table
        ADD {$filtered['collName']} INT NULL;
    ";

    echo $sql11;
    // die($sql);
    $result11 = mysqli_query($conn, $sql11);
    if($result11 === false){
      echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
      error_log(mysqli_error($conn));
    } else {
      echo '성공했습니다. <a href="index.php">돌아가기</a>';
      echo '<script>window.location.href = "saved.php";</script>';
    }
    
    
    
    }


?>