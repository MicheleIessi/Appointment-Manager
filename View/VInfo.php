<?php
/**
 * VCliente si occupa di gestire la visualizzazione della pagina delle informazioni, ovvero della pagina 'Chi Siamo'.
 *
 * @package  View
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */
class VInfo extends View {

    /** La funzione impostaTemplateInformazioni si occupa di popolare il template relativo alle informazioni (pagina
     * 'Chi Siamo'). Per farlo legge il contenuto di un file di testo statico (che può essere modificato se necessario
     * dall'amministratore).
     * @return string Il template relativo alle informazioni.
     */
    public function impostaTemplateInformazioni() {

        $UFile = new UFile();
        $contenuto = $UFile->leggiFile('contenutoStatico/informazioni.txt');

        $parti = explode("\n",$contenuto);
        $titolo = $parti[0];
        $sotto1 = $parti[1];
        $testo1 = $parti[2];
        $sotto2 = $parti[3];
        $testo2 = $parti[4];
        $sotto3 = $parti[5];
        $testo3 = $parti[6];

        $sezione1 = !($sotto1 === "" && $testo1 === "");
        $sezione2 = !($sotto2 === "" && $testo2 === "");
        $sezione3 = !($sotto3 === "" && $testo3 === "");

        $this->setData('sezione1',$sezione1);
        $this->setData('sezione2',$sezione2);
        $this->setData('sezione3',$sezione3);

        $this->setData('titolo',$titolo);
        $this->setData('sotto1',$sotto1);
        $this->setData('testo1',$testo1);
        $this->setData('sotto2',$sotto2);
        $this->setData('testo2',$testo2);
        $this->setData('sotto3',$sotto3);
        $this->setData('testo3',$testo3);

        return $this->fetch('informazioni.tpl');
    }

    public function impostaTemplateCredits() {

        return $this->fetch('credits.tpl');
    }

}