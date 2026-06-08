<?php
function salvar_upload($campo, $pasta, $arquivoAtual = '')
{
    if (!isset($_FILES[$campo]) || $_FILES[$campo]['error'] !== UPLOAD_ERR_OK) {
        return $arquivoAtual;
    }

    $permitidos = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $nomeOriginal = $_FILES[$campo]['name'];
    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

    if (!in_array($extensao, $permitidos)) {
        return $arquivoAtual;
    }

    $diretorio = __DIR__ . '/../uploads/' . $pasta . '/';
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    $nomeArquivo = time() . '_' . bin2hex(random_bytes(4)) . '.' . $extensao;
    $destino = $diretorio . $nomeArquivo;

    if (move_uploaded_file($_FILES[$campo]['tmp_name'], $destino)) {
        return 'uploads/' . $pasta . '/' . $nomeArquivo;
    }

    return $arquivoAtual;
}

function moeda_para_banco($valor)
{
    $valor = str_replace(['R$', ' '], '', $valor);
    $valor = str_replace('.', '', $valor);
    $valor = str_replace(',', '.', $valor);
    return $valor;
}

function telefone_whatsapp($telefone)
{
    $numero = preg_replace('/\D/', '', $telefone);
    if (strlen($numero) <= 11) {
        $numero = '55' . $numero;
    }
    return $numero;
}
?>
