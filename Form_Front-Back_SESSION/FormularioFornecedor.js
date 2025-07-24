// EXECUTAR MASCARAS
function mascara(o,f) {

    //DEFINE O OBJ E CHA A FUN

    objeto=o
    funcao=f
    setTimeout("executaMascara()",1)
}

function executaMascara(){

    objeto.value=funcao(objeto.value)

}

// MASCARAS

//TELEFONE

function telefone(variavel){

    variavel=variavel.replace(/\D/g,"")
    variavel=variavel.replace(/^(\d\d)(\d)/g, "($1) $2")
    //ADICIONA PARENTESES EM VOLTA DOS DOIS PRIMEIROS DIGITOS
    variavel=variavel.replace(/(\d{4})(\d)/, "$1-$2")
    //ADICIONA HIFE ENTRE O QUARTO E O QUINTO DIGITO
    return variavel
}

//CNPJ  

function cnpj(variavel){
    
    variavel=variavel.replace(/\D/g,"")// REMOVE CARACTERIS NAO NUMERICOS
    variavel=variavel.replace(/(\d{2})(\d)/, "$1.$2")
    //ADICIONA PONTO ENTRE O SEGUNTO E O TERCEIRO DIGITO
    variavel=variavel.replace(/(\d{3})(\d)/, "$1.$2")
    //ADICIONA PONTO ENTRE O QUINTO E O SEXTO DIGITO
    variavel=variavel.replace(/(\d{3})(\d)/, "$1/$2")
    //ADICIONA PONTO ENTRE O OITAVO E O NONO DIGITO
    variavel=variavel.replace(/(\d{4})(\d)/, "$1-$2")
    //ADICIONA PONTO ENTRE O DECIMO SEGUNTO E O DECIMO TERCEIRO

    
    return variavel
}

//CEP

function cep(variavel){

    variavel=variavel.replace(/\D/g,"")// REMOVE CARACTERIS NAO NUMERICOS
    variavel=variavel.replace(/(\d{2})(\d)/, "$1.$2")   
    //ADICIONA PONTO ENTRE O SEGUNTO E TERCEIRO DIGITO
    variavel=variavel.replace(/(\d{3})(\d)/, "$1-$2")   
    //ADICIONA PONTO ENTRE O QUINTO E SEXTO DIGITO

    return variavel 
}

//CARTAOSUS

function ednum(variavel){
    
    variavel=variavel.replace(/\D/g,"")// REMOVE CARACTERIS NAO NUMERICOS
    return variavel

}

//TEXT

function text(variavel){
    
    variavel=variavel.replace(/\d/g,"")// REMOVE CARACTERIS NAO NUMERICOS
    return variavel

}
