
Introduzione:
Il progetto si presenta come una soluzione all'esercizio
proposto per il calcolo delle tasse.

Panoramica del progetto:

Il progetto é composto di quattro file .php: due classi che traducono l'input 
nell'output desiderato, il file di test per gli assertion test con PHPUnit e
index che puo essere aperto tramite Xampp su browser

App:
    ReceiptToT.php
    RecepitLine.php
Tests:
    Test.php
index.php

Il resto delle cartelle e dei file inseriti nel progetto appartengono a PHPUnit 
e sono installati dal composer scrivendo in console.

ReceiptToT.php 
    Classe che rappresenta l'elemento ricevuta totale
ReceiptLine.php
    Classe che rappresenta le singole linee della ricevuta in formato oggetto, viene poi 
    chiamata dalla classe ReceiptToT


Premesse:

Si assume che: 

l'input sia sempre del formato indicato nell'esercizio, quindi un numero n di stringhe
composte come segue:
1 imported bottle of perfume at 27.99
quantità prodotto, descrizione prodotto, at, prezzo.

Quantità e prezzo sono sempre positive.

L'output restituito sarà composto da una serie di n righe strutturate in questo modo:
1 imported bottle of perfume: 32.19
quantità, imported (se importato), descrizione prodotto, prezzo tassato
Le ultime due righe dell'output saranno:
Sales Taxes: somma delle tasse di ogni prodotto
Total: somma del costo di ogni prodotto comprese le tasse

Logica programma :

Dato un input($inputText) viene chiamato il costruttore della classe ReceiptToT  

Class ReceiptToT

    private $lines;             // array di tipo ReceiptLine 
    private $total;             // Totale somma prezzo
    private $totalSaleTaxes;    // Totale somma tasse
    private $eodLines;          // stringa in formato heredoc per test.php 
    private $textLines;         // viene composta per essere mostrata da index.php

    Costruttore($inputText) 
        Traduce $inputText in un array di stringhe separate al carattere fine linea.
        Passa ogni elemento dell'array al costruttore della classe ReceiptLine creando
        un array di tipo ReceiptLine.
        Vengono successivamente assegnati valori alle altre proprieta creando l'oggetto.

    receiptToTShow 
        Restituisce con echo gli output da mostrare a schermo chiamata da index.
   
    getEodReceiptToT
        Restituisce la ricevuta in formato heredoc chiamata dal test.


Class ReceiptLine {
    
    //Properties
    private $text;      //linea di testo, descrizione prodotto
    private $import;    //booleano per sapere se è importato
    private $exception; //booleano per sapere se è un'eccezione
    private $quantity;
    private $price;
    private $totalPrice;
    private $saleTax;

    Costruttore($inputText) 
        In questo caso il costruttore prenderà come $inputText una linea della ricevuta
        passata dalla classe ReceiptToT e la tradurrà suddividendola in quantità,
        descrizione prodotto e prezzo.
        Sarà chiamata la funzione definePrices() per calcolare il prezzo e le tasse,
        vengono successivamente assegnati valori alle altre proprietà creando l'oggetto.

    funzione definePrices()
        Calcola secondo le regole dell'esercizio* le tasse di importazione e le tasse di 
        vendita.
        Dopodiché calcola il prezzo totale e le tasse totali della singola linea della
        ricevuta.
    
    Le funzioni getTotalPrice(),getTotaltax(),getLine() vengono poi chiamate dalla classe 
    ReceiptToT per costruire l'output desiderato.



Workflow progetto

Usare visual studio code con estensioni per il php

Gli input e gli output sono hard-coded in Test.php e index.php

1
Con Test.php
    da console di visual studio code andare nella directory del progetto
    eseguire da console ./vendor/bin/phpunit

Con index.php
    attivare Xampp e aprire su browser local host

2
    Per ogni input viene chiamato il costruttore di ReceiptToT
    da ReceipitToT viene chiamato il costruttore ReceiptLine
    ReceiptLine crea oggetto linea e calcola il totale delle tasse e del prezzo
    La ReceipitToT usa un array di oggetti ReceiptLine per comporre un output per index.php
    e uno per Test.php

3

Con Test.php
    vengono fatti i test con gli input 1 2 3
    viene fatta la assertEquals tra l'output 1 2 3 e gli output restituiti dall'app
Con Test.php
    vengono mostrati sul browser gli output restituiti dall'app


Altro:
Per il progetto serve il Composer e PHPUnit per il test e Xampp per vedere l'output
 da browser.   

con console di visual studio code

PHPUnit configurazione per il progetto:

far eseguire da console
composer require --dev  phpunit/phpunit

modficare il file composer.json per impostare l'autoload e eseguire da console
composer dump-autoload -o

creare phpunit.xml per settare attributi necessari



Regole dell esercizio*

Basic sales tax is applicable at a rate of 10% on all goods, except books, food, and
medical products that are exempt. Import duty is an additional sales tax applicable on all
imported goods at a rate of 5%, with no exemptions.
When I purchase items I receive a receipt which lists the name of all the items and their price
(including tax), finishing with the total cost of the items, and the total amounts of sales taxes
paid. The rounding rules for sales tax are that for a tax rate of n%, a shelf price of p contains
(np/100 rounded up to the nearest 0.05) amount of sales tax.
Write an application that prints out the receipt details for these shopping baskets...

