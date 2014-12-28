<html>
<head>
    <link href="/assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

        <div class="container">
            <form role="form" enctype="multipart/form-data" method="post" action="/admin/updateitem/">
                <input type="hidden" name="id" value="<?=$item->id?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="<?=$item->name?>">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" placeholder="Description"><?=$item->description?></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" class="form-control" id="category" placeholder="category">

                        <? foreach ($categories as $category) { ?>
                            <option value="<?=$category['id']?>" <?=($item->categoryID==$category['id'])?'selected="selected"':''?>><?=$category['name']?></option>
                            <? if (isset($category['childs']) && is_array($category['childs'])) { ?>
                                <? foreach($category['childs'] as $child) { ?>
                                    <option value="<?=$child['id']?>" <?=($item->categoryID==$child['id'])?'selected="selected"':''?>>&nbsp;&nbsp;&nbsp;&nbsp;<?=$child['name']?></option>
                                <? } ?>
                            <? } ?>
                        <? } ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input name="price" type="text" class="form-control" id="price" placeholder="Price" value="<?=$item->price?>" />
                </div>
                <div class="form-group">
                    <label for="available"><input name="available" type="checkbox" value="1" id="available" placeholder="Available" <?=($item->available) ? 'checked="checked"' : '' ?> /> Available</label>
                </div>

                <img src="<?=$item->image?>" width="200" />

                <div class="form-group">
                    <label for="price">Image</label>
                    <input name="image" type="file" accept="image" id="image" placeholder="Image" />
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>



<script type="text/javascript" src="/assets/js/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>