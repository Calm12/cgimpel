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
        <div class="menu">
            <?php include 'parts/menu-top.php'; ?>
            <div class="horizontal-separator">
                <hr>
            </div>
            <?php $this->includeDynamicMenu();?>
        </div>
    </aside>

</div>
</body>
</html>