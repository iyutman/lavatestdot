 <?php
        $value = [2, 1, 6, 9, 4, 3, 11, 34, 17, 34, 34];
        
        rsort($value);

        $r = 1;
        $r1 = $value['1'];
        for ($i=0; $i < $r ; $i++) { 
            if($value['0'] == $r1){ 
                $r++;
                $r1 = $value[$r];
            } 
        }

        echo $r1;

        dump($value);