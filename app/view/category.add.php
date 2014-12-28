<html>
<head>
    <link href="/assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

        <div class="container">
            <form role="form" enctype="multipart/form-data" method="post" action="/admin/addcategory/">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="parent_id" class="form-control" id="category" placeholder="category">
                        <option value="0">Корневая категория</option>
                        <? foreach ($categories as $category) { ?>
                            <option value="<?=$category['id']?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$category['name']?></option>
                            <? if (isset($category['childs']) && is_array($category['childs'])) { ?>
                                <? foreach($category['childs'] as $child) { ?>
                                    <option value="<?=$child['id']?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$child['name']?></option>
                                <? } ?>
                            <? } ?>
                        <? } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>

<script type="text/javascript" src="/assets/js/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>