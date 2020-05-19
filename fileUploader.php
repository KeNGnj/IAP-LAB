<?php
class FileUploader{
    //Member variables
    private static $target_directory = "uploads/";
    private static $size_limit = 50000; //Size in bytes
    private $uploadOk = false;
    private $file_original_name;
    private $file_type;
    private $file_size;
    private $final_file_name;

    //getters and setters
    public function setOriginalName($name){
        $this->file_original_name = $name;
    }
    public function getOriginalName(){
        return $this;
    }
    public function setFileType($type){
        $this->file_type = $type;
    }
    public function getFileType(){
        return $this;

    }
    public function setFileSize($size){
        $this->file_size = $size;
    }
    public function getFileSize(){
        return $this;
    }
    public function setFinalFileName($final_name){
        $this->final_file_name = $final_name;
    }
    public function getFinalFileName(){
        return $this;
    }

    //methods
    public function uploadFile(){

    }
    public function fileAlreadyExists(){

    }
    public function saveFilePathTo(){

    }
    public function moveFile(){

    }
    public function fileTypeIsCorrect(){

    }
    public function fileSizeIsCorrect(){

    }
    public function fileWasSelected(){
        
    }
}