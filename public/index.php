<?php
/**
 * Created by PhpStorm.
 * User: likhitha
 * Date: 10/4/18
 * Time: 7:13 PM
 */
main::start( "example.csv");

class main{

    static public function start($filename){

        $records = csv::getRecords($filename);





    }
}

class csv{

    static public function getRecords($filename){

        $file = fopen($filename,"r");

        $fieldNames = array();

        $count= 0;

        while(! feof($file))
        {
            $record = fgetcsv($file);

            if($count==0)
            {
                $fieldNames = $record;
            }

            else{
                $records[] = recordFactory::create($fieldNames,$record);
            }
            $count++;
        }

        fclose($file);
        return $records;



    }
}

class record{

    public function __construct(Array $record=null){

        print_r($record);

        $this->createProperty();

}

public function createProperty($name = 'first',$value ='likhitha'){


        $this->{$name} = $value;
}


}

class recordFactory{

    public static function create(Array $fieldNames = null, $record = null){

        print_r($fieldNames);
        print_r($record);

        //$record=new record($array);

        return $record;
    }
}

