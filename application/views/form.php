<?php
$html='';
function catdisplay($arr, $id, $i = 0, $j = -1)
{
    global $html;
    foreach ($arr as $data) {
        if ($id == $data->parent_category) {
            if ($i > $j) {
                if ($html == '') {
                    $html .= '<ul class="nav navbar-nav">';
                } else {
                    $html .= '<ul class="dropdown-menu">';
                }
            }
            if ($i == $j) {
                $html .= '</li>';
            }
            $html .= '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">' . $data->name . '<span class="caret"></span></a>';
            if ($i > $j) {
                $j = $i;
            }
            $i++;
            catdisplay($arr, $data->id, $i, $j);
            $i--;
        }
    }
    if ($i == $j) {
        $html .= '</li></ul>';
    }
    return $html;
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-6" style="margin-top: 100px;">
            <h1 class="text-center">Add category form</h1>
            <span style="color:red;"><?= validation_errors() ?></span>
            <form method="post" action="<?= site_url('Arp/save') ?>">
                <div class="form-group">
                    <label>Category name</label>
                    <input class="form-control" name="category" placeholder="Category Name" />
                </div>
                <div class="form-group">
                    <label> Parent Category</label>
                    <select class="form-control" name="parent_category">
                        <option value=""> select category</option>
                        <?php foreach ($category as $cat) { ?>
                            <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" value="Save" class="btn btn-primary" />
                </div>
            </form>
        </div>
        <div class="col-md-6" style="margin-top: 100px; padding:15px">
            <?= catdisplay($category, 0) ?>
        </div>
    </div>
</div>
<script>
    $(".dropdown-toggle").click(function() {
        $(this).next('ul').show();
    });
</script>