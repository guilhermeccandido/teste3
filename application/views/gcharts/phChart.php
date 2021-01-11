<?php
    echo $this->gcharts->LineChart('ph')->outputInto('time_div');
    echo $this->gcharts->div(800, 200);
   

    if($this->gcharts->hasErrors())
    {
        echo $this->gcharts->getErrors();
    }
?>
