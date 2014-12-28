<!DOCTYPE>
<html>
    <head>
        <link href="/assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <ul class="nav nav-pills">
                        <? foreach ($categories as $category) { ?>
                            <li role="presentation" <?=(isset($_GET['id']) && $_GET['id'] == $category['id'])?' class="active"':''?>><a href="/category/?id=<?=$category['id']?>"><?=$category['name']?></a>
                                <? if (isset($category['childs']) && is_array($category['childs'])) { ?>
                                    <ul>
                                        <? foreach($category['childs'] as $child) { ?>
                                            <li><a href="/category/?id=<?=$child['id']?>"><?=$child['name']?></a></li>
                                        <? } ?>
                                    </ul>
                                <? } ?>
                            </li>
                        <? } ?>
                    </ul>
                </div>
                <div class="col-md-9">

                    <? foreach($items as $item) { ?>
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <img src="<?=$item['image']?>" alt="...">
                                <div class="caption">
                                    <h3><?=$item['name']?></h3>
                                    <p>Price: <?=$item['price']?></p>
                                </div>
                            </div>
                        </div>
                    <? } ?>

                </div>
            </div>
        </div>
        <script type="text/javascript" src="/assets/js/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>