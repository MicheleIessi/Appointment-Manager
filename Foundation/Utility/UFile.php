<?php


class UFile {

    public function leggiFile($path) {
        return file_get_contents($path);
    }

    public function scriviFileContent($path,$cnt) {
        file_put_contents($path,$cnt);
    }

    public function scriviFile($content,$fileHandle) {
        fputs($fileHandle,$content);
    }

    public function apriFile($dir,$name,$option) {
        return fopen("$dir/$name",$option);
    }


    public function chiudiFile($file) {
        fclose($file);
    }

}