<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>视频文件列表</title>
</head>
<body>
<?php
// include_once("../../config/config.php");
// // PHP 5.3 以后可以 直接用 魔术变量 __DIR__ 这个 = dirname(__FILE__)
// //echo ("这里是：" .  __DIR__ . "<br>");
// //dir_read( __DIR__);
// echo ("这里是：" .  dirname(__FILE__) . "<br>");
// dir_read(dirname(__FILE__));

// function dir_read($path){
//  if (is_dir($path)){
//   $dir = opendir($path);
//   while ($file = readdir($dir)){
//    echo ("<a href=/"". BASE_HREF. "docs/$file/">$file</a><br>");
//   }
//   closedir($dir);
//  }
//  else{
//   echo "$path 不是一个有效的目录";
//  }
// }


$files = my_scandir(dirname(__FILE__));
echo '<table width="613" border="0" cellpadding="2" cellspacing="1" >
   <thead id="trHeader">
   <tr>
    <td width="20%" bgcolor="#96E0E2">序号</td>
    <td width="80%" bgcolor="#96E0E2">视频名称</td>
    </tr>
   </thead>
   <tbody id="SignFrame" bgcolor="#96E0E2">';
for ($i = 0; $i < count($files); $i++) {
    echo '<tr>';
    echo "<td >" . $i . "</td>";
    // echo '<td onclick="/video.html?/src="/video/'.basename($files[$i]).'">'.basename($files[$i]).'</td>';
    echo '<td><a href=/video.html?src=/video/' . basename($files[$i]) . '>' . basename($files[$i]) . '</a></td>';
    echo '</tr>';
}
echo '</tbody>
</table>';
// for($i=0;$i<count($files);$i++){
//     echo "<td >".$i."</td><a href='#' onclick=''>".$files[$i]."</a>";

// }


function my_scandir($path)
{
    $filelist = array();
    if ($handle = opendir($path)) {
        while (($file = readdir($handle)) !== false) {
            if ($file != "." && $file != "..") {
                if (is_dir($path . "/" . $file)) {
                    $filelist = array_merge($filelist, my_scandir($path . "/" . $file));
                } else {
                    $extend = extend($file);
                    if (strcasecmp($extend, "mkv") == 0 || strcasecmp($extend, "mp4") == 0 || strcasecmp($extend, "mp3") == 0) {
                        $filelist[] = $path . "/" . $file;
                    }
                }
            }
        }
    }
    closedir($handle);
    return $filelist;
}

function extend($file)
{
    return substr(strrchr($file, '.'), 1);
}

?>
</body>
</html>