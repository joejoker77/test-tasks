<?php

class somethingClass{


    public function f($a){

        if(method_exists($this, $a)){
            $this->$a();
        }else{
            echo 'Error'.PHP_EOL;
        }
    }

    public function foo(){
        echo 'Method: foo is callable'.PHP_EOL;
    }
}

$obj = new somethingClass();
$obj->f('foo');
echo '<br>';
$obj->f('bar');