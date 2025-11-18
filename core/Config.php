<?php 


namespace Core;

class Config{

    public static function SetConfigurations($file_path){
        //Exist and if is readble
        if (!file_exists($file_path) || !is_readable($file_path)) {
            throw new \RuntimeException("Arquivo .env não encontrado ou não pode ser lido em: $file_path");
        }

        $content = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        return self::ParserConfigContent($content);
    }

    private static function ParserConfigContent($content): array{
        $config = [];

        foreach ($content as $linha) {
            //skip coments
            if (strpos(trim($linha), '#') === 0) {
                continue;
            }

            if (strpos($linha, '=') !== false) {
                list($nome, $valor) = explode('=', $linha, 2);
                $nome = trim($nome);
                $valor = trim($valor);

                if (strlen($valor) > 1 && $valor[0] === '"' && $valor[strlen($valor) - 1] === '"') {
                    $valor = substr($valor, 1, -1);
                }
                if (strlen($valor) > 1 && $valor[0] === "'" && $valor[strlen($valor) - 1] === "'") {
                    $valor = substr($valor, 1, -1);
                }

                $config[$nome] = $valor;
            }
        }
        return $config;
    }
    
}