<?php

class Image {

    public $file;
    public $tmpName;


    function aboutImage(){
        $imgName         = $this->file['name'];
        $this->tmpName   = $this->file['tmp_name'];
        $imgType         = $this->file["type"];
        $extension       = $this->getImageExtension($imgType);
        $imageName       = "img_".date("dmY")."_".time().$extension;

        return $imageName;
    }


    function tempName(){
        return $this->file['tmp_name'];
    }


    function getImageExtension($imgType) {
        if(empty($imgType))
            return false;
        switch($imgType) {
            case 'image/bmp':
                return '.bmp';
            case 'image/gif':
                return '.gif';
            case 'image/jpeg':
                return '.jpg';
            case 'image/png':
                return '.png';
            default:
                return false;
        }
    }

}