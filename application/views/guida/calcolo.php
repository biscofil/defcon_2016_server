<html>
    <head>
    </head>
    <body>
        <fieldset>
            <legend>IQA</legend>
            Il valore finale è calcolato dalla mappatura dell'indice IQA in [0,5] dove
            <ul>
                <li>
                    0 (qualità pessima) equivale a un indice IQA di 175+
                </li>
                <li>
                    5 (qualità ottima) equivale a un indice IQA di 0
                </li>
            </ul>
            Il calcolo dell'indice di un luogo (specificato tramite latitudine e longitudine) avviene nel seguente modo:
            <ul>
                <li>
                    Si ricercano le stazioni e ne si determinano le misurazioni (vedi sezione distanze).
                </li>
                <li>
                    Si procede al calcolo dei tre sottoindici
                </li>
                <li>
                    Si procede al calcolo dell'IQA con i due sottoindici più alti (peggiori)
                </li>
            </ul>
            <img src="http://latex.codecogs.com/gif.latex?I_{IQA}=\frac{I_{1}+I_{2}}{2}" border="0"/><br>
        </fieldset>
        <br>
        <fieldset>
            <legend>PM10</legend>
            <img src="http://latex.codecogs.com/gif.latex?I_{pm10}=\frac{\overline{V_{med24h_{pm10}}}}{V_{rif_{pm10}}}*100" border="0"/>
        </fieldset>
        <br>
        <fieldset>
            <legend>Azoto</legend>
            <img src="http://latex.codecogs.com/gif.latex?I_{NO_2}=\frac{\overline{V_{maxh_{NO_2}}}}{V_{rif_{NO_2}}}*100" border="0"/>
        </fieldset>
        <br>
        <fieldset>
            <legend>Ozono</legend>
            <img src="http://latex.codecogs.com/gif.latex?I_{8h0_3}=\frac{\overline{V_{max8h_{0_3}}}}{V_{rif_{O_3}}}*100" border="0"/>
        </fieldset>
        <br>
        <fieldset>
            <legend>Distanza</legend>
            I sottoindici sopra descritti si basano sui valori della stazioni, quindi la precisione del calcolo è del 100% solamente per la posizione
            esatta della stazione. EcoMe per estendere i valori delle misurazioni alle varie strutture utilizza una formula creata sulla base di alcune ricerche.
            <ul>
                <li>
                    Si cercano le stazioni ad una distanza massima di 30 Km dalla struttura
                </li>
                <li>
                    Si utilizza la distanza come peso per il calcolo di una media pesata dei valori misurati
                    <ul>
                        <li>30 Km - Peso 0.90</li>
                        <li>15 Km - Peso 0.95</li>
                        <li>0 Km - Peso 1.00</li>
                    </ul>
                </li>
            </ul>
        </fieldset>
        <br>
        <fieldset>
            <legend>Fonti</legend>
            <a href="http://www.regione.piemonte.it/ambiente/aria/rilev/ariaday/iqa_pub/iqa-at/descrizioneIqa.html">Regione Piemonte</a> -
            <a href="http://www.butta.org/?p=6404">PM10 e la distanza</a>
        </fieldset>
        <br>
        <fieldset>
            <legend style='color:red'>Disclaimer</legend>
            EcoMe è il progetto finale di tre studenti di Informatica per il corso di Ingegneria del Software, le cui competenze ambientali sono pressochè nulle. I valori calcolati quindi,
            sono da prendere con le pinze in quanto <b>sicuramente non affidabili</b> per un utilizzo commerciale / turistico.
        </fieldset>
    </body>
</html>