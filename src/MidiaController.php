<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MidiaController
 *
 * @author user
 */
class MidiaController {

    protected function escreve_indice($arquivo, $indice) {
        $controle = array('indice' => $indice, 'time' => date('Y-m-d H:i:s'));
        setcookie($arquivo, json_encode($controle), time() + 86400);
    }

    public static function get_nome_subcategoria($subcategoria) {

        switch ($subcategoria) {
            case 'televisao':
                $nome = 'Televisão';
                break;
            case 'horoscopo':
                $nome = 'Horóscopo';
                break;
            default:
                $nome = $subcategoria;
                break;
        }

        return $nome;
    }

    public static function get_xml_data($subcategoria, $prefix = 'not_uol') {
        $xml_file = 'dados/' . $prefix . $subcategoria . '.xml';

        if(!file_exists($xml_file)){
            throw new Exception('XML Inexistente');
        }
        
        $xml = file_get_contents($xml_file);
        $obj_xml = XML2Array::createArray($xml);

        return $obj_xml['DATAPACKET']['ROWDATA'];
    }

    public static function get_xml_data_position($subcategoria, $prefix = 'not_uol') {
        $xml_file = 'dados/' . $prefix . $subcategoria . '.xml';
        
        if(!file_exists($xml_file)){
            throw new Exception('XML Inexistente');
        }
        
        $json_controle = current(explode('.', end(explode('/', $xml_file))));

        $xml = file_get_contents($xml_file);
        $obj_xml = XML2Array::createArray($xml);

        //carrega os dados
        if (isset($obj_xml['DATAPACKET']['ROWDATA']['ROW']['@attributes'])) {
            $data = $obj_xml['DATAPACKET']['ROWDATA']['ROW']['@attributes'];
            self::escreve_indice($json_controle, 0);
        } else {
            //captura a informação de índice
            if (isset($_COOKIE[$json_controle])) {
                $controle = json_decode($_COOKIE[$json_controle], true);

                if ($controle['indice'] + 1 >= sizeof($obj_xml['DATAPACKET']['ROWDATA']['ROW'])) {
                    $controle['indice'] = 0;
                } else {
                    $controle['indice'] ++;
                }
            } else {
                $controle = array('indice' => 0, 'time' => date('Y-m-d H:i:s'));
            }

            $data = $obj_xml['DATAPACKET']['ROWDATA']['ROW'][$controle['indice']]['@attributes'];
            self::escreve_indice($json_controle, $controle['indice']);
        }

        return $data;
    }

    public static function remover_acentos($string) {
        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
    }

}
