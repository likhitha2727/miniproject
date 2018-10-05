<?php
/**
 * Created by PhpStorm.
 * User: likhitha
 * Date: 10/4/18
 * Time: 7:13 PM
 */
main::start( );

class main{

    static public function start(){

        $file = fopen("example.csv","r");
            while(! feof($file))
            {
                print_r(fgetcsv($file));
            }

        fclose($file);


    }
}

