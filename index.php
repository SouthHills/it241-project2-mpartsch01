<?php //this is the cleansed one

if(session_status() !== PHP_SESSION_ACTIVE)
{
    session_start();
}

if(isset($_SESSION["reviews"]) === false)
{
    $_SESSION["reviews"] = [];
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST["submit"]))
    {
        session_destroy();
    }
    else
    {
        $name = htmlentities($_POST["name"]);
        $restaurant = htmlentities($_POST["restaurant"]);
        $comment = htmlentities($_POST["comment"]);

    }

    header('Location: index.php');
}

$successMessage = "";
if($_SERVER["REQUEST_METHOD"] === "POST")
{
    // get the submitted form data
    $name = ($_POST["name"]);
    $restaurant = $_POST["restaurant"];
    $comment = $_POST["comment"];

    // basic server-side validation
    if(empty($name))
    {
        $errors[] = "Your name is required.";   //adds to the errors array
    }

    if(empty($restaurant))
    {
        $errors[] = "Restaurant is required.";
    }

    if(empty($review))
    {
        $errors[] = "A review is required.";
    }

    if($errors = [])
    {
        $successMessage = "Your review has been submitted.";
    }
}
?>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Can I Speak to your Manager?</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<main class="container-lg my-3">
<div class="row">
    <h3>Write a Review</h3>
    <form action="index.php" method="post">
        <?php if(empty($errors) === false): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?= htmlentities($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if(empty($successMessage) === false): ?>
        <div class="alert alert-success">
            <?= $successMessage ?>
            <?php endif; ?>
        <label for="name" class="form-label form-group-sm">
            Your Name
        </label>
        <input id="name" name="name"
               class="form-control" required/>
        <label for="restaurant" class="restaurant-name">
            Restaurant Name
        </label>
        <input id="restaurant" name="restaurant"
               class="form-control form-group-sm" required/>
        <label for="comment" class="comment">
            Your Honest Review
        </label>
        <textarea id="comment" name="comment" placeholder="Write Your Review Here"
                  class="form-control" required>
        </textarea>
        <button type="submit" class="btn btn-primary">
            Post Review
        </button>
    </form>
</div>

</main>
</body>
</html>