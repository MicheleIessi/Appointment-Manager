<div class="profWrapper">
    
    <div class="profContainer">
        <p class="titolo">
            Lista professionisti:
        </p>
        
        {foreach $prof as $professionista}
            <div class="profList">
                <a href="?controller=paginaProfessionista&id={$professionista['id']}"><button class="profLink">{$professionista['nome']} {$professionista['cognome']}</button></a>
            </div>
        {/foreach}
        
    </div>
</div>