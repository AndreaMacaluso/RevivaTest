<?php

class Test extends \PHPUnit\Framework\TestCase {


    public function test_App_With_First_Input(){

        //Primo test con input1 e confronto con output1
        
        $input1=<<<EOD
        2 book at 12.49
        1 music CD at 14.99
        1 chocolate bar at 0.85
        EOD;

        $output1=<<<EOD
        2 book: 24.98
        1 music CD: 16.49
        1 chocolate bar: 0.85
        Sales Taxes: 1.50
        Total: 42.32
        EOD;

        $recepitTot= new \App\ReceiptTot($input1);
        $this->assertEquals($output1,$recepitTot->getEodReceiptToT());
             
    }

    public function test_App_With_Second_Input(){

        //Secondo test con input2 e confronto con output2
       
        $input2=<<<EOD
        1 imported box of chocolates at 10.00
        1 imported bottle of perfume at 47.50
        EOD;

        $output2=<<<EOD
        1 imported box of chocolates: 10.50
        1 imported bottle of perfume: 54.65
        Sales Taxes: 7.65
        Total: 65.15
        EOD;

        $recepitTot= new \App\ReceiptTot($input2);
        $this->assertEquals($output2,$recepitTot->getEodReceiptToT());

    }

    public function test_App_With_Third_Input(){
        
        //Terzo test con input3 e confronto con output3

        $input3=<<<EOD
        1 imported bottle of perfume at 27.99
        1 bottle of perfume at 18.99
        1 packet of headache pills at 9.75
        3 box of imported chocolates at 11.25
        EOD;

        $output3=<<<EOD
        1 imported bottle of perfume: 32.19
        1 bottle of perfume: 20.89
        1 packet of headache pills: 9.75
        3 imported box of chocolates: 35.55
        Sales Taxes: 7.90
        Total: 98.38
        EOD;
        
        $recepitTot= new \App\ReceiptTot($input3);  
        $this->assertEquals($output3,$recepitTot->getEodReceiptToT());           
    }
}