<?php

function relative_locate(string $locate): string
{
    /*Essa função tem como utilidade
    validar a rota de arquivos para caso utilize um servidor
    interno ou um servidor apache sem precisar mudar o codigo
    */
    return (!file_exists($locate)) ? "../$locate" : $locate;
};
