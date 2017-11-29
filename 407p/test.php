<?php
$file = 'D:\PHP\407p\XSD\RFM_044555567_20160325_001.xml';
$schema = 'D:\PHP\407p\XSD\RequestSchema.xsd';
$ab = new DOMDocument;
$ab->load($file);

if ($ab->Schemavalidate($schema)) {
    print "$file is valid.\n";
} else {
    print "$file is invalid.\n";
}
?>



