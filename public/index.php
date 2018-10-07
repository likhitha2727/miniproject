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
        $table = html::generateTable($records);
        echo $table;


        }

}

class html{
    public static function generateTable($records){

        $html ='<html>';
        $html .= head::getHead();
        $html .= body::openBody();
        $html .= table::openTable();

        $count=0;
        foreach ($records as $record){
            if($count ==0){
                $array=$record->returnArray();
                $fields= array_keys($array);
                $values=array_values($array);

                while($count==0) {
                    $html .= tableHead::openTablehead();
                    $html .= createRow::openRow();
                    $html .= tableData::forLoop($fields, 0);
                    $html .= createRow::closeRow();
                    $html .= tableHead::closeHead();

                    $count++;

                }
                $html .= createRow::openRow();
                $html .= tableData::forLoop($values,1);
                $html .=createRow::closeRow();
                $html .=table::closeBody();
                $html .='</html>';

                return $html;

            }


            }

        }
    }

    class tableData{

    }

    class createRow{

    }
    class head{
    
    }
    class body{

    }
    class table{

    }

    class tableHead{

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

    public function __construct(Array $fieldNames =null, $values = null){

        $record = array_combine($fieldNames, $values);
        foreach ($record as $property => $value){
            $this->createProperty($property, $value);
        }


}
public function returnArray(){

        $array=(array) $this;
        return $array;
}



public function createProperty($name = 'first',$value ='likhitha'){


        $this->{$name} = $value;
}


}

class recordFactory{

    public static function create(Array $fieldNames = null, $values = null){

        $record=new record($fieldNames, $values);

        return $record;
    }
}

