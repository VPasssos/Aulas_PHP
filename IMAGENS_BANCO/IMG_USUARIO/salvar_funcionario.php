<?php

// FUNCAO PARA DIMENSIONAR A IMAGEM

function redimensionarImagem($imagem, $largura, $altura){
    // OBTEM AS DOMENSOES ORIGINAIS DA IMAGEM
    // getimagesize() RETORNA A LARGURA E ALTURA DE UMA IMAGEM
    list($larguraOriginal,$alturaOriginal) = getimagesize($imagem);
    // CRIAR UMA NOVA IMAGEM EM BRANCO COM AS NOVAS DIMENSOES
    // IMAGECREATETRUECOLOR() CRIAR UMA NOVA UMAGEM EM BRANCO COM ALTA QUALIDADE
    $novaImagem = imagecreatetruecolor($largura, $altura);

    // CARREGA A IMAGEM ORIGINAL (jpeg) A PARTIR DO ARQUIVO
    // IMACREATEFROMJPEG() CRIA A IMAGEM PHP A PARTIR DE UM JPEG
    $imagemOriginal = imagecreatefromjpg($imagem);

    // COPIA E REDIMICIONA A IMAGEM ORIGINAL PARA A NOVA 
    // imagecopyresampled(), -- COPIA E REDIMENCIONAL E SUAVILIZAÇAO
    imagecopyresampled($novaImagem, $imagemOriginal, 0, 0, 0, 0,$largura,$altura,$larguraOriginal,$alturaOriginal);

    // INICIA UM BUFFER PARA GUARDAR A IMAGEM COMO TEXTO BINARIO
    // ob_start () -- INICIA O output buffering 
    ob_start();

    //imagejep() INVIA A IMAGEM PARA O OUTPUT (QUE VAI PRO buffer)

    imagejpeg($novaImagem);

    // OB_GET CLEAR limpa o buffer

    $dadosImagem = ob_get_clean();

    // LIVEREA A MEMORIA USADA PELAS IMAG|ENS 
    // imagemdestroy -- limpa a memoria 
    imagedestroy($novaImagem);
    imagedestroy($imagemOriginal);

    // RETORNA A IMAGEM REDIMENCIONADA EM FORMATO BINARIO
    return $dadosImagem;
}

// CONFIGURACAO DO BANCO DE DADOS

$host = 'localhost';
$dbname = 'amazena_imagem';
$username = 'root';
$password = '';

try{
    $pdo = new PDO("mysql:host-$host:dbname:$dbname", $username)
}
?>