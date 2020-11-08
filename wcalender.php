<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpetual calendar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/87c0ff4c0f.js" crossorigin="anonymous"></script>

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
        <?php
        
        $thismonth=date("m");
        $thismonthday=date("t");

        $year;

        if(isset($_GET['month'])){          //如果GET回傳的位置是有變數的，則回傳GET位置的變數
            $thismonth=$_GET['month'];
        }else{                               //如果GET回傳的位置是沒變數的，則為這個月的月份
            $thismonth=date('m');            //初始值在網址列是沒有變數的
        }

        if(isset($_GET['year'])){
            $thisyear=$_GET['year'];
        }else{
            $thisyear=date('Y');
        }

        if($thismonth>=12){                  //自GET回傳的資料再進行判斷後，如果月份大於12(13==>1)
            $nextmonth=1;
            $nextyear=$thisyear+1;
        }else{
            $nextmonth=$thismonth+1;        //自GET回傳的資料再進行判斷後，未超過12都以本月為基準點加一
            $nextyear=$thisyear;
        }

        if($thismonth<=1){                   //自GET回傳的資料再進行判斷後，如果月份小於1 (0==>12)
            $prevmonth=12;
            $preyear=$thisyear-1;
        }else{
            $prevmonth=$thismonth-1;        //自GET回傳的資料再進行判斷後，未低於0都以本月為基準點減一
            $preyear=$thisyear;
        } 
        
        ?>


        <h1 style="text-align:center" class="text-success my-3">Perpetual calendar</h1>
       
        <span><p class="text-center"><?php
            echo $thisyear;
        ?>年</span></p>
        
        <span><p class="text-center"><?php
            echo $thismonth;
        ?>月份</span></p>

        <div class="dis01">
        <a href="wcalender.php?year=<?=$preyear;?>&month=<?=$prevmonth;?>"><button ><i class="fas fa-angle-double-left"></i></button></a>
        <a href="wcalender.php?year=<?=$nextyear;?>&month=<?=$nextmonth;?>"><button><i class="fas fa-angle-double-right"></i></button></a>
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

        <div>
        <?php
            $firstday=strtotime($thisyear."-".$thismonth."-".'1');
            $thismonthday=date("t",$firstday);  
            $startdayweek=date("N",$firstday);   //1（表示星期一）到 7（表示星期天）
            $openday_1=$thisyear."-".$thismonth."-".$thismonthday;
            $openday=strtotime($thisyear."-".$thismonth."-".$thismonthday);
            $lastdayperweek=date("N",$openday);
            // echo "最後一天星期".$lastdayperweek;
            $everyweekq=ceil($thismonthday/7);
            // echo "<br>";
            // echo "共有".$everyweekq."週";

            $tep=0;
            if($startdayweek+floor($thismonthday/7)<$thismonthday && $lastdayperweek>0 )  //如果起始日+週*7<每月日數，加一週
            {$everyweekq=$everyweekq+1;}

            for($i=0;$i<$everyweekq;$i++){                      
                for($j=0;$j<7;$j++){                         //一週會有七天
                    
                    echo "<td>"; //製造格子
                    if((($i*7)+($j+1)-($startdayweek-1))>$thismonthday){  //$i算出來是會有幾週 $j算出來會是幾週的第幾天，這樣可以算出現在要列印的天數有沒有超過一個月的天數，這個if是如果超過的話則中斷操作，沒有else
                    break;
                    }

                    if($i==0 && $j<($startdayweek-1)){                   //在第一行的時候，先確認要印幾個空白格
                        echo "&nbsp;";  
                    }else{                                               //如果第一行就是有數字的，則直接起印數字
                        $tep=($i*7)+($j+1)-($startdayweek-1);
                        echo $tep;

                        }
                        echo "</td>";
                        if($tep==$thismonthday){
                        break;
                        }
               }

               if($tep==$thismonthday){
               break;
               }else {
                echo "</tr>";
               }
            }


                if($tep>=$thismonthday && $lastdayperweek<7){              //印結尾空白:如果日期大於等於該月份總天數且不是星期日(則印空白)
                    for($l=1;$l<(7-$lastdayperweek+1);$l++)  
                {
                    echo "<td>"; 
                    echo "&nbsp;";  
                    echo "</td>";
                }
                }
        ?>
    </table>
</body>
</html>