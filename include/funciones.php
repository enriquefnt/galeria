<?php

class PDF extends FPDF
{

function PDF()
{
	$this->FPDF();
}

function Header()
{
	global $title;

	//Arial bold 15
	$this->SetFont('Arial','B',15);
	//Calculate width of title and position
	$w=$this->GetStringWidth($title)+6;
	$this->SetX((210-$w)/2);
	//Colors of frame, background and text
	$this->SetDrawColor(0,80,180);
	$this->SetFillColor(230,230,0);
	$this->SetTextColor(220,50,50);
	//Thickness of frame (1 mm)
	$this->SetLineWidth(1);
	//Title
	$this->Cell($w,9,$title,1,1,'C',1);
	//Line break
	$this->Ln(10);
}

function Footer()
{
	//Position at 1.5 cm from bottom
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','I',8);
	//Text color in gray
	$this->SetTextColor(128);
	//Page number
	$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

function ChapterTitle($num,$label)
{
	//Arial 12
	$this->SetFont('Arial','',12);
	//Background color
	$this->SetFillColor(200,220,255);
	//Title
	$this->Cell(0,6,"Chapter $num : $label",0,1,'L',1);
	//Line break
	$this->Ln(4);
}

function ChapterBody($file)
{
	//Read text file
	$f=fopen($file,'r');
	$txt=fread($f,filesize($file));
	fclose($f);
	//Times 12
	$this->SetFont('Times','',12);
	//Output justified text
	$this->MultiCell(0,5,$txt);
	//Line break
	$this->Ln();
	//Mention in italics
	$this->SetFont('','I');
	$this->Cell(0,5,'(end of excerpt)');
}

function PrintChapter($num,$title,$file)
{
	$this->AddPage();
	$this->ChapterTitle($num,$title);
	$this->ChapterBody($file);
}
}

///////////////*////////////////////////*////////////////////


function query($pdo, $sql, $parameters = []) {
	$query = $pdo->prepare($sql);
	$query->execute($parameters);
	return $query;
}


function total($pdo, $table) {
	$query = query($pdo, 'SELECT COUNT(*) FROM `' . $table . '`');
	$row = $query->fetch();
	return $row[0];
}




function findById($pdo, $table, $primaryKey, $value) {
	$query = 'SELECT * FROM `' . $table . '` WHERE `' . $primaryKey . '` = :value';

	$parameters = [
		'value' => $value
	];

	$query = query($pdo, $query, $parameters);

	return $query->fetch();
}

function insert($pdo, $table, $fields) {
	$query = 'INSERT INTO `' . $table . '` (';

	foreach ($fields as $key => $value) {
		$query .= '`' . $key . '`,';
	}

	$query = rtrim($query, ',');

	$query .= ') VALUES (';


	foreach ($fields as $key => $value) {
		$query .= ':' . $key . ',';
	}

	$query = rtrim($query, ',');

	$query .= ')';

	$fields = processDates($fields);

	query($pdo, $query, $fields);
}



function save($pdo, $table, $primaryKey, $record) {
	try {
		if ($record[$primaryKey] == '') {
			$record[$primaryKey] = null;
		}
		insert($pdo, $table, $record);
	}
	catch (PDOException $e) {
		update($pdo, $table, $primaryKey, $record);
	}
}


function update($pdo, $table, $primaryKey, $fields) {

	$query = ' UPDATE `' . $table .'` SET ';


	foreach ($fields as $key => $value) {
		$query .= '`' . $key . '` = :' . $key . ',';
	}

	$query = rtrim($query, ',');

	$query .= ' WHERE `' . $primaryKey . '` = :primaryKey';

	//Set the :primaryKey variable --- Aca modifique el valor de fields para que ande
	$fields['primaryKey'] = $fields['idActividad'];

	$fields = processDates($fields);

	query($pdo, $query, $fields);
}




function delete($pdo, $table, $primaryKey, $id ) {
	$parameters = [':id' => $id];

	query($pdo, 'DELETE FROM `' . $table . '` WHERE `' . $primaryKey . '` = :id', $parameters);
}


function findAll($pdo,  $table, $ord) {
	$result = query($pdo, 'SELECT * FROM `' . $table . '`
order by `' . $ord. '` ');

	return $result->fetchAll();
}

function processDates($fields) {
	foreach ($fields as $key => $value) {
		if ($value instanceof DateTime) {
			$fields[$key] = $value->format('Y-m-d');
		}
	}

	return $fields;
}


