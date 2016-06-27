<?php
include_once('auth.php');
$auth = new auth();

if (isset($_COOKIE['checked'])) {
    header('Location: ' . $auth->getUrl('chat.php'));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<H2>Enter your name:</H2>

<form action="/" method="post">
    <input type="text" name="name" value="<?php echo $auth->getPostParam() ? $auth->getPostParam() : ''; ?>">
    <button type="submit" name="Submit" value="Submited">Submit</button>
</form>

<?php
$auth->user();
$auth->validation_errors();

?>

</body>
</html>