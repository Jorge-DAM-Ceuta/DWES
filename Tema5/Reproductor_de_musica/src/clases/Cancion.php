<?php

    class Cancion{
        private string $id;
        private string $titulo;
        private string $artista;
        private array $colaboracion;
        private float $duracion;
        private bool $favorita;
        private string $rutaImagen;
        private string $rutaAudio;

        public function __construct($id, $titulo, $artista, $colaboracion, $duracion, $favorita, $rutaImagen = "", $rutaAudio=""){
            $this->id = $id;
            $this->titulo = $titulo;
            $this->artista = $artista;
            $this->colaboracion = $colaboracion;
            $this->duracion = $duracion;
            $this->favorita = $favorita;
            $this->rutaImagen = $rutaImagen;
            $this->rutaAudio = $rutaAudio;
        }
        
        public function getID(){
            return $this->id;
        }
        public function setID($id){
            $this->id = $id;
        }

        public function getTitulo(){
            return $this->titulo;
        }
        public function setTitulo($titulo){
            $this->titulo = $titulo;
        }

        public function getArtista(){
            return $this->artista;
        }
        public function setArtista($artista){
            $this->artista = $artista;
        }

        public function getColaboracion(){
            return $this->colaboracion;
        }
        public function setColaboracion($colaboracion){
            $this->colaboracion = $colaboracion;
        }

        public function getDuracion(){
            return $this->duracion;
        }
        public function setDuracion($duracion){
            $this->duracion = $duracion;
        }

        public function getFavorita(){
            return $this->favorita;
        }
        public function setFavorita($favorita){
            $this->favorita = $favorita;
        }

        public function getRutaImagen(){
            return $this->rutaImagen;
        }
        public function setRutaImagen($rutaImagen){
            $this->rutaImagen = $rutaImagen;
        }

        public function getRutaAudio(){
            return $this->rutaAudio;
        }
        public function setRutaAudio($rutaAudio){
            $this->rutaAudio = $rutaAudio;
        }
    }

?> 