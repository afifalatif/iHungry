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
echo "<pre>";
print_r ($response);
for ($x = 0; $x <2; $x++) {
$test =$response->body->results[$x]->id;
$title = $response->body->results[$x]->title;
echo $title;
echo "<br>";
$image= $response->body->results[$x]->image;
echo "<img src=\"https://spoonacular.com/cdn/ingredients_100x100/$image\"/>";
echo "<br>";
$image2= $response->body->results[$x]->imageUrls;
echo "<img src=\"https://spoonacular.com/cdn/ingredients_100x100/$image2\"/>";
echo "<br>";
$response2 = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/$test/information",
  array(
    "X-RapidAPI-Key" => "f0de423a1fmshf077c4714bd76a2p131d6bjsn0818ef1f78e5"
  )
);
echo "Ingredients: ";
echo "<br>";
for ($y = 0; $y < 30; $y++) {
echo $response2->body->extendedIngredients[$y]->original;
}
echo "Instructions: ";
echo "<br>";
echo $response2->body->instructions;
echo "<br>";
//echo "<pre>";
//print_r ($response2);
$response3 = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/guessNutrition?title=$title",
  array(
    "X-RapidAPI-Key" => "f0de423a1fmshf077c4714bd76a2p131d6bjsn0818ef1f78e5"
  )
);
echo "Calories: ";
echo $response3->body->calories->value;
echo $response3->body->calories->unit;
echo "<br>";
echo "Fat: ";
echo  $response3->body->fat->value;
echo $response3->body->fat->unit;
echo "<br>";
echo "Protein: ";
echo  $response3->body->protein->value;
echo $response3->body->protein->unit;
echo "<br>";
echo "Carbs: ";
echo  $response3->body->carbs->value;
echo $response3->body->protein->unit;
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
//echo "<pre>";
//print_r ($response3);
}

//$r = (json_decode($response, true));
//print_r ($r);
//console.log($response);
?>
</html>
