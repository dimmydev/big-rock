<?php
$file = file(LOG_FAJL);
$trenutnoVreme = time();
$stranice = ['Home', 'Our beers', 'Register', 'Login', 'About Me', 'One beer'];
$stranicePosete = [0,0,0,0,0,0];
$zbir = 0;
foreach($file as $row){
    $rowData = explode("\t", $row);
    if($trenutnoVreme - strtotime($rowData[1]) <= 86400){
        if(strpos($rowData[0], 'index.php?') !== false){
            $url = explode('=', $rowData[0]);
            $page = $url[1];
            switch($page){
                case 'home': $stranicePosete[0]+=1;
                break;
                case 'allbeers': $stranicePosete[1]+=1;
                break;
                case 'register': $stranicePosete[2]+=1;
                break;
                case 'login': $stranicePosete[3]+=1;
                break;
                case 'aboutme': $stranicePosete[4]+=1;
                break;
                default: $stranicePosete[5]+=1;
                break;
            }
            $zbir = $zbir + 1;
        }
    }
}

for($i=0; $i<count($stranice); $i++){
    $procenat = round($stranicePosete[$i]/$zbir*100);
    $ispis = '<div class="row">
                <div class="col-11">
                 <div class="progress">
                  <div class="progress-bar" aria-valuenow="' . $procenat .'" aria-valuemin="0" aria-valuemax="100" style="width:' . $procenat . '%">
                  </div>
                 </div>
                </div>
               <div class="col-1"> <label>' . $procenat . '% ' . $stranice[$i] . '</label> </div> </div>';
    echo $ispis;
}
?>
