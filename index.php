<?php
$arr = [];
$arrExp = [];
$arrNew = [];
$arrNewKey = [];
$arrFullName = [];
$arrShotName = [];
$arrGender = [];
$arrProc = [];
$arrSex = [];
$name = '';
$surname = '';
$patronomyc = '';
$str = '';
$arrKey = ['surname', 'name', 'patronomyc'];
$fullName = '';
include 'person.php';

//Получаем новый массив состоящий из ключей fullname
	foreach ($example_persons_array as $elem) {
		//$arr = $elem['fullname'];
		array_push($arr,$elem['fullname']); 
	};
	
	
	
//Разбиваем каждую строку массива на отдельные слова	
	foreach ($arr as $item) {
		$str = $item;
		$arrExp = explode(' ', $str);
		array_push($arrNew,$arrExp); 
	}
var_dump($arrNew[0]);
echo '<br>';




//принимает как аргумент одну строку — склеенное ФИО. 
//Возвращает как результат массив из трёх элементов с ключами ‘name’, ‘surname’ и ‘patronomyc’
function getPartsFromFullname ($keys, $elems) {
	$arrKE = [];
	foreach ($elems as $index) {
		$arrKE[] = array_combine($keys,$index);		
	}
	//var_dump($arrKE);
	return $arrKE;	
}




$arrNewKey = (getPartsFromFullname ($arrKey,$arrNew));
var_dump($arrNewKey[0]);
echo '<br>';



//принимает как аргумент три строки — фамилию, имя и отчество. 
//Возвращает как результат их же, но склеенные через пробел.
function getFullnameFromParts ($strSurname, $strName, $strPatronomyc) {
	$arrFull = [];
	$result = '';
	$result = $strSurname.' '.$strName.' '.$strPatronomyc;
	array_push($arrFull, $result);
	return $arrFull;
	
};


foreach ($arrNew as $index){
	$surname = $index[0];
	$name = $index[1];
	$patronomyc = $index[2];
	$arrFullName[] = getFullnameFromParts($surname, $name, $patronomyc);
	//var_dump($arrFullName);
	//echo '<br>';
};
var_dump($arrFullName[1]);
echo '<br>';




//возвращающую строку вида «Иван И.»
function getShortName ($fulArr){
	$sName = '';
	$sSName = '';
	$s = '';
	$shotArr = [];
	foreach ($fulArr as $index){
		$sName = $index[1];
		$sSName = mb_substr($index[0],0,1);
		$s = $sName.' '.$sSName;
		$shotArr[] = $s;
	}
	return $shotArr;
};

$arrShotName = getShortName($arrNew);
var_dump ($arrShotName[0]);
echo '<br>';





//Определение пола 
function getGenderFromName ($genderArr){
	$s = '';
	$genArr = [];
	foreach ($genderArr as $index){
			if ((mb_substr($index[1],-1)=='а')|| (mb_substr($index[2],-3)=='вна')||(mb_substr($index[0],-2)=='ва')){
				$s = 'women';
				$genArr[] = $s;
			}
			else {
				$s = 'man';
				$genArr[] = $s;
			}					
	}
	return $genArr;
}

$arrGender = getGenderFromName($arrNew);
var_dump ($arrGender[0]);
echo '<br>';





//Определение процентного состава аудитории
function getGenderDescription ($gender){
	$m = 0;
	$w = 0;
	$totalMan = 0;
	$totalWoman = 0;
	foreach ($gender as $index){
		$index == "man" ? $m++ : $w++; 
	}
	$totalMan=round(($w*100)/$m);
	$totalWoman = 100 - $totalMan;
	echo 'Гендерный состав аудитории';
	echo '<br>';	
	echo '--------------------------';
	echo '<br>';
	echo 'Мужчины - '.$totalMan.'%' ;
	echo '<br>';
	echo 'Женщины - '.$totalWoman.'%';
	
}

$arrProc = getGenderDescription($arrGender);
echo '<br>';




//Случайное число 0-10
function randomNum(){
	return mt_rand(0,10);
}

//Перезапуск случайных чисел, если совпали sex
function restart($arr,$arrShot){
	$intRandom = 0;
	$intRandom2 = 0;
	$intRandom = randomNum();
	$intRandom2 = randomNum();
	start($arr,$arrShot,$intRandom,$intRandom2);
}




//Запуск основной программы
function start($arr,$arrShot,$intR,$intR2){
	$num = 0;
	if ($arr[$intR][3] == $arr[$intR2][3]){
		restart($arr,$arrShot);
	}
	else {
		echo $arrShot[$intR].' + '.$arrShot[$intR2];
		$num = (mt_rand(5000,10000))/100;
		echo '<br>';
		echo "\u{1F498}".'Идеально на '.$num.'%'."\u{1F498}";
	}	
}

function getPerfectPartner ($key,$value,$shot){
	$totalArr = [];
	$i = 0;
	foreach ($value as $index){
		$index[] = $key[$i];
		$i++;
		$totalArr[] = $index;
	}
	start($totalArr,$shot,0,0);
	
	
}
$arrSex = getPerfectPartner($arrGender,$arrNew,$arrShotName);
echo '<br>';
?>	