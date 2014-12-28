<!DOCTYPE>
<html>
    <head>
        <link href="/assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <ul class="nav nav-pills nav-stacked">
                        <? foreach ($categories as $category) { ?>
                            <li role="presentation" <?=$_GET['id']==$category['id']?' class="active"':''?>><a href="/category/?id=<?=$category['id']?>"><?=$category['name']?></a></li>
                        <? } ?>
                    </ul>
                </div>
                <div class="col-md-8"></div>
            </div>
        </div>

        <script type="text/javascript" src="/assets/js/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>