<?php	


function hex2dec($couleur = "#000000"){
	$R = substr($couleur, 1, 2);
	$rouge = hexdec($R);
	$V = substr($couleur, 3, 2);
	$vert = hexdec($V);
	$B = substr($couleur, 5, 2);
	$bleu = hexdec($B);
	$tbl_couleur = array();
	$tbl_couleur['R']=$rouge;
	$tbl_couleur['V']=$vert;
	$tbl_couleur['B']=$bleu;
	return $tbl_couleur;
}

//conversion pixel -> millimeter at 72 dpi
function px2mm($px){
	return $px*25.4/72;
}

function txtentities($html){
	$trans = get_html_translation_table(HTML_ENTITIES);
	$trans = array_flip($trans);
	return strtr($html, $trans);
}


///////////////////////////////////////////////////////

class PDF extends FPDF
{protected $B;
protected $I;
protected $U;
protected $HREF;
protected $fontList;
protected $issetfont;
protected $issetcolor;

function PDF()
{
	$this->FPDF();
}

function Header()
{
	global $title;

	//Arial bold 15
	$this->SetFont('Arial','B',18);
	//Calculate width of title and position
	$w=$this->GetStringWidth($title)+6;
	$this->SetX((210-$w)/2);
	//Colors of frame, background and text
	$this->SetDrawColor(0,50,70);
	$this->SetFillColor(230,230,230);
	$this->SetTextColor(0,50,50);
	//Thickness of frame (1 mm)
	$this->SetLineWidth(1);
	//Title
	$this->Cell($w,10,$title,1,1,'C',1);
	//Line break
	$this->Ln(10);
}
function ChapterBody($texto)
{
	//Read text file
	
	//Times 12
	$this->SetFont('Times','',12);
	//Output justified text
	$this->MultiCell(0,5,$texto);
	//Line break
	$this->Ln();
	//Mention in italics
	$this->SetFont('','I');
	$this->Cell(0,5,'(end of excerpt)');
}

function Footer()
{
	//Position at 1.5 cm from bottom
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','I',8);
	//Text color in gray
	$this->SetTextColor(0,50,50);
	//Page number
	//$this->Cell(0,10,utf8_decode('Página ').$this->PageNo(),0,0,'C');
     $this->Cell(0,10,utf8_decode('SNyAS - 2022'),0,0,'C');
}
/*
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

function __construct($orientation='P', $unit='mm', $format='A4')
{
	//Call parent constructor
	parent::__construct($orientation,$unit,$format);
	//Initialization
	$this->B=0;
	$this->I=0;
	$this->U=0;
	$this->HREF='';
	$this->fontlist=array('arial', 'times', 'courier', 'helvetica', 'symbol');
	$this->issetfont=false;
	$this->issetcolor=false;
}
*/
function WriteHTML($html)
{
	//HTML parser
	$html=strip_tags($html,"<b><u><i><a><img><p><br><strong><em><font><tr><blockquote>"); //supprime tous les tags sauf ceux reconnus
	$html=str_replace("\n",' ',$html); //remplace retour à la ligne par un espace
	$a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE); //éclate la chaîne avec les balises
	foreach($a as $i=>$e)
	{
		if($i%2==0)
		{
			//Text
			if($this->HREF)
				$this->PutLink($this->HREF,$e);
			else
				$this->Write(5,stripslashes(txtentities($e)));
		}
		else
		{
			//Tag
			if($e[0]=='/')
				$this->CloseTag(strtoupper(substr($e,1)));
			else
			{
				//Extract attributes
				$a2=explode(' ',$e);
				$tag=strtoupper(array_shift($a2));
				$attr=array();
				foreach($a2 as $v)
				{
					if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
						$attr[strtoupper($a3[1])]=$a3[2];
				}
				$this->OpenTag($tag,$attr);
			}
		}
	}
}

function OpenTag($tag, $attr)
{
	//Opening tag
	switch($tag){
		case 'STRONG':
			$this->SetStyle('B',true);
			break;
		case 'EM':
			$this->SetStyle('I',true);
			break;
		case 'B':
		case 'I':
		case 'U':
			$this->SetStyle($tag,true);
			break;
		case 'A':
			$this->HREF=$attr['HREF'];
			break;
		case 'IMG':
			if(isset($attr['SRC']) && (isset($attr['WIDTH']) || isset($attr['HEIGHT']))) {
				if(!isset($attr['WIDTH']))
					$attr['WIDTH'] = 0;
				if(!isset($attr['HEIGHT']))
					$attr['HEIGHT'] = 0;
				$this->Image($attr['SRC'], $this->GetX(), $this->GetY(), px2mm($attr['WIDTH']), px2mm($attr['HEIGHT']));
			}
			break;
		case 'TR':
		case 'BLOCKQUOTE':
		case 'BR':
			$this->Ln(5);
			break;
		case 'P':
			$this->Ln(10);
			break;
		case 'FONT':
			if (isset($attr['COLOR']) && $attr['COLOR']!='') {
				$coul=hex2dec($attr['COLOR']);
				$this->SetTextColor($coul['R'],$coul['V'],$coul['B']);
				$this->issetcolor=true;
			}
			if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist)) {
				$this->SetFont(strtolower($attr['FACE']));
				$this->issetfont=true;
			}
			break;
	}
}

function CloseTag($tag)
{
	//Closing tag
	if($tag=='STRONG')
		$tag='B';
	if($tag=='EM')
		$tag='I';
	if($tag=='B' || $tag=='I' || $tag=='U')
		$this->SetStyle($tag,false);
	if($tag=='A')
		$this->HREF='';
	if($tag=='FONT'){
		if ($this->issetcolor==true) {
			$this->SetTextColor(0);
		}
		if ($this->issetfont) {
			$this->SetFont('arial');
			$this->issetfont=false;
		}
	}
}

function SetStyle($tag, $enable)
{
	//Modify style and select corresponding font
	$this->$tag+=($enable ? 1 : -1);
	$style='';
	foreach(array('B','I','U') as $s)
	{
		if($this->$s>0)
			$style.=$s;
	}
	$this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
	//Put a hyperlink
	$this->SetTextColor(0,0,255);
	$this->SetStyle('U',true);
	$this->Write(5,$txt,$URL);
	$this->SetStyle('U',false);
	$this->SetTextColor(0);
}

}//end of class





?>