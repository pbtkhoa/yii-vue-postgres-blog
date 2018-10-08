<?php

use yii\widgets\ActiveForm;

$categoryFormTemplate = [
    'template' => '
    {label}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {input}
    </div>
    {error}'
];
?>
<div class="page-title">
    <div class="title_left">
        <h3>Categories</h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="x_panel">
            <div class="x_title">
                <h2>Add new category</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php $form = ActiveForm::begin([
                        'id' => 'form-create-category',
                        'options' => [
                            'class' => 'form-horizontal form-label-left'
                        ]
                    ]
                ); ?>
                <?= $form->field($model, 'title', $categoryFormTemplate)->label(null, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) ?>
                <?= $form->field($model, 'description', $categoryFormTemplate)
                    ->textarea()->label(null, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) ?>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Categories List</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Slug</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <th scope="row"><?= $category->id ?></th>
                            <td><?= $category->title ?></td>
                            <td><?= $category->description ?></td>
                            <td><?= $category->slug ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>