<link rel="stylesheet" type="text/css" href="View/css/info.css">

<p id="titolo">{$titolo}</p>
{if $sezione1}
<div id="primaParte">
    <h3>{$sotto1}</h3>
    <p class="testo">{$testo1}</p>
</div>
{/if}
{if $sezione2}
<div id="secondaParte">
    <h3>{$sotto2}</h3>
    <p class="testo">{$testo2}</p>
</div>
{/if}
{if $sezione3}
<div id="terzaParte">
    <h3>{$sotto3}</h3>
    <p class="testo">{$testo3}</p>
</div>
{/if}