<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpetual calendar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body{
            margin: 0;
            padding: 0;
        }

        table{
            width: 770px;
            margin: auto;
            margin-top: 30px;
            border: 1px solid darksalmon;

        }

        table td{
            width: 110px;
            border: 1px solid darksalmon;
            padding: 10px 0;
            text-align: center;
        }
        
        .dis01{
            margin: auto;
            width: 750px;
            display: flex;
            justify-content: space-between;

        }

    </style>


</head>
<body> 

        <h1 style="text-align:center" class="text-success my-3">Perpetual calendar</h1>

        <div class="dis01">
        <button type="submit" ><</button>
        <label for="month_in">
        <div style="text-align:center">
        <?php
        $a=date("m");
        echo $a."月份";
        ?>
        </div>
        </label>


        <button>></button>

        </div>
    <table>
    <tr>
        <td class="bg-info">一</td>
        <td class="bg-info">二</td>
        <td class="bg-info">三</td>
        <td class="bg-info">四</td>
        <td class="bg-info">五</td>
        <td class="bg-info">六</td>
        <td class="bg-info">日</td>
    </tr>

        <?php
            $thismonth=date("m");
            $thismonthday=date("t");
            $firstday=strtotime(date("Y-m-").'1');
            $startdayweek=date("N",$firstday); 

            $tep=0;
            for($i=0;$i<6;$i++){
                for($j=0;$j<7;$j++){

                    if($tep>=$thismonthday){
                        for($l=1;$l<($startdayweek-1);$l++)
                        {
                            echo "<td>"; 
                            echo "</td>";
                        }
                    }
                    echo "<td>"; //製造格子
                    if((($i*7)+($j+1)-($startdayweek-1))>$thismonthday){  //$i算出來是會有幾週 $j算出來會是幾週的第幾天，這樣可以算出現在要列印的天數有沒有超過一個月的天數，這個if是如果超過的話則中斷操作，沒有else
                    break;
                    }

                    if($i==0 && $j<($startdayweek-1)){
                        echo "&nbsp;";  //在第一行的時候，先確認要印幾個空白格
                    }else{ //如果第一行就是有數字的，則直接起印數字
                        $tep=($i*7)+($j+1)-($startdayweek-1);
                        echo $tep;

                    }
                    echo "</td>";
               }
               echo "</tr>";
            }
        ?>
    </table>
</body>
</html>