	<?php
$this->backupSubsFont = array('dejavusanscondensed');

$this->fonttrans = array(
	'helvetica' => 'arial',
	'times' => 'timesnewroman',
	'courier' => 'couriernew',
	'trebuchet' => 'trebuchetms',
	'comic' => 'comicsansms',
	'franklin' => 'franklingothicbook',
	'albertus' => 'albertusmedium',
	'arialuni' => 'arialunicodems',
	'zn_hannom_a' => 'hannoma',
	'ocr-b' => 'ocrb',
	'ocr-b10bt' => 'ocrb',


);


$this->fontdata = array(
	"avantgarde-book" => array(
        'R' => "avantgarde-book.ttf",
        'I' => "avantgarde-book.ttf",
        ),	
	"arista" => array(
        'R' => "arista.ttf",
        'I' => "arista.ttf",
        ),
	"dejavusanscondensed" => array(
		'R' => "DejaVuSansCondensed.ttf",
		'B' => "DejaVuSansCondensed-Bold.ttf",
		'I' => "DejaVuSansCondensed-Oblique.ttf",
		'BI' => "DejaVuSansCondensed-BoldOblique.ttf",
		),
	"dejavusans" => array(
		'R' => "DejaVuSans.ttf",
		'B' => "DejaVuSans-Bold.ttf",
		'I' => "DejaVuSans-Oblique.ttf",
		'BI' => "DejaVuSans-BoldOblique.ttf",
		),
	"dejavuserif" => array(
		'R' => "DejaVuSerif.ttf",
		'B' => "DejaVuSerif-Bold.ttf",
		'I' => "DejaVuSerif-Italic.ttf",
		'BI' => "DejaVuSerif-BoldItalic.ttf",
		),
	"dejavuserifcondensed" => array(
		'R' => "DejaVuSerifCondensed.ttf",
		'B' => "DejaVuSerifCondensed-Bold.ttf",
		'I' => "DejaVuSerifCondensed-Italic.ttf",
		'BI' => "DejaVuSerifCondensed-BoldItalic.ttf",
		),
	"dejavusansmono" => array(
		'R' => "DejaVuSansMono.ttf",
		'B' => "DejaVuSansMono-Bold.ttf",
		'I' => "DejaVuSansMono-Oblique.ttf",
		'BI' => "DejaVuSansMono-BoldOblique.ttf",
		),


/* OCR-B font for Barcodes */
	"ocrb" => array(
		'R' => "ocrb10.ttf",
		),

/* Thai fonts */
	"garuda" => array(
		'R' => "Garuda.ttf",
		'B' => "Garuda-Bold.ttf",
		'I' => "Garuda-Oblique.ttf",
		'BI' => "Garuda-BoldOblique.ttf",
		),
	"norasi" => array(
		'R' => "Norasi.ttf",
		'B' => "Norasi-Bold.ttf",
		'I' => "Norasi-Oblique.ttf",
		'BI' => "Norasi-BoldOblique.ttf",
		),


/* Indic fonts */
	"ind_bn_1_001" => array(
		'R' => "ind_bn_1_001.ttf",
		'indic' => true,
		),
	"ind_hi_1_001" => array(
		'R' => "ind_hi_1_001.ttf",
		'indic' => true,
		),
	"ind_ml_1_001" => array(
		'R' => "ind_ml_1_001.ttf",
		'indic' => true,
		),
	"ind_kn_1_001" => array(
		'R' => "ind_kn_1_001.ttf",
		'indic' => true,
		),
	"ind_gu_1_001" => array(
		'R' => "ind_gu_1_001.ttf",
		'indic' => true,
		),
	"ind_or_1_001" => array(
		'R' => "ind_or_1_001.ttf",
		'indic' => true,
		),
	"ind_ta_1_001" => array(
		'R' => "ind_ta_1_001.ttf",
		'indic' => true,
		),
	"ind_te_1_001" => array(
		'R' => "ind_te_1_001.ttf",
		'indic' => true,
		),
	"ind_pa_1_001" => array(
		'R' => "ind_pa_1_001.ttf",
		'indic' => true,
		),


/* XW Zar Arabic fonts */
	"xbriyaz" => array(
		'R' => "XB Riyaz.ttf",
		'B' => "XB RiyazBd.ttf",
		'I' => "XB RiyazIt.ttf",
		'BI' => "XB RiyazBdIt.ttf",
		'unAGlyphs' => true,
		),
	"xbzar" => array(
		'R' => "XB Zar.ttf",
		'B' => "XB Zar Bd.ttf",
		'I' => "XB Zar It.ttf",
		'BI' => "XB Zar BdIt.ttf",
		'unAGlyphs' => true,
		),





);


$this->BMPonly = array(
	"dejavusanscondensed",
	"dejavusans",
	"dejavuserifcondensed",
	"dejavuserif",
	"dejavusansmono",
	);$this->sans_fonts = array('dejavusanscondensed','dejavusans','freesans','liberationsans','sans','sans-serif','cursive','fantasy', 
				'arial','helvetica','verdana','geneva','lucida','arialnarrow','arialblack','arialunicodems',
				'franklin','franklingothicbook','tahoma','garuda','calibri','trebuchet','lucidagrande','microsoftsansserif',
				'trebuchetms','lucidasansunicode','franklingothicmedium','albertusmedium','xbriyaz','albasuper','quillscript'

);

$this->serif_fonts = array('dejavuserifcondensed','dejavuserif','freeserif','liberationserif','serif',
				'timesnewroman','times','centuryschoolbookl','palatinolinotype','centurygothic',
				'bookmanoldstyle','bookantiqua','cyberbit','cambria',
				'norasi','charis','palatino','constantia','georgia','albertus','xbzar','algerian','garamond',
);

$this->mono_fonts = array('dejavusansmono','freemono','liberationmono','courier', 'mono','monospace','ocrb','ocr-b','lucidaconsole',
				'couriernew','monotypecorsiva'
);

?>