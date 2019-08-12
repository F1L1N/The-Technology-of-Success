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
        //$human -> show();
        //$this->humans[] = $human;
    }

    public function deleteHuman($field, $meaning)
    {
        for ($i = 0; $i < count($this->getHumans()); $i++)
        {
            if ($this->getHumans()[$i][$field]==$meaning)
            {
                array_splice($this->getHumans(), $i);
            }
        }
    }

    public function clear()
    {
        //$humans = $this->getHumans();
        //unset($humans);
        //$this->setHumans(array());
        $this->humans = array();
    }

    public function updateFile($path)
    {
        $json = "";
        $count = count($this->getHumans());
        for ($i = 0; $i < $count; $i++)
        {
            $human = $this->getHumans()[$i];
            //$human -> show();
            if ($i != $count - 1)
            {
                $json = $json . "\"". $i . "\"" . ": " . json_encode($human) . ", ";
            }
            else
            {
                $json = $json . "\"". $i . "\"" . ": " . json_encode($human);
            }
        }
        echo $json;
        $file = fopen($path,"wa+");
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
        }
        else {
            echo nl2br("\nEmpty collection.");
        }
    }
}