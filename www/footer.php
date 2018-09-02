<tr>
    <td colspan="2">FOOTER
        <?php
        echo $varFooter . '<br>';
        ?>

        <form method="post" enctype="multipart/form-data" action="/lessons/editor.php"><!-- загружает файл на сервер-->
            <textarea name="textzone">
                <?php
                echo $_COOKIE['textzone'] ?? '';
                ?>
            </textarea>
            <input type="submit" name="submit1" value="post text from textarea">
            <br>
            <input type="file" name="fileName1">
            <br>
            <input type="submit" name="submit2" value="read file">
            <input type="submit" name="submit3" value="edit file">
            <input type="submit" name="submit4" value="print edited">
        </form>
    </td>
    <td colspan="2">
        <?php
        echo $_COOKIE['ar'] ?? '';
        ?>
    </td>
</tr>
</table>
<br>
    <a href="feedback.php">обратная связь</a>
<br>
</body>
</html>

<?php
return 'This is return from footer after successful require';
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 02.08.2018
 * Time: 21:52
 */