<?php

    class Disco{
        private string $id;
        private string $titulo;
        private string $artista;
        private int $anio;
        private string $rutaImagen;
        private array $canciones;

        public function __construct($id, $titulo, $artista, $anio, $rutaImagen = "", $canciones){
            $this->id = $id;
            $this->titulo = $titulo;
            $this->artista = $artista;
            $this->anio = $anio;
            $this->rutaImagen = $rutaImagen;
            $this->canciones = $canciones;
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

        public function getAnio(){
            return $this->anio;
        }
        public function setAnio($anio){
            $this->anio = $anio;
        }

        public function getCanciones(){
            return $this->canciones;
        }
        public function setCanciones($canciones){
            $this->canciones = $canciones;
        }

        public function getRutaImagen(){
            return $this->rutaImagen;
        }
        public function setRutaImagen($rutaImagen){
            $this->rutaImagen = $rutaImagen;
        }
    }

?> 