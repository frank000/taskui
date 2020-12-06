<?php
declare(strict_types=1);
//
//class Animal{
//    public function getClosure()
//    {
//        $valorVinculado = 'Animal ';
//        return function () use ($valorVinculado){
//            return $valorVinculado . $this->natureza;
//        };
//    }
//}
//
//class Gato extends Animal{
//    protected $natureza = 'chato';
//
//
//}
//class Cachorro extends Animal{
//    protected $natureza = 'amável';
//
//}
//
//$gato = new Gato();
//$val = $gato->getClosure();
//echo $val();
//
//$chorro = $val->bindTo(new Cachorro());
//
//echo $chorro();
//
//die;

//(function (){
//    echo 'Sekf abibyunius fuction';
//    echo $varClousure = 'VAriável set';
//
//})();

//
//// Exemplo de função de callback
//function my_callback_function() {
//    echo 'hello world!';
//}
//
//// Exemplo de método de callback
//class MyClass {
//    static function myCallbackMethod() {
//        echo 'Hello World!';
//    }
//}
//
//call_user_func('MyClass::myCallbackMethod');
//call_user_func(array('MyClass','myCallbackMethod'));
//
//$obj = new MyClass();
//call_user_func(array($obj,'myCallbackMethod'));

//class A {
//    public static function who() {
//        echo "A\n";
//    }
//}
//
//class B extends A {
//    public static function who() {
//        echo "B\n";
//    }
//}
//
//call_user_func(array('B', 'parent::who')); // A

//function mulit(float $a, float $b):float{
//    return (double)$a *  (double)$b;
//}
//$ecc = mulit(2,3);
//echo gettype($ecc);

//function teste($ca, ...$extra, $cat){
//    echo "i have " . func_get_args() . 'argos . ' ;
//}
//teste(1,2,3,4,5);


//if (!is_callable(function (){
//    echo 'HELO .';
//})){
//    function sayHello(){
//        echo 'World';
//    }
//}
//sayHello();//erro undefined funciton


////
//Namespace myapp\utils\A;
//const BAS ="asdf ";
//function Hello(){ return __NAMESPACE__; }
//
//Namespace B;
//function Hello(){ return __NAMESPACE__; }
//
//Namespace C;
//use \myapp\utils\A\Hello;
//echo Hello();


////
//Namespace myapp\utils\hello;
//
//function world(){ return __NAMESPACE__; }
//
//
//Namespace C;
//use \myapp\utils\hello;
//echo hello\world();

//Namespace A;
//$clos = function (){ echo __NAMESPACE__;};
//Namespace C;
//
//$clos(); // a
//
//Namespace B;
//
//$clos = function (){ echo __NAMESPACE__;};
//
//Namespace C;
//
//$clos(); // B
//
//$a = [0=>'a', 1=>'b',2=>'c'];
//$b = ['as', 'bs','cs'];
//$c = $a = $b;
//print_r($c);

//$str = "<h1>Frankli'm \Araújo Paulino NUL</h1>";
//$res = addcslashes($str,'a,n...p');
//echo($str).PHP_EOL;
//echo($res).PHP_EOL;
//var_dump($str);
//var_dump($res);
//var_dump(get_magic_quotes_gpc());

//
//$text = "\n\tThese are a few words :) ...  ";
//$binary = "\x09Example string\x0A";
//$hello  = "Hello World";
//var_dump($text, $binary, $hello);
//print "\n";
//
//$trimmed = trim($text, " \n");
//var_dump($trimmed);
//$trimmed = trim($hello, "HdlW");
//var_dump($trimmed);

//print '[code]<?php'.PHP_EOL;
//$sub = addcslashes(mysql_real_escape_string(“%something_”), “%_”);
//echo $sub;
////mysql_query(“SELECT * FROM messages WHERE subject LIKE ‘$sub%'”);
/*print '?>[/code]';*/

//$str = "<h1><p>Frankli'm \Araújo Paulino NUL $ e &</p></h1>";
//$res = strip_tags($str,'<p>');
//echo($str).PHP_EOL;
//echo($res).PHP_EOL;
//var_dump($str);
//var_dump($res);
//var_dump(get_magic_quotes_gpc());

//$str = "<h1><p>Frankli'm \Araújo Paulino NUL $ e &</p></h1>";
//$res = htmlentities($str); //tudo que é possivel para HTML decode com html_entity_decode, segundo
////paraemetro ENT_QUOTES, (quota " e '), ENT_NOQUOTES n quota enhuima
////$res = htmlspecialchars($str); ///somente especial charetes
//echo($str).PHP_EOL;
//echo($res).PHP_EOL;
//var_dump($str);
//var_dump($res);
//var_dump(get_magic_quotes_gpc());

//$str = 'fran , franklim, neovo';
//$arr = explode(',',$str);
//var_dump($arr);
//var_dump(implode(' - ', $arr));
//var_dump(html_entity_decode(chunk_split($str,3,'\n')));

//conta a quantidade de charetes e suas ocorrencias, array cch ACII e quantidade
//$data = "Two Ts and one F.";
//var_dump(count_chars($data, 1) );
//foreach (count_chars($data, 1) as $i => $val) {
//    echo "There were $val instance(s) of \"" , chr($i) , "\" in the string.\n";
//print "<br>";
//}
//chr($i) essa função recebe uim int AASCII e retorna o charactere


//
//define('CONSTANT',1);
//define('_CONSTANT',0);
//define('_EMPTY','as');
//echo _EMPTY;
