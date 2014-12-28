<html>
<head>
    <link href="/assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

        <div class="container">
            <form role="form" enctype="multipart/form-data" method="post" action="/admin/updatecategory/">
                <input type="hidden" name="id" value="<?=$category->id?>" />
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="<?=$category->name?>">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>

                    <select name="parent_id" class="form-control" id="category" placeholder="category">
                        <option value="0">Корневая категория</option>
                        <? foreach ($categories as $cat) { ?>
                            <option value="<?=$cat['id']?>" <?=($category->parentID==$cat['id'])?'selected="selected"':''?>>&nbsp;&nbsp;&nbsp;&nbsp;<?=$cat['name']?></option>
                            <? if (isset($cat['childs']) && is_array($cat['childs'])) { ?>
                                <? foreach($cat['childs'] as $child) { ?>
                                    <option value="<?=$child['id']?>" <?=($category->parentID==$child['id'])?'selected="selected"':''?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$child['name']?></option>
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