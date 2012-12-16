<?php

class pf_json
{
    private $data = array();        //our json data
    
    public function readJsonFile($file)
    {
        if (file_exists($file))
        {
            $this->data = json_decode(file_get_contents($file),true);
        }
        else return false;
    }
    
    public function writeJsonFile($file)
    {
        if (!file_put_contents($file, json_encode($this->data)))
        {
            return false;
        }
        else return true;
    }
    
    public function set($setting,$value)
    {
        $this->data[$setting]=$value;
    }
    public function get($setting)
    {
        
        if ((is_array($this->data)) && (key_exists($setting, $this->data)))
        {
            return $this->data[$setting];
        }
        else return false;
    }
}

?>
