<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="shortcut icon" href="/application/templates/images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="/application/templates/css/common.css"/>
    <?php $this->includeHeaders();?>
    <title><?php echo $this->getTitle();?> — CGimpel</title>
</head>
<body>
<div class="wrapper">

    <div class="container">
        <main class="main">

            <?php $this->includePage();?>

        </main>
    </div>

    <aside class="left-sidebar">
        <?php include 'parts/menu.php'; ?>
    </aside>

</div>
</body>
</html>