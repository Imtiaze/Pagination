<?php include 'connection.php'; ?>

<?php
/**
page  limit  offset
1       5      0  .
2       5      5  .
3       5      10 .
4       5      15 .

so offset = (page * limit) - limit ;

number_of_page = ceil(44/5) = 8.5 = 9
*/


// limit -> how many rows(records) will be showed in  a page
$limit  = 5;

// total page, ho many page will created based on number of rows
$queryp = "SELECT * FROM people";
$stmt1 = $pdo->prepare($queryp);
$stmt1->execute();
$total_row = $stmt1->rowCount();
$total_page = ceil($total_row / $limit);
//echo $total_row;
//echo $total_page;

$page   = 1;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  //if someone try to put pagenumber number in the link
  if($page > $total_page){
    $page=$total_page;
  }
  if ($page < 1) {
    $page=1;
  }
}

//offset -> from page data will be populated.
$offset = ($page * $limit) - $limit;


$query = "SELECT * FROM people LIMIT $limit offset $offset";
$stmt = $pdo->prepare($query);
$stmt->execute();
$people = $stmt->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body class="bg-info">
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h2>All People</h2>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
          </tr>
          <?php foreach($people as $person): ?>
            <tr>
              <td><?php echo $person->id; ?></td>
              <td><?php echo $person->name; ?></td>
              <td><?php echo $person->email; ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
        <nav aria-label="...">
          <ul class="pagination ">
            <li class="page-item <?= $page <= 1 ? 'disabled':'' ?>" >
              <a class="page-link" href="?page=<?= $page-1; ?>" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <?php for($i=1; $i<=$total_page;$i++): ?>
              <li class="page-item <?= $i==$page?'active':'' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
            <?php endfor; ?>
            <li class="page-item <?= $page>=$total_page ? 'disabled':'' ?>">
              <a class="page-link" href="?page=<?= $page+1; ?>">Next</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</body>
</html>
