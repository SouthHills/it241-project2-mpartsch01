<?php
require_once 'lib/Data.php';

if(session_status() !== PHP_SESSION_ACTIVE)
{
    session_start();
}

if(isset($_SESSION['reviews']) === false)
{
    $_SESSION['reviews'] = [];
}

if($_SERVER['REQUEST_METHOD'] === 'POST')
{

    if(isset($_POST['clear']))
    {
        session_destroy();
    }
    else
    {
        $name = ($_POST['name']);//forgot htmlentities for hijinks
        $restaurant = htmlentities($_POST['restaurant']);
        $email = htmlentities($_POST['email']);
        $comment = htmlentities($_POST['comment']);
        $review = new Data($name, $restaurant, $email, $comment);
    }

    $_SESSION['reviews'][] = $review;
    header('Location: index.php');
}

?>

<html lang="en">
<head>
    <title>Unbiased Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<main class="container-lg my-3">
    <div class="row">
        <div class="col">
            <h3>Leave a Review</h3>
            <form action="index.php" method="post">
                <label for="name" class="form-label">
                    Your Name
                </label>
                <input id="name" name="name"
                       class="form-control" required placeholder="Your Name"/>
                <label for="email" class="form-label">
                    Your Email
                </label>
                <input type="email" id="email" name="email"
                       class="form-control" placeholder="name@example.com"/>
                <label for="restaurant" class="restaurant-name">
                    Restaurant Name
                </label>
                <input id="restaurant" name="restaurant"
                       class="form-control" placeholder="Restaurant Name" required/>
                <label for="comment" class="comment">
                    Your Honest Review
                </label>
                <input id="comment" name="comment" placeholder="Write Your Review Here"
                       class="form-control" required/>

                <button type="submit" class="btn btn-primary">
                    Submit Your Review
                </button>
            </form>
        </div>
        <div class="col">
            <h3>Published Reviews</h3>
            <ul class="list-group">
                <?php if(isset($_SESSION['reviews'])
                    && count($_SESSION['reviews']) >0): ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Restaurant</th>
                            <th>Review</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($_SESSION['reviews'] as $review): ?>
                            <tr>
                                <td><?= $review->getName(); ?></td>
                                <td><?= $review->getEmail(); ?></td>
                                <td><?= $review->getRestaurant(); ?></td>
                                <td><?= $review->getComment(); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <form action="index.php" method="post">
                            <input type="hidden" name="clear" value="true"/>
                            <button type="submit" class="btn btn-danger mt-3">
                                Clear Reviews
                            </button>
                        </form>
                    </table>
                <?php else: ?>
                    <p>No reviews added yet.</p>
                <?php endif; ?>
            </ul>
        </div>
    </div>

</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
