<div>
<h4 class="ct">預告片清單</h4>
<div class="ct" style="display:flex">
<div style="width:25%;background:#eee">預告片海報</div>
<div style="width:25%;background:#eee">預告片片名</div>
<div style="width:25%;background:#eee">預告片排序</div>
<div style="width:25%;background:#eee">操作</div>
</div>
<form action="api/edit_poster.php" method="post">
    <div style="overflow:auto;height:200px">
    <?php
$rows=$Poser->all(" order by `rank`");
foreach($rows as $row){
    ?>
    <div class="ct" style="display:flex">
<div style="width:25%;">
<img src="../img/<?=$row['path']?>" alt="">
</div>
<div style="width:25%;">
<input type="text" name="name" value="<?=$row['name']?>">
</div>
<div style="width:25%;">
<?=$row['rank']?>
</div>
<div style="width:25%;">
<input type="checkbox" name="sh[]">顯示
<input type="checkbox" name="del[]">刪除
<!-- 淡縮入如滑梯般的洞穴 -->
<select name="ani[]">
    <option value="1" <?=($row['ani']==1)?'selected':'';?>>淡入淡出</option>
    <option value="2"<?=($row['ani']==2)?'selected':'';?>>縮放</option>
    <option value="3"<?=($row['ani']==3)?'selected':'';?>>滑入滑出</option>
</select>
<input type="hidden" name="id[]" value="<?=$row['id']?>">
</div>
</div>
    <?php
}
    ?>
</div>
<div class="ct">
    <input type="submit" value="確定修改">
    <input type="reset" value="重置">
</div>
</form>

</div>
<hr>

<div>
<h4 class="ct">新增預告片海報</h4>

<form action="api/add_poster.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>預告片海報：</td>
            <td><input type="file" name="path"></td>
        </tr>
        <tr>
        <td>預告片片名：</td>
            <td><input type="text" name="name"></td>
        </tr>
    
    </table>
    <div class="ct">
    <input type="submit" value="新增"><input type="reset" value="重置"></td>
    </div>
</form>
</div>