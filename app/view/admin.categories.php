<!DOCTYPE>
<html>
    <head>
        <link href="/assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <a href="/admin/">Администрирование</a>
            <a href="/admin/addcategory/">Добавить категорию</a>
            <div class="row">

                <div class="col-md-12">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>

                            <? foreach($categories as $category) { ?>

                                <tr>
                                    <td><? if ($category['parent_id'] > 0) { ?><?=$category['parent_name']?> > <? } ?><?=$category['name']?></td>
                                    <td>
                                        <a href="/admin/deletecategory/?id=<?=$category['id']?>" class="btn btn-danger btn-xs" onclick="return confirm('Really delete «<?=$item['name']?>»?');">Delete</a>
                                        <a href="/admin/updatecategory/?id=<?=$category['id']?>" class="btn btn-primary btn-xs">Edit</a>
                                    </td>
                                </tr>

                                <? if (isset($category['childs']) && is_array($category['childs'])) { ?>
                                    <? foreach($category['childs'] as $child) { ?>
                                        <tr>
                                            <td><? if ($child['parent_id'] > 0) { ?><?=$child['parent_name']?> > <? } ?><?=$child['name']?></td>
                                            <td>
                                                <a href="/admin/deletecategory/?id=<?=$child['id']?>" class="btn btn-danger btn-xs" onclick="return confirm('Really delete «<?=$child['name']?>»?');">Delete</a>
                                                <a href="/admin/updatecategory/?id=<?=$child['id']?>" class="btn btn-primary btn-xs">Edit</a>
                                            </td>
                                        </tr>
                                    <? } ?>
                                <? } ?>

                            <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="/assets/js/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>