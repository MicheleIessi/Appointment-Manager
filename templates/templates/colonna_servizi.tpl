<div id='wrapServizi'>
    <p>Agenda di {$nomeProf}:</p>
    <p id="dettagli"></p>
    <div id='external-events'>
        <div id="loadingDiv">
            <img id="loadingGif" src="img/loading.gif" />
        </div>
        <h4>Servizi disponibili:</h4>
        {foreach $servizi as $servizio}
            <div class='fc-event' style='z-index: auto' data-event='{literal}{{/literal}"title"{literal}:{/literal}"{$servizio['nome']}"{literal}}{/literal}' data-duration="{$servizio['durata']}">{$servizio['nome']}</div>
        {/foreach}
        <div id='bottoneCestino'>
            <button id="mostraCestino">Modifica appuntamenti</button>
            <p>Ricorda che non puoi annullare appuntamenti presi che avverranno tra meno di due giorni</p>
        </div>

    </div>
    <div class="cestinoNascosto">
        <div id="calendarTrash" class="calendar-trash">
            <img id='immCestino' src="img/trash-512.png"/>
            <button id="fineModifica">Ho finito</button>
        </div>
    </div>

</div>