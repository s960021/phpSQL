<!DOCTYPE html>
<body>
<table border="1">
<tr><th>學號</th><th>姓名</th><th>課程名稱</th>
<th>授課老師</th><th>學分數</th></tr>
<br>
<form action="" method="POST">
    學號<input type="text" size="4" name="sno"><br>
    <input type="submit" name="Submit" value="查詢"><br>
</form>
<?php
    $link=mysqli_connect("localhost","root")
        or die("無法開啟MySQL資料庫連接!<br/>");
    $dbname="myschool";
    if(!mysqli_select_db($link,$dbname))
        die("無法開啟 $dbname 資料庫<br>");
    else
        echo "資料庫 $dbname 開啟成功<br>";
    mysqli_query($link,"SET NAMES UTF8");
    if(isset($_POST["Submit"])){
        $strm=trim($_POST["sno"]);
        $sql="SELECT students.sno,students.name,courses.title,courses.pname,courses.credits FROM students,classes,courses 
            where students.sno like '%$strm%' and classes.sno like '%$strm%' and classes.cno=courses.cno";
        $rows=mysqli_query($link,$sql);
        $num=mysqli_num_rows($rows);
    }
    while($r=mysqli_fetch_row($rows)) {
        echo "<tr>";
        for($j=0; $j<mysqli_num_fields($rows); $j++) {
                echo "<td>$r[$j]</td>";
        }
        echo "</tr>";
    }
    mysqli_free_result($rows);
    mysqli_close($link);
?>
</table>
</body>