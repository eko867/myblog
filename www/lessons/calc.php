<?php

if (empty($_GET))
    return 'Empty fields';

if ($_GET['x1']=='')
    return 'Empty x1';
else if (is_numeric($_GET['x1']))
    $x1=$_GET['x1'];
else
    return 'incorrect x1';

if ($_GET['x2']=='')
    return 'Empty x2';
else if (is_numeric($_GET['x2']))
    $x2=$_GET['x2'];
else
    return 'incorrect x2';

if (empty($_GET['operation']))
    return 'Empty operation';
else
    $oper=$_GET['operation'];

switch ($oper){
    case '+':
        return $x1.'+'.$x2.'='.($x1+$x2);
        break;
    case '-':
        return $x1.'-'.$x2.'='.($x1-$x2);
        break;
    case '*':
        return $x1.'*'.$x2.'='.($x1*$x2);
        break;
    case '/':
        if ($x2!=0)
            return $x1.'/'.$x2.'='.($x1/$x2);
        else
            return 'Divide zero impossible';
        break;
    default:
        return 'Unknown operation';
        break;
}
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 04.08.2018
 * Time: 11:23
 */