<?php
/* @var $this ExampleController */
/* @var $data Example */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Field_one')); ?>:</b>
	<?php echo CHtml::encode($data->Field_one); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Field_two')); ?>:</b>
	<?php echo CHtml::encode($data->Field_two); ?>
	<br />


</div>