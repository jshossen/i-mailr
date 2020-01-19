<?php
$td = '{"tag":"td","endtag":1,"attributes":{"style":"text-align: center;","valign":"top"},"nodes":['.$h2.','.$p.']}';

$tr1 = '{"tag":"tr","endtag":1,"attributes":{"style":"align: justify;"},"nodes":['.$td.']}';
$tbody1 = '{"tag":"tbody","endtag":1,"attributes":{"style":"text-align: center;"},"nodes":['.$tr1.']}';
$table1 = '{"tag":"table","endtag":1,"attributes":{"style":"text-align: center; margin: 0 auto;"},"nodes":['.$tbody1.']}';

$tr3 = '{"tag":"tr","endtag":1,"attributes":{"style":"align: justify;"},"nodes":['.$td.','.$td.','.$td.']}';
$tbody3 = '{"tag":"tbody","endtag":1,"attributes":{"style":"text-align: center;"},"nodes":['.$tr3.']}';
$table3 = '{"tag":"table","endtag":1,"attributes":{"style":"text-align: center;"},"nodes":['.$tbody3.']}';



$table_cont = '{"tag":"table","endtag":1,"attributes":{"style":"text-align: center; margin: 0 auto;"},"nodes":['.$tbody1.']}';

$container_table = '{"tag":"div","endtag":1,"attributes":{"class":"container","style":"text-align: center; width: 600px; max-width: 100%; margin: 0 auto;"},"nodes":['.$table_cont.']}';
$col_1_table = '{"tag":"div","endtag":1,"attributes":{"class":"row","style":"text-align: center;max-width: 100%; margin: 0 auto;"},"nodes":['.$table1.']}';
$col_3_table = '{"tag":"div","endtag":1,"attributes":{"class":"row","style":"text-align: center;max-width: 100%; margin: 0 auto;"},"nodes":['.$table3.']}';
?>