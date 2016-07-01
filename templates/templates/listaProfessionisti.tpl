<div class="profWrapper">
    <div class="profContainer">
        <p>
            Lista professionisti:
        </p>
        {foreach $prof as $professionista}
            <div class="profList">
                <a class="profLink" href="?controller=paginaProfessionista&id={$professionista['id']}">{$professionista['nome']} {$professionista['cognome']}</a>
            </div>
        {/foreach}
    </div>
</div>