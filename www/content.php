<td>CONTENT
    <?php
    echo '<br>'.$varContent;
    ?>
   <form action="/lessons/calcresult.php"> <!-- method get-->
        <input type="text" name="x1">
        <select name="operation">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <input type="text" name="x2">
        <input type="submit">
    </form>
</td>
</tr>
<?php
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 02.08.2018
 * Time: 21:51
 */