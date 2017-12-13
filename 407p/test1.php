<?php

//echo "(0|\-?[1-9][0-9]*)";
//$schema = 'C:\PROJECT\ModulKO\407p\XSD\RFM_044555567_20160325_001.xml';
//$ab = new DOMDocument;
//$ab->load($schema);

//print_r ($ab);
$file = 'C:\PROJECT\ModulKO\407p\XSD\RFM_044525298_20171127_006.XML';
$schema = 'C:\PROJECT\ModulKO\407p\XSD\RequestSchema.xsd';
$ab = new DOMDocument;
$ab->load($file);

if ($ab->Schemavalidate($schema)) {
    print "$file is valid.\n";
} else {
    print "$file is invalid.\n";
}
?>



