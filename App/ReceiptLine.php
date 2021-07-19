<?php

namespace App;

/*

In questa classe viene gestita la singola riga della ricevuta come oggetto, suddividendo la riga in parole,
le quali vengono utilizzate per restituire l'output desiderato.

Regole per il calcolo delle tasse:

Basic sales tax is applicable at a rate of 10% on all goods, except books, food, and
medical products that are exempt. Import duty is an additional sales tax applicable on all
imported goods at a rate of 5%, with no exemptions.
When I purchase items I receive a receipt which lists the name of all the items and their price
(including tax), finishing with the total cost of the items, and the total amounts of sales taxes
paid. The rounding rules for sales tax are that for a tax rate of n%, a shelf price of p contains
(np/100 rounded up to the nearest 0.05) amount of sales tax.
Write an application that prints out the receipt details for these shopping baskets...


*/

class ReceiptLine {
    
    //Properties
    private $text;      //linea di testo, descrizione prodotto
    private $import;    //booleano per sapere se è importato
    private $exception;  //booleano per sapere se è un'eccezione
    private $quantity;
    private $price;
    private $totalPrice;
    private $saleTax;

    //Methods

    function __construct($inputText){

        //se il testo contiene imported allora $this->import=true

        if(strpos($inputText, 'imported')!== false){
            $this->import=true;
        }else{
            $this->import=false;
        }

        //se il testo contiene Food,book,medicine allora $this->exception=true

        $this->exception=false;
        if(strpos($inputText, 'book')!== false){ $this->exception=true;}
        if(strpos($inputText, 'chocolate')!== false){ $this->exception=true; }
        if(strpos($inputText, 'headache pills')!== false){ $this->exception=true; }

        //creo un array di parole(string) suddividendo la stringa che rappresenta la linea della ricevuta    
        //imported viene tolto per essere poi rimesso all'inizio della linea
        $inputs=explode(' ',str_replace('imported ','',$inputText));
        $length= count($inputs)-1;

        //raccolgo da $inputText la quantita del primo prodotto
        $this->quantity=(int)$inputs[0];
        //raccolgo da $inputText il prezzo
        $this->price=$inputs[$length];

        //definisco i prezzi considerando la tassazione
        $this->definePrices();

        //il testo che rimane nel mezzo viene inserito in text
        $length=$length-1;
        for($i=1;$i<$length;$i++){
            if(($i==1)&&($this->import)){
                $this->text='imported' .' '; // viene inserito imported come prima parola nel caso sia importato
            }
            
            if ($i==$length-1){
                $this->text= $this->text . $inputs[$i] .':';
            }else{
                $this->text= $this->text . $inputs[$i] .' ';
            }
        
            }

        }
    function definePrices(){

        $importTax=round(($this->price/100)*5,1);// round($importTax,1) arrotondamento per import tax
        $normalTax=round(($this->price/100)*10/ 0.05) * 0.05; // arrotondamento per Sales tax
        
        // controllo e calcolo prezzo e tasse totali a seconda della casistica 
        // dei valori di $this->import e $this->exception

        if ((!$this->import)&&($this->exception)){
            $tax=0;
            $total=$this->quantity*($this->price+$tax);
            $this->totalPrice=$total;
            $this->saleTax=$tax;
        }
        
        if (($this->import)&&($this->exception)){
            $tax=$importTax;
            $total=$this->quantity*($this->price+$tax);
            $this->totalPrice=$total;
            $this->saleTax=$tax*$this->quantity;
        }
        
        if (($this->import)&&(!$this->exception)){
            $tax=$importTax+$normalTax;
            $total=$this->quantity*($this->price+$tax);
            $this->totalPrice=$total;
            $this->saleTax=$tax;
        }
        
        if ((!$this->import)&&(!$this->exception)){
            $tax=$normalTax;
            $total=$this->quantity*($this->price+$tax);
            $this->totalPrice=$total;
            $this->saleTax=$tax;
        }
    }
        
    function getTotalPrice(){
        return $this->totalPrice;
    }

    function getTotaltax(){
        return $this->saleTax;
    }

    function getLine(){
        //restituisco la linea completa nel formato 'quantità testo prezzo'
        $textline= $this->quantity .' '. $this->text .' '. number_format($this->totalPrice,2);
        return $textline;
    }

}