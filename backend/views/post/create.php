<?php

use yii\widgets\ActiveForm;
use backend\assets\UploadAsset;

$form = ActiveForm::begin([
        'id' => 'form-create-post',
        'options' => [
            'novalidate' => 'novalidate'
        ]
    ]
);
UploadAsset::register($this);
?>
    <div class="page-title">
        <div class="title_left">
            <h3>Add new post</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-9 col-sm-9 col-xs-9">
            <div style="margin-bottom: 40px;">
                <?= $form->field($model, 'title')->input('text', ['placeholder' => "Enter Your Username", 'class' => 'form-control'])
                    ->label(false) ?>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Content</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="alerts"></div>
                    <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
                        <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i
                                        class="fa fa-font"></i><b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                            </ul>
                        </div>

                        <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i
                                        class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a data-edit="fontSize 5">
                                        <p style="font-size:17px">Huge</p>
                                    </a>
                                </li>
                                <li>
                                    <a data-edit="fontSize 3">
                                        <p style="font-size:14px">Normal</p>
                                    </a>
                                </li>
                                <li>
                                    <a data-edit="fontSize 1">
                                        <p style="font-size:11px">Small</p>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                            <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i
                                        class="fa fa-italic"></i></a>
                            <a class="btn" data-edit="strikethrough" title="Strikethrough"><i
                                        class="fa fa-strikethrough"></i></a>
                            <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i
                                        class="fa fa-underline"></i></a>
                        </div>

                        <div class="btn-group">
                            <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i
                                        class="fa fa-list-ul"></i></a>
                            <a class="btn" data-edit="insertorderedlist" title="Number list"><i
                                        class="fa fa-list-ol"></i></a>
                            <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i
                                        class="fa fa-dedent"></i></a>
                            <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                        </div>

                        <div class="btn-group">
                            <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i
                                        class="fa fa-align-left"></i></a>
                            <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i
                                        class="fa fa-align-center"></i></a>
                            <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i
                                        class="fa fa-align-right"></i></a>
                            <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i
                                        class="fa fa-align-justify"></i></a>
                        </div>

                        <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i
                                        class="fa fa-link"></i></a>
                            <div class="dropdown-menu input-append">
                                <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
                                <button class="btn" type="button">Add</button>
                            </div>
                            <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                        </div>

                        <div class="btn-group">
                            <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i
                                        class="fa fa-picture-o"></i></a>
                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn"
                                   data-edit="insertImage"/>
                        </div>

                        <div class="btn-group">
                            <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                            <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                        </div>
                    </div>
                    <div id="editor-one" class="editor-wrapper" data-input-target="#editor-content"></div>
                    <?= $form->field($model, 'content')->textarea(['class' => 'hidden', 'id' => 'editor-content'])
                        ->label(false) ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Publish </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default">Back</button>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Categories </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
                        $listCheckBox = [];
                        foreach ($categories as $category):
                            $listCheckBox[$category->id] = $category->title;
                        endforeach;
                        ?>
                        <?= $form->field($model, 'categories')->checkboxList($listCheckBox, [
                            'item' => function($index, $label, $name, $checked, $value) {
                                return "<div class='checkbox'><label><input type='checkbox' class='flat' {$checked} name='{$name}' value='{$value}'> {$label}</label></div>";
                            }
                        ])->label(false)
                    ?>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Thumbnail </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="img-post-thumbnail">
                        <button class="btn btn-primary">Upload file</button>
                        <?= $form->field($model, 'thumbnail', ['template' => '{input}{error}'])->fileInput(['class' => 'hidden']) ?>
                        <img class="img-responsive hidden" src="#">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>