<?php

/**
 * UFile si occupa di gestire le operazioni con i file. È usato nel setup e nella modifica delle informazioni da parte
 * dell'amministratore
 *
 * @package  Utility
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
 */
class UFile {

    /** Legge da un file.
     * @param $path string il path del file da leggere
     * @return string il contenuto letto dal file
     */
    public function leggiFile($path) {
        return file_get_contents($path);
    }

    /** Scrive dentro un file.
     * @param $path string il path del file su cui scrivere
     * @param $cnt string il contenuto da scrivere sul file
     */
    public function scriviFileContent($path,$cnt) {
        file_put_contents($path,$cnt);
    }

    /** Scrive dentro un file. A differenza di scriviFileContent, questo metodo prende come parametro la maniglia
     * al file invece che il suo path.
     * @param $content string il contenuto da scrivere sul file
     * @param $fileHandle resource un puntatore al file su cui scrivere
     */
    public function scriviFile($content,$fileHandle) {
        fputs($fileHandle,$content);
    }

    /** Usa il metodo fopen per restituire la maniglia di un file. Se il file non è presente nel path selezionato,
     * si provvede a crearlo.
     * @param $dir string La cartella in cui è presente il file
     * @param $name string Il nome del file
     * @param $option string Le opzioni da passare a fopen
     * @return resource un puntatore al file appena aperto
     */
    public function apriFile($dir,$name,$option) {
        return fopen("$dir/$name",$option);
    }

    /** Chiude un file attraverso la funzione fclose.
     * @param $file resource un puntatore al file da chiudere.
     */
    public function chiudiFile($file) {
        fclose($file);
    }

}