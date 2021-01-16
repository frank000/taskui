<?php
declare(strict_types=1);
//
//$cli = new SoapClient('http://www.webservicex.net/ConvertTemperature.asmx?WSDL');
//
//var_dump($cli->__);
//var_dump($cli->numberToDollars('10'));
//echo $cli->NumberToWords('frank');


//$options = array(
//    'uri' => 'http://127.0.0.1:8000/server.php',
//    'location' => 'http://127.0.0.1:8000/server.php'
//);
//
//$cli = new SoapClient(null,$options);
//
//var_dump($cli->somar(10, 15)); // 25s


//echo substr('franklim',3);-3

////var_dump(explode('k','franklim'));
////var_dump(explode('k','franklim',3));/numero é tanho do array, qntos childs
//var_dump(str_split('franklim',1));array (size=8)
//  0 => string 'f' (length=1)
//  1 => string 'r' (length=1)
//  2 => string 'a' (length=1)
//  3 => string 'n' (length=1)
//  4 => string 'k' (length=1)
//  5 => string 'l' (length=1)
//  6 => string 'i' (length=1)
//  7 => string 'm' (length=1)

//$var = '<a>franklim</a>';
//var_dump(htmlspecialchars($var));
//$var = htmlspecialchars_decode($var);
//var_dump($var);
//
//$array = array('lastname', 'email', 'phone');
//$comma_separated = implode(",", $array);
//similar_text(  'ana' ,  'a' ,$per);
//var_dump($per);
//
//
//$format = "o valor decimal: %.02f";
//
//printf($format,10.5);
////
//$format = "o valor decimal: %d";
//
//printf($format,10);
//$format = "o valor decimal: %s";
//
//printf($format,'asdfas');
//var_dump(printf($format,10));
//$format = "o valor decimal: %f";
//
//$var = sprintf($format,'5.5');
//echo $var;


//$arr = array('franklim','15');
//$format = '%s -- %d';
//
//vprintf($format,$arr);

//$arr = array('franklim','15');
//$format = '%s -- %d';
//
//echo vsprintf($format,$arr);

//echo strlen("franklim");//8
//echo strpos("halde a new certification",'0');// posição ou null   CASE SENSITIVE

//$fp = fopen('date.txt', 'w+')
//
//fprintf($fp, "%04d-%02d-%02d", '2020', '10', '15');
// will write the formatted ISO date to date.txt
//var_dump( strpos("halde a new certification",'CER'));//false CASE
//var_dump( strripos("halde a new certification",'CER'));//12 INSENSITEVE


//var_dump( strcmp("15", 0xf));//TYPE ERROR
//var_dump(metaphone("casas"));

//preg_match('/(foo)(bar)(baz)/', 'foobarbaz', $matches, PREG_OFFSET_CAPTURE);
//var_dump($matches);


//var_dump(preg_match('/bar/', 'foobarbaz'));// 1
//var_dump(preg_match('/BAR/', 'foobarbaz'));// 0
//var_dump(preg_match('/BAR/i', 'foobarbaz'));// 1 (i case insensitive)
//var_dump(preg_match('#BAR#i', 'foobarbaz'));// 1 (i case insensitive)
//var_dump(preg_match_all('#a#', 'foobarbaz'));// quantidade a (i case insensitive)
//var_dump(preg_replace('#Fran#i', 'FRAN','franklim'));// quantidade a (i case insensitive)


//var_dump(preg_match('/at/', 'Pata'));//
//var_dump(preg_match('/[ch]at/', 'pat'));// cabe com qq dentro dfe []

//var_dump(preg_match('/[^P]/', 'Pat'));//nega P começando
//var_dump(preg_match('/c?at/', 'at'));// cat ou at
//var_dump(preg_match('/c?at/', 'at'));// cat ou at

//\d	[0-9]	Que esteja no intervalo de 0 a 9.
//\D	[^0-9]	Que não esteja no intervalo de 0 a 9.
//\s	[ \t\n\r\f\v]	Espaços em branco.
//\S	[^ \t\n\r\f\v]	O que não for caracteres em branco.
//\w	[a-zA-Z0-9_]	Alfanuméricos e underscore.
//\W	[^a-zA-Z0-9_]	O que não for alfanumérico e underscore.
//
///(expressão)/i	Case Insensitive. Não diferencia maiúsculas de minúsculas.
///(expressão)/m	Os metacaracteres “^” e “$” serão início e fim de linha, podendo o texto ter várias linhas.
///(expressão)/s	Adicionar a quebra de linha (\n) ao metacaractere "."
///(expressão)/x	Estendido. Permite utilizar comentários e espaços na expressão regular, inclusive em mais de uma linha.
///(expressão)/U	Transforma a expressão em não guloso, ou seja, tenta casar o menor texto possível.
///
//
//$cpf = '0 34 .247.541-20';
//$cpf = preg_replace("/[^0-9]/", "", $cpf);
//var_dump($cpf);

//$str = "first=value&arr[]=foo+bar&arr[]=baz";
//parse_str($str);
//echo $first;  // value
//echo $arr[0]; // foo bar
//echo $arr[1]; // bazecho
//echo str_repeat('teste', 2);

//$imp = 'franklim';
//
//var_dump( str_pad($imp,10));
//var_dump( str_pad($imp,15,'.'));
//var_dump( str_pad($imp,15,'.',STR_PAD_LEFT));
//var_dump( str_pad($imp,15,'.',STR_PAD_BOTH));
//
//$email  = 'name@example.com';
//
//echo strstr($email,'@');
//echo strstr($email,'@',true);//igual strchr

//echo  strspn("1407 is 7 the answer, what is the question7 ...", "123456890");
//echo  strspn("1407 is 7 the answer, what is the question7 ...", "123456890",0,2);

//
//$a = [0=>1,1=>2,2=>3];
//$b = ['1',2,3];
//
//
//var_dump($a == $b);
$a = [null=>1,0x15A=>2,8.7=>3];


var_dump($a);














