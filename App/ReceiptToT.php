<?php

namespace App;

class ReceiptToT {
    
    //Properties
    private $lines;// sarà inizializzato come array di tipo ReceiptLine per essere poi utilizzate nel costruttore
    private $total;
    private $totalSaleTaxes;
    private $eodLines;//viene composta per essere comparata nel test.php senza </br> per fine linea
    private $textLines;//viene composta per essere mostrata da index.php con </br> per fine linea
    //Methods

    function __construct($inputText){
        
        $inputArray = preg_split("/\r\n|\n|\r/", $inputText);

        $lengt = count($inputArray);
        for($i=0;$i<$lengt;$i++){
            $this->lines[$i]= new ReceiptLine($inputArray[$i]);
            $line=$this->lines[$i]->getLine();                      //ottengo la linea i
            $this->total+=$this->lines[$i]->getTotalPrice();        //sommo tutti i prezzi per ogni linea i
            $this->totalSaleTaxes+=$this->lines[$i]->getTotalTax(); //sommo tutte le tasse per ogni linea i
            $this->textLines=$this->textLines . $line.'<br/>' ;
            
            //questo if evita di creare una linea vuota in $this->eodLines
            if($i==0){
                $this->eodLines = <<<EOD
                $line
                EOD;
            }else{
                $this->eodLines = <<<EOD
                $this->eodLines
                $line
                EOD;
            }
        }
       
    }

    function receiptToTShow (){
        //show per index.php
        echo $this->textLines;
        echo 'Sales Tasse:' . number_format($this->totalSaleTaxes,2) .'<br/>';
        echo 'Total: ' . number_format( $this->total,2) .'<br/>';
        
    }

    function getEodReceiptToT(){
        //get per il Test.php       
        $SalesTax= number_format($this->totalSaleTaxes,2);
        $Total= number_format( $this->total,2);
        $receipt=<<<EOD
        $this->eodLines
        Sales Taxes: $SalesTax
        Total: $Total
        EOD;
        return $receipt;
    }

}
