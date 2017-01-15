Popis hlavních rysů programu (funkčnost hlavních skriptů) 
===================


----------  


Model-View-Controller (MVC) a Adresařová struktura
-------------

Takhle vypada adresařová struktura mého projektu. 

![](https://i.imgur.com/fCs6Jvk.png)

Model

Model je datový a zejména funkční základ celé aplikace. Je v něm obsažena aplikační logika. Jakákoliv akce uživatele (přihlášení, změna hodnoty v databázi) představuje akci modelu. Model si spravuje svůj vnitřní stav a ven nabízí pevně dané rozhraní. Voláním funkcí tohoto rozhraní můžeme zjišťovat či měnit jeho stav. Model o existenci view nebo kontroleru neví.

Pojem Model představuje celou vrstvu, nikoliv samostatnou třídu.

View

View, tedy pohled, je vrstva aplikace, která má na starost zobrazení výsledku požadavku. Obvykle používá šablonovací systém a ví, jak se má zobrazit ta která komponenta nebo výsledek získaný z modelu.

Controller

Řadič, který zpracovává požadavky uživatele a na jejich základě pak volá patřičnou aplikační logiku (tj. model) a poté požádá view o vykreslení dat. Obdobou kontrolerů v Nette Framework jsou presentery.

Component

Komponenta představuje vykreslitelný objekt. Jsou to například formuláře, menu, ankety a podobně. V rámci jedné stránky jich může existovat libovolný počet. 

Obsluha formulařu a životní cyklus presenteru
-------------
Každý formulář který se pošle, tak se pošle na akci presenteru. Který po validací předa modelu. Výsledek pak předa view. 
 ![](https://files.nette.org/git/doc-2.4/lifecycle2.gif)

 Zabezpečení, algoritmy zpracování dat
-------------
Formuláře jsou také ochráněné csrf tokenem, který zabrání odesílaní dát z jiného zdroje, než je webová stránka. Algoritmus je ukázán v API modelu. Implementujeme to v base presenteru v startup metodě.
![](https://i.imgur.com/iaN9tAI.png)
 Latte format
-------------
Nette používá Latte. Díky němu nemusíme přemyslet nad htmlSpecialChars, escapování, a také nám hodně zpříjemni život, a vzhled. Taky nám umožňuje používat filtry.
Př: Bez Latte 
```
<?php if ($items): ?>
    <?php $counter = 1 ?>
    <ul>
    <?php foreach ($items as $item): ?>
        <li id="item-<?php echo $counter++ ?>"><?php
        echo htmlSpecialChars(mb_convert_case($item, MB_CASE_TITLE)) ?>
        </li>
    <?php endforeach ?>
    </ul>
<?php endif?>
```
S Latte
```
<ul n:if="$items">
{foreach $items as $item}
    <li id="item-{$iterator->counter}">{$item|capitalize}</li>
{/foreach}
</ul>
```
Výhoda na první pohled je jasná. :)
 Struktura DB
-------------
Pro praci s daty jsme použili relační databazu MySQL. Její struktura výpada nasledovně:
![](https://i.imgur.com/LBnCLFh.png)

Není navržena úplně dokonalé, však pro náš projekt stačí.
 Autocomplete a prace s filtry
-------------
V sekci Twitch chat log, který najdete až se přihlasite, najdete značku lupy. Tu rozklíkněte a zobrazi se vám formulář. V první položce (Name) zadate jmeno užívatele, kterého hledate. V druhé položce (Date) zadate datum a čas, kdy užívatel zpravu napsal. Třetí položka (Message) je pro vyhledávání samotného výrazu ve zpravě. Všechny ty tří položky nejsou povinné, proto stačí pokud budete znát jenom jeden z úvedených informací. Je zajímavé, že pokud nezadate datum, tak se vám data zobrazí od nejnovejšího až po starší. Ale pokud datum a čas zadate, tak se vám údaje zobrazí od nejblížšího k datě - Od staršího k novejšímu.

Kod filtru naleznete v ChatModelu. 

Kod autocompleteru naleznete v sekci www/js/twitch.js. Jeji funkčnost je jednoduchá, po napsáni hledaného slova, JS pošle AJAXový request na server kde potom data zpracuje a vypiše je. 

TODO: pridat fotku z webu  

