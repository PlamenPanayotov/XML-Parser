<?php
/** @var \App\Model\Book[] $data */
/** @var $error */
/** @var $message */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP test</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    </head>
    <body>
        <div class="container">
            <form method='get' action='search.php'>
                <input type=text, name='search' placeholder='Search'>
                <input type='submit' value='Search' />
            </form>
        </div>
        <?php if($error): ?>
<span style="color: red"><?= $error; ?></span>
<br /><br />
<?php endif; ?>
        <div class="container"> 
        <br>
        <?php if($message): ?>
<h5><?= $message; ?></h5>
<br /><br />
<?php endif; ?>
        <?php if ($data): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Author</th>
                        <th>Posted At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $book): ?>
                        <tr>
                            <td><?php echo htmlspecialchars(
                                $book->getId()
                            ); ?></td>
                            <td><?php echo htmlspecialchars(
                                $book->getName()
                            ); ?></td>
                            <td><?php echo htmlspecialchars(
                                $book->getAuthor()
                            ); ?></td>
                            <td><?php echo htmlspecialchars(
                                $book->getPostingDate()
                            ); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr>No Data</tr>
                </tbody>
            </table>
            <?php endif; ?>    
            <div class='container'>
                <a href='allBooks.php'>Get All</a>
            </div>
            <div class='container'>    
                <a href='insert.php'>Insert</a>
            </div>    
        </div>
    </body>
</html>