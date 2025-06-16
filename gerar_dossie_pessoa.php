<?php
// ARQUIVO: gerar_dossie_pessoa.php (VERSÃO CORRIGIDA)

// PASSO 1 DA CORREÇÃO: Suprimir a exibição de erros para garantir que apenas o PDF seja enviado.
error_reporting(0);
ini_set('display_errors', 0);

require('fpdf.php');
require('config.php');

// PASSO 2 DA CORREÇÃO: Criar uma função para substituir a obsoleta utf8_decode()
function to_iso($string) {
    return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $string);
}

// Pega o ID da pessoa da URL
$pessoa_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($pessoa_id <= 0) { die('ID da pessoa inválido.'); }

// --- BUSCA DE DADOS NO BANCO ---

// 1. Dados principais da pessoa
$stmt_pessoa = $conn->prepare("SELECT * FROM pessoas WHERE id = ?");
$stmt_pessoa->bind_param("i", $pessoa_id);
$stmt_pessoa->execute();
$pessoa = $stmt_pessoa->get_result()->fetch_assoc();
if (!$pessoa) { die('Pessoa não encontrada.'); }

// 2. Tatuagens
$stmt_tattoos = $conn->prepare("SELECT local_corpo, descricao FROM tatuagens WHERE pessoa_id = ?");
$stmt_tattoos->bind_param("i", $pessoa_id);
$stmt_tattoos->execute();
$tatuagens = $stmt_tattoos->get_result()->fetch_all(MYSQLI_ASSOC);

// 3. Vínculos Manuais
$stmt_vinculos = $conn->prepare("SELECT * FROM vinculos WHERE (entidade1_tipo = 'pessoa' AND entidade1_id = ?) OR (entidade2_tipo = 'pessoa' AND entidade2_id = ?)");
$stmt_vinculos->bind_param("ii", $pessoa_id, $pessoa_id);
$stmt_vinculos->execute();
$vinculos_manuais = $stmt_vinculos->get_result()->fetch_all(MYSQLI_ASSOC);


// --- CLASSE PDF CUSTOMIZADA (HERDANDO DE FPDF) ---
class PDF extends FPDF
{
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, to_iso('SAVIP - Dossiê Individual'), 0, 1, 'C');
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 5, to_iso('Documento gerado em: ') . date('d/m/Y H:i:s'), 0, 1, 'C');
        $this->Ln(10);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, to_iso('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    function ChapterTitle($title) {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(230, 230, 230);
        $this->Cell(0, 8, to_iso($title), 0, 1, 'L', true);
        $this->Ln(4);
    }
}

// --- GERAÇÃO DO PDF ---

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Seção de Identificação
$pdf->ChapterTitle('Identificação');
if ($pessoa['foto_path'] && file_exists($pessoa['foto_path'])) {
    $pdf->Image($pessoa['foto_path'], 160, 45, 30);
}
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(40, 7, to_iso('Nome Completo: '), 0, 0);
$pdf->Cell(0, 7, to_iso($pessoa['nome_completo']), 0, 1);
$pdf->Cell(40, 7, to_iso('Alcunha: '), 0, 0);
$pdf->Cell(0, 7, to_iso($pessoa['alcunha']), 0, 1);
$pdf->Cell(40, 7, 'CPF: ', 0, 0);
$pdf->Cell(0, 7, $pessoa['cpf'], 0, 1);
$pdf->Cell(40, 7, 'RG: ', 0, 0);
$pdf->Cell(0, 7, $pessoa['rg'], 0, 1);
$pdf->Ln(5);

// Seção de Tatuagens
if (!empty($tatuagens)) {
    $pdf->ChapterTitle('Tatuagens');
    $pdf->SetFont('Arial', '', 11);
    foreach($tatuagens as $tattoo) {
        $pdf->Cell(0, 7, to_iso("- " . $tattoo['local_corpo'] . ": " . $tattoo['descricao']), 0, 1);
    }
    $pdf->Ln(5);
}

// Seção de Vínculos Manuais
if (!empty($vinculos_manuais)) {
    $pdf->ChapterTitle(to_iso('Vínculos Diretos Conhecidos'));
    $pdf->SetFont('Arial', '', 11);
    foreach($vinculos_manuais as $vinculo) {
        $outra_entidade_tipo = ($vinculo['entidade1_id'] == $pessoa_id) ? $vinculo['entidade2_tipo'] : $vinculo['entidade1_tipo'];
        $outra_entidade_id = ($vinculo['entidade1_id'] == $pessoa_id) ? $vinculo['entidade2_id'] : $vinculo['entidade1_id'];
        
        $info_vinculo = to_iso("- Vínculo '" . $vinculo['tipo_vinculo'] . "' com " . $outra_entidade_tipo . " (ID: " . $outra_entidade_id . ")");
        $pdf->Cell(0, 7, $info_vinculo, 0, 1);
    }
    $pdf->Ln(5);
}

// Limpa qualquer saída acidental antes de enviar o PDF
ob_end_clean(); 

$pdf->Output('I', 'Dossie_Pessoa_' . $pessoa_id . '.pdf');
?>