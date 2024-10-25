<form name="f0" id="f0" method="POST">
    <input type="text" name="grid_count" value="4">
    <input type="submit" name="submit">
</form>
<?php

    if(!empty($_POST['grid_count'])){
        $grid = $_POST['grid_count'];
        $grid_arr = [];

        $rowcount = 1;
?>
<table style="border:1px solid;">
    <?php 
        $cnt = ($grid*$grid)+1;
        for($i=($grid-1); $i>=0; $i--){
    ?>
    <tr>
        <?php 
            if(!($rowcount%2)){
                $cnt = ($cnt - $grid)-1;
            }
            elseif(($rowcount != 1) && ($rowcount%2)){
                $cnt = ($cnt - $grid) +1;
            }
            
            for($j=0; $j<$grid; $j++){
        ?>
        <td style="border:1px solid; margin:20px; width:80px; height:80px; text-align: center;">
            
            
            <?php
            if($rowcount%2){
                $cnt--;
            }
            else{
                $cnt++;
            }
            
            echo $cnt;?><br/>
            <?php 
            $grid_arr[$cnt] = '('.$j.','.$i.')';
            echo  $j .' : '. $i;
            ?>
        </td>
        <?php }?>
    </tr>
    <?php $rowcount++;}?>
</table>


<?php
/*echo "<pre>";
print_r($grid_arr);
echo "</pre>";*/

$p1_dice = [];
$p2_dice = [];
$p3_dice = [];

$p1_pos = [];
$p2_pos = [];
$p3_pos = [];

$p1_coo = [];
$p2_coo = [];
$p3_coo = [];

$p1 = 0;
$p2 = 0;
$p3 = 0;
$flag = 0;
$fcount = 0;

$in1 = [];
$in2 = [];
$in3 = [];
$inp1 = [];
$inp2 = [];
$inp3 = [];
while($flag == 0){
    $p1p = rand(1,6);
    if((array_sum($p1_dice) + $p1p) > ($grid*$grid)){
        array_push($in1,$p1p);
        array_push($p1_pos,$p1_pos[(count($p1_pos)-1)]);

    }
    elseif((array_sum($p1_dice) + $p1p) == ($grid*$grid)){
        $p1 = array_sum($p1_dice) + $p1p;
        array_push($p1_dice,$p1p);
        array_push($p1_pos,array_sum($p1_dice));

        $coo1 = array_sum($p1_pos);
        array_push($p1_coo,$grid_arr[$coo1]);
        $flag = 1;
        break;
    }
    else{
        $p1 = array_sum($p1_dice) + $p1p;
        array_push($p1_dice,$p1p);
        array_push($p1_pos,array_sum($p1_dice));

        $coo1 = array_sum($p1_pos);
        array_push($p1_coo,$grid_arr[$coo1]);
        
    }



    $p2p = rand(1,6);
    if((array_sum($p2_dice) + $p2p) > ($grid*$grid)){
        array_push($in2,$p2p);
        array_push($p2_pos,$p2_pos[(count($p2_pos)-1)]);
    }
    elseif((array_sum($p2_dice) + $p2p) == ($grid*$grid)){
        $p2 = array_sum($p2_dice) + $p2p;
        array_push($p2_dice,$p2p);
        array_push($p2_pos,array_sum($p2_dice));
        $coo2 = array_sum($p2_pos);
        array_push($p2_coo,$grid_arr[$coo2]);
        $flag = 1;
        break;
    }
    else{
        $p2 = array_sum($p2_dice) + $p2p;
        array_push($p2_dice,$p2p);
        array_push($p2_pos,array_sum($p2_dice));
        $coo2 = array_sum($p2_pos);
        array_push($p2_coo,$grid_arr[$coo2]);
    }


    $p3p = rand(1,6);
    if((array_sum($p3_dice) + $p3p) > ($grid*$grid)){
        array_push($in3,$p3p);
        array_push($p3_pos,$p3_pos[(count($p3_pos)-1)]);
    }
    elseif((array_sum($p3_dice) + $p3p) == ($grid*$grid)){
        $p3 = array_sum($p3_dice) + $p3p;
        array_push($p3_dice,$p3p);
        array_push($p3_pos,array_sum($p3_dice));
        $coo3 = array_sum($p3_pos);
        array_push($p3_coo,$grid_arr[$coo3]);
        $flag = 1;
        break;
    }
    else{
        $p3 = array_sum($p3_dice) + $p3p;
        array_push($p3_dice,$p3p);
        array_push($p3_pos,array_sum($p3_dice));
        $coo3 = array_sum($p3_pos);
        array_push($p3_coo,$grid_arr[$coo3]);
    }
    
}

?>

<table>
    <tr>
        <td style="border:1px solid; margin:20px; width:200px; height:30px; text-align: center;">Player No.</td>
        <td style="border:1px solid; margin:20px; width:500px; height:30px; text-align: center;">Dice Roll History</td>
        <td style="border:1px solid; margin:20px; width:500px; height:30px; text-align: center;">Position</td>
        <td style="border:1px solid; margin:20px; width:500px; height:30px; text-align: center;">Coordinate</td>
        <td style="border:1px solid; margin:20px; width:80px; height:30px; text-align: center;">Status</td>
    </tr>

    <tr>
        <td style="border:1px solid; margin:20px; width:200px; height:80px; text-align: center;">1</td>
        <td style="border:1px solid; margin:20px; width:500px; height:80px; text-align: center;"><?php echo implode(', ',$p1_dice).', '.implode(', ',$in1)?></td>
        <td style="border:1px solid; margin:20px; width:500px; height:80px; text-align: center;"><?php echo implode(', ',$p1_pos)?></td>
        <td style="border:1px solid; margin:20px; width:500px; height:80px; text-align: center;">
        
        <?php foreach($p1_pos as $key=>$val){
            echo $grid_arr[$val].' ';
        }?>
    </td>
        <td style="border:1px solid; margin:20px; width:80px; height:80px; text-align: center;"><?php 

            if(($flag == 1) && ($p1 == ($grid*$grid))){
                echo "Winner";
            }
        ?></td>
    </tr>

    <tr>
        <td style="border:1px solid; margin:20px; width:200px; height:80px; text-align: center;">2</td>
        <td style="border:1px solid; margin:20px; width:500px; height:80px; text-align: center;"><?php echo implode(', ',$p2_dice).', '.implode(', ',$in2)?></td>
        <td style="border:1px solid; margin:20px; width:500px; height:80px; text-align: center;"><?php echo implode(', ',$p2_pos)?></td>
        <td style="border:1px solid; margin:20px; width:500px; height:80px; text-align: center;">
        <?php foreach($p2_pos as $key=>$val){
            echo $grid_arr[$val].' ';
        }?>
    </td>
        <td style="border:1px solid; margin:20px; width:80px; height:80px; text-align: center;"><?
        if(($flag == 1) && ($p3 == ($grid*$grid))){
            echo "Winner";
        }
        ?>
    </td>
    </tr>

    <tr>
        <td style="border:1px solid; margin:20px; width:200px; height:80px; text-align: center;">3</td>
        <td style="border:1px solid; margin:20px; width:500px; height:80px; text-align: center;"><?php echo implode(', ',$p3_dice).', '.implode(', ',$in3)?></td>
        <td style="border:1px solid; margin:20px; width:500px; height:80px; text-align: center;"><?php echo implode(', ',$p3_pos)?></td>
        <td style="border:1px solid; margin:20px; width:500px; height:80px; text-align: center;">
        <?php foreach($p3_pos as $key=>$val){
            echo $grid_arr[$val].' ';
        }?>    
    </td>
        <td style="border:1px solid; margin:20px; width:80px; height:80px; text-align: center;"><?php
        if(($flag == 1) && ($p3 == ($grid*$grid))){
            echo "Winner";
        }
        ?></td>
    </tr>
</table>

<?php
    }
?>
