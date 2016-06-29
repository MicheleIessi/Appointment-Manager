<div id='wrapServizi'>
    <div id='external-events'>
        <h4>Servizi disponibili:</h4>
        {foreach $servizi as $servizio}

            <div class='fc-event' data-duration="{$servizio['durata']}">{$servizio['nome']}</div>

        {/foreach}

    </div>
</div>