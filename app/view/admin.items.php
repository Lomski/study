<!DOCTYPE>
<html>
    <head>
        <link href="/assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <a href="/admin/">Администрирование</a>
            <a href="/admin/additem/">Добавить товар</a>
            <div class="row">

                <div class="col-md-12">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <td>Photo</td>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Category</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach($items as $item) { ?>
                                <tr>
                                    <td><img src="<?=$item['image']?>" width="70"></td>
                                    <td><?=$item['name']?></td>
                                    <td><?=$item['price']?></td>
                                    <td><? if ($item['parent_id'] > 0) { ?><a href="/admin/category/?id=<?=$item['parent_id']?>"><?=$item['category_parent_name']?></a> > <? } ?> <a href="/admin/category/?id=<?=$item['category_id']?>"><?=$item['category_name']?></a></td>
                                    <td>
                                        <a href="/admin/deleteitem/?id=<?=$item['id']?>" class="btn btn-danger btn-xs" onclick="return confirm('Really delete «<?=$item['name']?>»?');">Delete</a>
                                        <a href="/admin/updateitem/?id=<?=$item['id']?>" class="btn btn-primary btn-xs">Edit</a>
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="/assets/js/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>