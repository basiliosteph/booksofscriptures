<?php
require "vendor/autoload.php";

use GuzzleHttp\Client;

function getBooks() {
    $token = '7174ddf3ff4c48fd17ecaeb51aae754d53e630297bd7012761194f3da8c3d9e86db9d2660c22b89f10c236aabca734f8e957b76e082ca3fd548a59ae487a1173009bc4424ad7860844081307b30fa18823848f5fae24d2df374a1f835cc5c1a9b4c1c69f73a45d691efcc2af691b8d1c0c59554aae2d34b19a39575fd8d55606';
    try {
    $client = new Client(['base_uri' => 'http://localhost:1337/api/']);
    $response = $client->request('GET', 'books?pagination[pageSize]=66', [
      'headers' => [
        'Authorization' => 'Bearer ' . $token,        
        'Accept'        => 'application/json',
    ]
  ]);
    $body = $response->getBody();
    $decoded_response = json_decode($body);
    return $decoded_response;

} catch (Exception $e) {
  error_log($e->getMessage());
  echo '<pre>';
  var_dump($e);
}
 return null;
   
    }
    
$books = getBooks();
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <title> Books of the Bible </title>
    </head>

 <body>
    <div class="container">
      <div class="row">
        <div class="col-9">
          <h1> All Books of the Bible </h1> 
        </div>
      <table class="table">
    <thead class="table-dark">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Author</th>
        <th scope="col">Category</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($books->data as $bookData){
        $book = $bookData->attributes;?>
        <tr>
          <th scope="row"><?php echo $bookData->id ?></th>
          <td><?php echo $book->name ?></td>
          <td><?php echo $book->author ?></td>
          <td><?php echo $book->category ?></td>
        </tr>
        <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>
