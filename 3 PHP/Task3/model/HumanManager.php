<?php

class HumanManager
{
    public $humans = array();

    public function getHumans()
    {
        return $this->humans;
    }

    public function setHumans($humans)
    {
        $this->humans = $humans;
    }

    public function addHuman(Human $human)
    {
        array_push($this->humans, $human);
    }

    public function deleteHuman($field, $meaning)
    {
        foreach($this->getHumans() as $k=>$val)
        {
            if($val->getField($field) == $meaning)
            {
                $human = $this->getHumans()[$k];
                $human -> __destruct();
            }
        }
    }

    public function clear()
    {
        $this->humans = array();
    }

    public function updateFile()
    {
        $json = "";
        $filename = 'data/humans.json';
        $count = count($this->getHumans());
        for ($i = 0; $i < $count; $i++)
        {
            $human = $this->getHumans()[$i];
            $human ->  show();
            if ($i != $count - 1)
            {
                $json = $json . "\"". $i . "\"" . ": " . json_encode($human) . ", ";
            }
            else
            {
                $json = $json . "\"". $i . "\"" . ": " . json_encode($human);
            }
        }
        $json = "{" . $json . "}\n";
        $file = fopen($filename, 'w');
        fwrite($file, $json);
        fclose($file);
    }

    public function show()
    {
        $humans = $this->getHumans();
        $count = count($humans);
        if ($count > 0) {
            for ($m = 0; $m < $count; $m++) {
                $humans[$m]->show();
            }
            echo nl2br("\n\n\n");
        }
        else {
            echo nl2br("\nEmpty collection.");
        }
    }
}