<?php
error_reporting(0);
ini_set('display_errors', 0);

require('fpdf.php');
require('config.php');

function to_iso($string) {
    return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $string ?? '');
}

$caso_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($caso_id <= 0) { die('ID do caso inválido.'); }

// --- BUSCA DE DADOS ---
// Usamos a mesma lógica da API para buscar todos os detalhes do caso
$response = [];
$stmt_main = $conn->prepare("SELECT * FROM casos WHERE id=?");
$stmt_main->bind_param("i", $caso_id);
$stmt_main->execute();
$response['caso'] = $stmt_main->get_result()->fetch_assoc();
if (!$response['caso']) { die('Caso não encontrado.'); }

$tables = [
    'pessoas' => 'SELECT p.id, p.nome_completo, cp.atuacao FROM caso_pessoa cp JOIN pessoas p ON cp.pessoa_id=p.id WHERE cp.caso_id=?',
    'ocorrencias' => 'SELECT o.id, o.numero_bo, o.fatos_comunicados FROM caso_ocorrencia co JOIN ocorrencias o ON co.ocorrencia_id=o.id WHERE co.caso_id=?',
    'veiculos' => 'SELECT v.id, v.placa, v.marca_modelo FROM caso_veiculo cv JOIN veiculos v ON cv.veiculo_id=v.id WHERE cv.caso_id=?',
    'objetos' => 'SELECT o.id, o.tipo, o.marca FROM caso_objeto co JOIN objetos o ON co.objeto_id=o.id WHERE co.caso_id=?',
    'telefones' => 'SELECT t.id, t.numero FROM caso_telefone ct JOIN telefones t ON ct.telefone_id=t.id WHERE ct.caso_id=?'
];
foreach ($tables as $table_name => $sql) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $caso_id);
    $stmt->execute();
    $response[$table_name] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
$caso = $response['caso'];

// --- CLASSE PDF CUSTOMIZADA ---
class PDF extends FPDF
{
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, to_iso('SAVIP - Dossiê do Caso'), 0, 1, 'C');
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
    function ChapterBody($body) {
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(0, 7, to_iso($body));
        $this->Ln();
    }
}

// --- GERAÇÃO DO PDF ---
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Seção de Identificação do Caso
$pdf->ChapterTitle('Identificação do Caso');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(45, 7, to_iso('Nº Inquérito Policial:'), 0, 0);
$pdf->Cell(0, 7, to_iso($caso['inquerito_policial']), 0, 1);
$pdf->Cell(45, 7, to_iso('Nº Autos:'), 0, 0);
$pdf->Cell(0, 7, to_iso($caso['autos']), 0, 1);
$pdf->Ln(5);

// Seções de Texto
$pdf->ChapterTitle('Relato dos Fatos');
$pdf->ChapterBody($caso['relato_fatos']);

$pdf->ChapterTitle('Das Investigações (Diligências)');
$pdf->ChapterBody($caso['investigacoes']);

$pdf->ChapterTitle('Conclusão');
$pdf->ChapterBody($caso['conclusao']);

// Seções de Vínculos
$pdf->ChapterTitle('Entidades Vinculadas ao Caso');

if (!empty($response['pessoas'])) {
    $pdf->SetFont('Arial','B', 11);
    $pdf->Cell(0, 7, to_iso('Pessoas:'), 0, 1);
    $pdf->SetFont('Arial','', 11);
    foreach($response['pessoas'] as $item) {
        $pdf->Cell(0, 7, to_iso("- " . $item['nome_completo'] . " (Atuação: " . $item['atuacao'] . ")"), 0, 1, 'L');
    }
    $pdf->Ln(2);
}

if (!empty($response['ocorrencias'])) {
    $pdf->SetFont('Arial','B', 11);
    $pdf->Cell(0, 7, to_iso('Ocorrências:'), 0, 1);
    $pdf->SetFont('Arial','', 11);
    foreach($response['ocorrencias'] as $item) {
        $pdf->Cell(0, 7, to_iso("- BO nº " . $item['numero_bo'] . " (" . $item['fatos_comunicados'] . ")"), 0, 1, 'L');
    }
    $pdf->Ln(2);
}

if (!empty($response['veiculos'])) {
    $pdf->SetFont('Arial','B', 11);
    $pdf->Cell(0, 7, to_iso('Veículos:'), 0, 1);
    $pdf->SetFont('Arial','', 11);
    foreach($response['veiculos'] as $item) {
        $pdf->Cell(0, 7, to_iso("- Placa " . $item['placa'] . " (" . $item['marca_modelo'] . ")"), 0, 1, 'L');
    }
    $pdf->Ln(2);
}

// Adicione seções para objetos e telefones se desejar...

ob_end_clean();
$pdf->Output('I', 'Dossie_Caso_' . $caso_id . '.pdf');
?>