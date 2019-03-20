<!Doctypehtml>
<html>
<head>
<title>iHungry/Recipee</title>
</head>
<body>
<form action="Recipee.php">
  Please enter ingredients separated by a comma:<br>
  <input type="text" name="ingredients" ><br><br>
  <input type="submit" value="Submit">
</form>
<?php
require_once 'unirest-php/src/Unirest.php';
$ingredients = $_GET['ingredients'];
//echo $ingredients;
$response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/search?offset=0&query=$ingredients",
  array(
    "X-RapidAPI-Key" => "f0de423a1fmshf077c4714bd76a2p131d6bjsn0818ef1f78e5"
  )
);
//echo "<pre>";
//print_r ($response);
for ($x = 0; $x <5; $x++) {
$test =$response->body->results[$x]->id;
//echo $test;
echo $response->body->results[$x]->id;
echo "<br>";
echo $response->body->results[$x]->title;
echo "<br>";
echo $response->body->results[$x]->readyInMinutes;
echo "<br>";
echo $response->body->results[$x]->servings;
echo "<br>";
echo $response->body->results[$x]->image;
echo "<br>";
echo $response->body->results[$x]->imageUrls;
echo "<br>";
$response2 = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/$test/information",
  array(
    "X-RapidAPI-Key" => "f0de423a1fmshf077c4714bd76a2p131d6bjsn0818ef1f78e5"
  )
);
echo $response2->body->instructions;
echo "<br>";

//echo "<pre>";
//print_r ($response2);

}

//$r = (json_decode($response, true));
//print_r ($r);
//console.log($response);
?>
</html>
