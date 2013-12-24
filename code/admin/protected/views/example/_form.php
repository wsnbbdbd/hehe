<?php
/* @var $this ExampleController */
/* @var $model Example */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'example-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Field_one'); ?>
		<?php echo $form->textField($model,'Field_one',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Field_one'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Field_two'); ?>
		<?php echo $form->textField($model,'Field_two',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Field_two'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->