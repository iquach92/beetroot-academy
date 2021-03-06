<?php
require 'functions.php';
$book = getBookById($_GET['book_id']);
if (!empty($_POST['comment'])){
    addComment($_POST['comment'], $book['book_id']);
}
print_r($book);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $book['title'] ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-item.css" rel="stylesheet">

</head>

<body>

<?php require_once './templates/header.php'?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-3">
            <h1 class="my-4">Shop Name</h1>
            <div class="list-group">
                <?php foreach (getGenres() as $genre) : ?>
                    <a href="#"
                       class="list-group-item <?php echo ($genre['id'] == $book['genre_id']) ? 'active' : '' ?>"><?php echo $genre['name'] ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            <div class="card mt-4">
                <img class="card-img-top img-fluid" src="http://placehold.it/900x400" alt="">
                <div class="card-body">
                    <h3 class="card-title"><?php echo $book['title'] ?> - <?php echo $book['author'] ?></h3>
                    <h4>₴ <?php echo $book['cost'] ?></h4>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente dicta fugit
                        fugiat hic aliquam itaque facere, soluta. Totam id dolores, sint aperiam sequi pariatur
                        praesentium animi perspiciatis molestias iure, ducimus!</p>
                    <form class="form-inline" action="add_to_cart.php" method="post">
                        <div class="form-group">
                            <label for="count">Количество: </label>
                            <input type="hidden" name="book_id" value="<?php echo $book['book_id']; ?>">
                            <input type="number"  class="form-control" min="1" value="1" id="count" name="count" />
                        </div>
                        <button type="submit" class="btn btn-success">Добавить в Корзину</button>
                    </form>
                </div>
            </div>
            <!-- /.card -->


            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    Отзывы
                </div>
                <div class="card-body">
                    <?php foreach (getComments($book['book_id']) as $coment) : ?>
                        <p><?php echo htmlspecialchars($coment['message']) ?></p>
                        <small class="text-muted">Posted By Annonymus on <?php echo formatCommentDate($coment['added_at']) ?></small>
                        <small class="text-muted">
                                <span class="text-warning">
                                    <?php for ($i = 1; $i <= $coment['rating']; $i++) : ?>
                                        &#9733;
                                        <?php if ($i == 1 && $coment['rating'] == 1) : ?>
                                            &#9734;&#9734;&#9734;&#9734;
                                        <?php elseif ($i == 2 && $coment['rating'] == 2): ?>
                                            &#9734;&#9734;&#9734;
                                        <?php elseif ($i == 3 && $coment['rating'] == 3): ?>
                                            &#9734;&#9734;
                                        <?php elseif ($i == 4 && $coment['rating'] == 4): ?>
                                            &#9734;
                                        <?php endif; ?>

                                    <?php endfor; ?>
                                </span>
                            <?php echo $coment['rating'] ?> stars
                        </small>
                        <hr>
                    <?php endforeach; ?>
                    <form method="post" class="mt-5" action="add_comment.php">
                        <div class="form-group">
                            <textarea class="form-control" rows="5" name="comment" required></textarea>
                        </div>
                        <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['book_id']) ?>">
                        <button type="submit" class="btn btn-success">Добавить</button>
                    </form>
                </div>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col-lg-9 -->

    </div>

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website <?php echo date('Y') ?></p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

