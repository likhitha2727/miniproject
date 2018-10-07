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
        foreach ($records as $record) {

            $array = $record->returnArray();
            $fields = array_keys($array);
            $values = array_values($array);

            while ($count == 0) {
                $html .= tableHead::openTablehead();
                $html .= createRow::openRow();

                $html .= tableData::forLoop($fields, 0);

                $html .= createRow::closeRow();
                $html .= tableHead::closeHead();

                $count++;

            }
            $html .= createRow::openRow();
            $html .= tableData::forLoop($values, 1);
            $html .= createRow::closeRow();
        }
                $html .=table::closeTable();
                $html .=body::closeBody();
                $html .='</html>';

                return $html;

            }


            }



    class tableData{

        public static function forLoop($value ,$flag ){
            $html = '';


            foreach ($value as $property=>$asValue){
                switch ($flag){
                    case 0:
                        $html .= createTableHeader::createHeader($asValue);
                        break;
                    case 1:
                        $html .= Data::printData($asValue);
                        break;
                    case 2:
                        break;
                }


            }
            return $html;

        }
    }


class createTableHeader
{

    public static function createHeader($value)
    {

        return '<th>' . $value . '</th>';


    }
}

    class createRow{

        public static function openRow(){
            return '<tr>';
        }
        public static function closeRow(){
            return '</tr>';
        }


    }

    class Data{

        public static function printData ($value){
            return '<td>'. $value . '</td>';
        }
    }
    class head{
        public static function getHead(){

            $html_header = '<head>';
            $html_header .= '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">';
            $html_header .= '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>';
            $html_header .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>';
            $html_header .= '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>';
            $html_header .= '</head>';

            return $html_header;
        }

    }
    class body{
        public static function openBody(){
            return '<body>';
        }
        public static function closeBody(){
            return '</body>';
        }
    }
    class table{
        public static function openTable(){
            return '<table class="table table-bordered table-striped">';
        }
        public static function closeTable(){
            return '</table>';
        }
    }


    class tableHead{

        public static function openTablehead(){
            return '<thead class="thead-dark">';
        }
        public static function closeHead(){
            return '</thead >';
        }

    }
class csv
{

    static public function getRecords($filename)
    {

        $file = fopen($filename, "r");

        $fieldNames = array();

        $count = 0;

        while (!feof($file)) {
            $record = fgetcsv($file);

            if ($record == null) {
                continue;
            } else {
                if ($count == 0) {
                    $fieldNames = $record;

                    $count++;

                } else {
                $records[] = recordFactory::create($fieldNames, $record);
            }
        }
    }

        fclose($file);
        return ($records);



    }
}

class record{

    public function __construct(array $fieldNames =null, $values = null){

            $record = array_combine($fieldNames, $values);

            foreach ($record as $property => $value) {
                $this->createProperty($property, $value);
            }
        }

        public function createProperty($name,$value){
        $this->{$name}=$value;
        }



public function returnArray(){

        $array=(array) $this;
        return $array;
}


}


class recordFactory{

    public static function create(Array $fieldNames = null, Array $values = null){

        $record=new record($fieldNames, $values);

        return $record;
    }
}

