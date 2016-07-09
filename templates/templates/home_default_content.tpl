<div id="contenutoDefault">
    <h1 class="titolo">Appointment Manager</h1>
    <p>Benvenuto, {$nome}.</p>
    <p>Appointment Manager è un'applicazione per la prenotazione e la gestione di appuntamenti.</p>
    <h3>Pronto a cominciare?</h3>
    {if $nome eq "ospite"}
        <a href="#registrazionemodal" rel="leanmodal" id="modaltrigger"><button>Registrati!</button></a>
    {else}
        <a href="?controller=lista&task=lista"><button>Lista professionisti</button></a>

    {/if}
</div>