<?php

require 'vendor/autoload.php';

include '../../../includes/dbh.inc.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style;
use PhpOffice\PhpSpreadsheet\Chart;


$spreadsheet = new Spreadsheet();

$spreadsheet->getProperties()->setCreator('PEMIRA IPB')
    ->setLastModifiedBy('PEMIRA IPB')
    ->setTitle('Laporan PEMIRA Ketua BEM Vokasi dan Presiden Mahasiswa')
    ->setSubject('PEMIRA')
    ->setDescription('Laporan PEMIRA Ketua BEM Vokasi dan Presiden Mahasiswa');

function tambahWorksheet($spreadsheet, $judulSheet, $namaPK,  $arrPaslonVokasi, $arrPaslonPresma){
    if($spreadsheet->getSheetCount() == 1){
        $spreadsheet->getActiveSheet()->setTitle($judulSheet);
    }
    else{
        $spreadsheet->setActiveSheetIndexByName("Worksheet");
        $spreadsheet->getActiveSheet()->setTitle($judulSheet);
    }
    $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, "Worksheet");
    $spreadsheet->addSheet($myWorkSheet);

    $sheet = $spreadsheet->getActiveSheet();

    // tulisan total suara
    $sheet->getStyle('D2')->getFont()
        ->setBold(true)
        ->setSize(14);
    $sheet->getStyle('D2')->getAlignment()
        ->setHorizontal('center')
        ->setVertical('center');
    $sheet->mergeCells('D2:H3');

    $laporan =
        [
            ['LAPORAN SUARA PEMIRA KETUA BEM VOKASI DAN PRESIDEN MAHASISWA 2018'],
            ['','','', strtoupper($namaPK)],
            ['','','',''],
            ['','','','CALON KETUA BEM VOKASI']
        ];

    for($i = 0;$i < count($arrPaslonVokasi);$i++){
        $laporan[] = ['','','',$arrPaslonVokasi[$i][0],'','',(string)$arrPaslonVokasi[$i][1]];
    }

    $laporan[] = ['','','','CALON PRESIDEN MAHASISWA'];

    for($i = 0;$i < count($arrPaslonPresma);$i++){
        $laporan[] = ['','','',$arrPaslonPresma[$i][0],'','',(string)$arrPaslonPresma[$i][1]];
    }

    $sheet->fromArray($laporan);

    $sheet->getStyle('D2')->getAlignment()->setWrapText(true);
    $sheet->getRowDimension('3')->setRowHeight(54);

// LAPORAN SUARA PEMIRA KETUA BEM VOKASI DAN PRESIDEN MAHASISWA 2018
    $sheet->getStyle('A1')->getFont()
        ->setBold(true)
        ->setSize(16);
    $sheet->getStyle('A1')->getAlignment()
        ->setHorizontal('center')
        ->setVertical('center');
    $sheet->mergeCells('A1:L1');

    $styleArrayBorder =
        [
            'borders' => [
                'top' => [
                    'borderStyle' => Style\Border::BORDER_MEDIUM
                ],
                'right' => [
                    'borderStyle' => Style\Border::BORDER_MEDIUM
                ],
                'left' => [
                    'borderStyle' => Style\Border::BORDER_MEDIUM
                ],
                'bottom' => [
                    'borderStyle' => Style\Border::BORDER_MEDIUM
                ],
            ]
        ];

// TOTAL SUARA
    $sheet->getStyle('D2:H4')->applyFromArray($styleArrayBorder);

    for($i = 0;$i < count($arrPaslonVokasi);$i++){
        $sheet->mergeCells('D'.($i+5).':F'.($i+5));
        $sheet->getStyle('D'.($i+5).':F'.($i+5))->applyFromArray($styleArrayBorder);

    }
    $presmaCellStartPos = 5 + $i + 1;

    for($i = 0;$i < count($arrPaslonPresma);$i++) {
        $sheet->mergeCells('D'.($i+$presmaCellStartPos).':F'.($i+$presmaCellStartPos));
        $sheet->getStyle('D'.($i+$presmaCellStartPos).':F'.($i+$presmaCellStartPos))->applyFromArray($styleArrayBorder);
    }

    for($i = 0;$i < count($arrPaslonVokasi);$i++){
        $sheet->mergeCells('G'.($i+5).':H'.($i+5));
        $sheet->getStyle('G'.($i+5).':H'.($i+5))->applyFromArray($styleArrayBorder);
    }

    for($i = 0;$i < count($arrPaslonPresma);$i++) {
        $sheet->mergeCells('G'.($i+$presmaCellStartPos).':H'.($i+$presmaCellStartPos));
        $sheet->getStyle('G'.($i+$presmaCellStartPos).':H'.($i+$presmaCellStartPos))->applyFromArray($styleArrayBorder);
    }

//tulisan ketua bem vokasi
    $sheet->getStyle('D4')->getFont()->setBold(true);
    $sheet->mergeCells('D4:H4');
    $sheet->getStyle('D4:H4')->applyFromArray($styleArrayBorder);

//tulisan presma
    $titlePresmaPos = 4 + count($arrPaslonVokasi) + 1;
    $sheet->getStyle('D'.$titlePresmaPos)->getFont()->setBold(true);
    $sheet->mergeCells('D'.$titlePresmaPos.':H'.$titlePresmaPos);
    $sheet->getStyle('D'.$titlePresmaPos.':H'.$titlePresmaPos)->applyFromArray($styleArrayBorder);

    $styleArray = [
        'font' => [
            'size' => 12
        ],
        'alignment' => [
            'horizontal' => Style\Alignment::HORIZONTAL_CENTER
        ]
    ];

//tengahin isi
    $barisTerakhirTabel = (count($arrPaslonVokasi) + count($arrPaslonPresma) + 1 + 4);
    $sheet->getStyle('D4:G'.$barisTerakhirTabel)->applyFromArray($styleArray);

    $sheet->getStyle('D4')->applyFromArray($styleArray);
    $sheet->getStyle('D'.$titlePresmaPos)->applyFromArray($styleArray);

    $dataSeriesLabels1 = [
        new Chart\DataSeriesValues('String', $judulSheet.'!$D$4', null, 1) //	CALON KETUA BEM VOKASI
    ];

    $xAxisTickValues1 = [
        new Chart\DataSeriesValues('String', $judulSheet.'!$D$5:$D$'.(count($arrPaslonVokasi) - 1 + 5), null, count($arrPaslonVokasi)) //	calon 1 sampe calon 3
    ];

    $dataSeriesValues1 = [
        new Chart\DataSeriesValues('Number', $judulSheet.'!$G$5:$G$'.(count($arrPaslonVokasi) - 1 + 5), null, count($arrPaslonVokasi))
    ];

    $series1 = new Chart\DataSeries(
        \PhpOffice\PhpSpreadsheet\Chart\DataSeries::TYPE_PIECHART, // plotType
        null, // plotGrouping (Pie charts don't have any grouping)
        range(0, count($dataSeriesValues1) - 1), // plotOrder
        $dataSeriesLabels1, // plotLabel
        $xAxisTickValues1, // plotCategory
        $dataSeriesValues1          // plotValues
    );

    $layout1 = new Chart\Layout();
    $layout1->setShowVal(true);
    $layout1->setShowPercent(true);

    $plotArea1 = new Chart\PlotArea($layout1, [$series1]);
//	Set the chart legend
    $legend1 = new Chart\Legend(Chart\Legend::POSITION_RIGHT, null, false);

    $title1 = new Chart\Title('Calon Ketua BEM Vokasi');

//	Create the chart
    $chart1 = new Chart\Chart(
        'chartvokasi', // name
        $title1, // title
        $legend1, // legend
        $plotArea1, // plotArea
        true, // plotVisibleOnly
        0, // displayBlanksAs
        null, // xAxisLabel
        null   // yAxisLabel		- Pie charts don't have a Y-Axis
    );

//	Set the position where the chart should appear in the
    $chart1->setTopLeftPosition('A'.($barisTerakhirTabel + 2));
    $chart1->setBottomRightPosition('H'.($barisTerakhirTabel + 13));

    $sheet->addChart($chart1);

    $tulisanPresmaPos = 4 + count($arrPaslonVokasi) + 1;
    $dataSeriesLabels2 = [
        new Chart\DataSeriesValues('String', $judulSheet.'!$D$'.$tulisanPresmaPos, null, 1) //	CALON PRESIDEN MAHASISWA
    ];

    $xAxisTickValues2 = [
        new Chart\DataSeriesValues('String', $judulSheet.'!$D$'.($tulisanPresmaPos+ + 1).':$D$'.($tulisanPresmaPos + count($arrPaslonPresma)), null, count($arrPaslonPresma)) //	calon 1 sampe calon 3
    ];

    $dataSeriesValues2 = [
        new Chart\DataSeriesValues('Number', $judulSheet.'!$G$'.($tulisanPresmaPos+ + 1).':$G$'.($tulisanPresmaPos + count($arrPaslonPresma)), null, count($arrPaslonPresma))
    ];

    $series2 = new Chart\DataSeries(
        Chart\DataSeries::TYPE_PIECHART, // plotType
        null, // plotGrouping (Pie charts don't have any grouping)
        range(0, count($dataSeriesValues1) - 1), // plotOrder
        $dataSeriesLabels2, // plotLabel
        $xAxisTickValues2, // plotCategory
        $dataSeriesValues2          // plotValues
    );

    $layout2 = new Chart\Layout();
    $layout2->setShowVal(true);
    $layout2->setShowPercent(true);

    $plotArea2 = new Chart\PlotArea($layout2, [$series2]);
//	Set the chart legend
    $legend2 = new Chart\Legend(\PhpOffice\PhpSpreadsheet\Chart\Legend::POSITION_RIGHT, null, false);

    $title2 = new Chart\Title('Calon Presiden Mahasiswa');

//	Create the chart
    $chart2 = new Chart\Chart(
        'chartpresma', // name
        $title2, // title
        $legend2, // legend
        $plotArea2, // plotArea
        true, // plotVisibleOnly
        0, // displayBlanksAs
        null, // xAxisLabel
        null   // yAxisLabel		- Pie charts don't have a Y-Axis
    );

//	Set the position where the chart should appear in the Semua
    $chart2->setTopLeftPosition('I'.($barisTerakhirTabel + 2));
    $chart2->setBottomRightPosition('P'.($barisTerakhirTabel + 13));

    $sheet->addChart($chart2);
}

// semua program studi
$sql = "SELECT * FROM paslon_bem_vokasi";
$dbPaslonVokasi = mysqli_query($conn, $sql);

$arrPaslonVokasi = array();
while($row = mysqli_fetch_assoc($dbPaslonVokasi)){
    $arrPaslonVokasi[] = [$row['nama_paslon'], $row['jml_suara']];
}


$sql = "SELECT * FROM paslon_presma";
$dbPaslonPresma = mysqli_query($conn, $sql);

$arrPaslonPresma = array();
while($row = mysqli_fetch_assoc($dbPaslonPresma)){
    $arrPaslonPresma[] = [$row['nama_paslon'], $row['jml_suara']];
}

$sql = "SELECT count(status) as blmvote FROM pemilih WHERE status='blm'";
$blmvote = mysqli_query($conn, $sql);
if($row = mysqli_fetch_assoc($blmvote)){
    $arrPaslonVokasi[] = ["BELUM VOTE", $row['blmvote']];
    $arrPaslonPresma[] = ["BELUM VOTE", $row['blmvote']];
}


tambahWorksheet($spreadsheet, "Semua", "Semua Program Studi", $arrPaslonVokasi, $arrPaslonPresma);

$kodePK = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","P","T","W"];
$namaPK = [
    "Komunikasi",
    "Ekowisata",
    "Manajemen Informatika",
    "Teknik Komputer",
    "Supervisor Jaminan Mutu Pangan",
    "Manajemen Industri Jasa Makanan dan Gizi",
    "Teknologi Industri Benih",
    "Teknologi Produksi dan Manajemen Perikanan Budidaya",
    "Teknologi dan Manajemen Ternak",
    "Manajemen Agribisnis",
    "Manajemen Industri",
    "Analisis Kimia",
    "Teknik dan Manajemen Lingkungan",
    "Akuntansi",
    "Paramedik Veteriner",
    "Teknologi dan Manajemen Produksi Perkebunan",
    "Teknologi Produksi dan Pengembangan Masyarakat Pertanian"
];
$singkatanPK = [
    "KMN",
    "EKW",
    "INF",
    "TEK",
    "SJMP",
    "GZI",
    "TIB",
    "IKN",
    "TNK",
    "MAB",
    "MNI",
    "KIM",
    "LNK",
    "AKN",
    "PVT",
    "TMP",
    "PPP"
];

function inputVotePerPK($conn, $tabelPaslon, $fieldPaslon, $kodePK){
    $sql = "SELECT count(id) as total FROM $tabelPaslon";
    $totPaslon = mysqli_query($conn, $sql);

    if($totPaslon = mysqli_fetch_assoc($totPaslon)){
        $totPaslon = $totPaslon['total'];
    }

    $arrSuara = array();
    for($i = 1;$i <= $totPaslon;$i++){
        $pilEncode = strtr(base64_encode($i), '+/=', '-_,');
        $sql = "SELECT count(nim) as tot FROM pemilih WHERE nim LIKE '__$kodePK%' AND $fieldPaslon='$pilEncode'";
        $no = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_assoc($no)){
            $arrSuara[$i-1] = $row['tot'];
        }
    }

    $sql = "SELECT * FROM $tabelPaslon";
    $dataPaslon = mysqli_query($conn, $sql);
    $dataPaslonCheck = mysqli_num_rows($dataPaslon);

    if($dataPaslonCheck > 0){
        $arrPaslon = array();

        $i = 0;
        while ($row = mysqli_fetch_assoc($dataPaslon)) {
            $arrPaslon[] = [$row['nama_paslon'], (int)$arrSuara[$i]];
            $i++;
        }

        $sql = "SELECT count(status) as blmvote FROM pemilih WHERE status='blm' AND nim LIKE '__$kodePK%'";
        $blmvote = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_assoc($blmvote)){
            $arrPaslon[] = ["BELUM VOTE", (int)$row['blmvote']];
        }
    }

    return $arrPaslon;
}

for($i = 0 ;$i < count($kodePK);$i++){
    tambahWorksheet($spreadsheet, $singkatanPK[$i], $namaPK[$i],
        inputVotePerPK($conn, "paslon_bem_vokasi","vokasi", $kodePK[$i]),
        inputVotePerPK($conn, "paslon_presma", "presma", $kodePK[$i])
    );
}

$spreadsheet->setActiveSheetIndexByName("Semua");

$sheetIndex = $spreadsheet->getIndex(
    $spreadsheet->getSheetByName('Worksheet')
);
$spreadsheet->removeSheetByIndex($sheetIndex);

//simpan spreadsheet
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
$writer->setIncludeCharts(true);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename='Laporan PEMIRA.xlsx'");
header('Cache-Control: max-age=0');
$writer->save('php://output');

?>