<div id='wrapServizi'>
    <div id='external-events'>
        <h4>Servizi disponibili:</h4>
        {foreach $servizi as $servizio}
            <div class='fc-event' data-event='{literal}{{/literal}"title"{literal}:{/literal}"{$servizio['nome']}"{literal}}{/literal}' data-duration="{$servizio['durata']}">{$servizio['nome']}</div>
        {/foreach}
        <div id='bottoneCestino'>
            <button id="mostraCestino">Modifica appuntamenti</button>
        </div>

    </div>
    <div class="cestinoNascosto">
        <div id='cestino'>
            <img id='immCestino' src="img/trash-512.png"/>
            <button id="fineModifica">Ho finito</button>
        </div>
    </div>

</div>