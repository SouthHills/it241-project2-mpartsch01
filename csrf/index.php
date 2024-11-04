<?php

if(session_status() !== PHP_SESSION_ACTIVE)
{
    session_start();
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

    if (!$token || $token !== $_SESSION['token'])
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit;
    }
    header('Location: index.php');

}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <title>Valtor's Legit Money Transfers</title>


</head>
<body>
<main>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
    <header>
        <h1>Transfer Funds</h1>
    </header>
    <div>
        <label for="amount">Amount (between $1-$1000):</label>
        <input type="number" name="amount" value ="<?= $inputs['amount'] ?? '' ?>" id="amount" placeholder="Enter amount to transfer: ">
        <small><?= $errors['amount'] ?? '' ?></small>
    </div>

    <div>
        <label for="receiving_account">Receiving Account: </label>
        <input type="number" name="receiving_account" value="<?= $inputs['receiving_account'] ?? '' ?>" id="receiving_account" placeholder="Enter the receiving account: ">
        <small><?= $errors['receiving_account'] ?? '' ?></small>
    </div>

    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">
    <button type="submit"> Transfer Now</button>

</form>
    <?php if(isset($_SESSION['token'])): ?>

    <p><?= $_SESSION['token']?></p>
    <p>This token is for demonstration purposes only. A real life application would not show this.</p>
    <?php endif; ?>

</main>

<p>Copyright 2024</p>

</body>


</html>
