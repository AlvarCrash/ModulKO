<?php
/*$file = 'D:\PHP\407p\XSD\RFM_044555567_20160325_001.xml';
$schema = 'D:\PHP\407p\XSD\RequestSchema.xsd';
$ab = new DomDocument;
$ab->load($file);

if ($ab->schemaValidate($schema)) {
    print "$file is valid.\n";
} else {
    print "$file is invalid.\n";
}*/


//good!!!
$file = 'D:\PHP\407p\XSD\RFM_044525298_20171127_006.XML';
$schema = 'D:\PHP\407p\XSD\RequestSchema.xsd';
$ab = new DOMDocument;
$ab->load($file);

if ($ab->Schemavalidate($schema)) {
    print "$file is valid.\n";
} else {
    print "$file is invalid.\n";
}

?>



