<?php

class Human implements JsonSerializable
{
    private $fio;
    private $age;
    private $profession;

    function __construct() {
        $a = func_get_args();
        $i = func_num_args();
        switch ($i) {
            case 0:
                $this->setFio("");
                $this->setAge("");
                $this->setProfession("");
                break;
            case 3:
                $this->setFio($a[0]);
                $this->setAge($a[1]);
                $this->setProfession($a[2]);
                break;
            default:
                break;
        }
    }

    function __destruct()
    {
        $this->setFio(null);
        $this->setAge(null);
        $this->setProfession(null);
        unset($this);
    }

    public function getField($field)
    {
        switch ($field) {
            case "fio":
                return $this->getFio();
                break;
            case "age":
                return $this->getAge();
                break;
            case "profession":
                return $this->getProfession();
                break;
            default:
                return null;
                break;
        }
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getFio()
    {
        return $this->fio;
    }

    public function getProfession()
    {
        return $this->profession;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function setFio($fio)
    {
        $this->fio = $fio;
    }

    public function setProfession($profession)
    {
        $this->profession = $profession;
    }

    public function jsonSerialize()
    {
        return [
            'fio' => $this->getFio(),
            'age' => $this->getAge(),
            'profession' => $this->getProfession()
        ];
    }

    public function show()
    {
        if ($this->getFio() == null && $this->getAge() == null && $this->getProfession() == null)
        {
            echo "";
        }
        else
        {
            echo nl2br("\n------------------------------".
                             "\nFIO: ".$this->getFio().
                             "\nAGE: ".$this->getAge().
                             "\nPROFESSION: ".$this->getProfession().
                             "\n------------------------------");
        }
    }
}