<?php
use yii\helpers\Url;
$this->registerCss(".preview-thumbnail{ max-width: 120px; max-height: 120px;}");
?>
<div class="page-title">
    <div class="title_left">
        <h3>Posts</h3>
    </div>

    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                <tr class="headings">
                    <th>
                        <input type="checkbox" id="check-all" class="flat">
                    </th>
                    <th class="column-title">Thubmnail</th>
                    <th class="column-title">Title</th>
                    <th class="column-title">Author</th>
                    <th class="column-title">Categories</th>
                    <th class="column-title">Date</th>
                    <th class="column-title">Total views</th>
                    <th class="bulk-actions" colspan="7">
                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                    </th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr class="pointer">
                        <td class="a-center">
                            <input type="checkbox" class="flat" name="table_records">
                        </td>
                        <td><img src="<?= $post->thumbnail ?>" class="preview-thumbnail"></td>
                        <td><a href="<?= Url::toRoute(['post/edit', 'id' => $post->id]) ?>"><?= $post->title ?></a></td>
                        <td><?= $post->author->username ?></td>
                        <td>
                            <?php
                            $started = false;
                            foreach ($post->categories as $category) {
                                if ($started) {
                                    echo ', ';
                                } else {
                                    $started = true;
                                }
                                echo "<a href='#'>$category->title</a>";
                            }
                            ?>
                        </td>
                        <td><?= Yii::$app->formatter->asDate($post->created_at, 'dd-mm-YYYY') ?></td>
                        <td><?= $post->view ?? 0 ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>