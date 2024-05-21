<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
       if($_POST['keyword'] && strlen(trim($_POST['keyword'])) > 0)
       {
        include 'base.php';
        $keyword = $_POST['keyword'];
        $operation = new Operation();
        $operation->transaction('hanap',$keyword);
       } else { echo "Empty";}
    ?>
    <form action="search.php" method="post">
        <input type="text" name="keyword" required>
        <input type="submit" value="Search">
    </form>
</body>
</html>