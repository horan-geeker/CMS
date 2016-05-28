<?php
/**
 * Created by PhpStorm.
 * User: He
 * Date: 2016/5/17
 * Time: 22:09
 */
print_r($_FILES);
die;
if ($_FILES['file']['errno'] == 0) {
    $fileName = $_FILES['file']['name'];
    $tempFile = $_FILES['file']['tmp_name'];
    $flag = move_uploaded_file($tempFile, $fileName);
}
if ($flag) {
    $result['errno'] = 0;
    $result['errmsg'] = '文件上传成功';
} else {
    $result['errno'] = -1;
    $result['errmsg'] = '文件上传失败';
}
$result = json_encode($result);
if (empty($callback)) {
    echo $result;
} else {
    echo '<script type="text/javascript">parent.'.$callback.'('.$result.');</script>';
}