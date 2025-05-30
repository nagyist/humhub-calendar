<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 *
 */

use humhub\modules\calendar\interfaces\event\CalendarTypeSetting;
use humhub\modules\calendar\models\CalendarEntryType;
use humhub\modules\ui\form\widgets\ActiveForm;
use humhub\modules\ui\form\widgets\ColorPicker;
use humhub\widgets\ModalButton;
use humhub\widgets\ModalDialog;

/* @var $model CalendarEntryType|CalendarTypeSetting */

if ($model instanceof CalendarTypeSetting) {
    $title = Yii::t('CalendarModule.views', '<strong>Edit</strong> calendar');
    $titleAttribute = 'title';
    $titleDisabled = true;
} else {
    $title = ($model->isNewRecord)
        ? Yii::t('CalendarModule.views', '<strong>Create</strong> new event type')
        : Yii::t('CalendarModule.views', '<strong>Edit</strong> event type');
    $titleAttribute = 'name';
    $titleDisabled = false;
}

?>

<?php ModalDialog::begin(['header' => Yii::t('CalendarModule.views', $title)]); ?>
<?php $form = ActiveForm::begin() ?>
<div class="modal-body">
    <div id="event-type-color-field" class="form-group space-color-chooser-edit" style="margin-top: 5px;">
        <?= ColorPicker::widget(['model' => $model, 'container' => 'event-type-color-field']); ?>
        <?= $form->field($model, $titleAttribute, ['template' => '
                                {label}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i></i>
                                    </span>
                                    {input}
                                </div>
                                {error}{hint}'
        ])->textInput(['disabled' => $titleDisabled, 'placeholder' => Yii::t('CalendarModule.config', 'Name'), 'maxlength' => 100, 'autofocus' => ''])->label(false) ?>
    </div>
    <?php if ($model instanceof CalendarTypeSetting && $model->canBeDisabled()) : ?>
        <?= $form->field($model, 'enabled')->checkbox() ?>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <?= ModalButton::submitModal(); ?>
    <?= ModalButton::cancel(); ?>
</div>
<?php ActiveForm::end() ?>
<?php ModalDialog::end() ?>
