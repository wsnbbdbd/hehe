<?php
$this->pageTitle=Yii::app()->name . ' - Example';
$this->breadcrumbs=array(
	'Example',
);
Yii::app()->clientScript->registerCoreScript('jquery');
?>

<script language="javascript">
  function byebye ()
  {
    // need a confirmation before submiting
    if (confirm('Are you sure ?'))          
      $("#myForm").submit ();
  }
 
  $(document).ready(function(){
    // powerful jquery ! Clicking on the checkbox 'checkAll' change the state of all checkbox  
    $('#PolymorphicForm_checkAll').click(function () {
        alert(1);
      $("input[type='checkbox']:not([disabled='disabled'])").attr('checked', this.checked);
    });
  });
</script>
 
<?php echo CHtml::beginForm("index.php?r=Example/delete", "post", array("id"=>"myForm")); ?>
 
<table>
  <tr>
    <th><?php echo "Blabla" ?></th>
    <th><?php echo "Blabla bis"; ?></th>
    <th>
    All <?php echo CHtml::activeCheckBox($form, "checkAll", array ("class" => "checkAll")); ?>
    <button type="button" onClick="byebye()">Delete</button>
    </th>
  </tr>
 
  <?php foreach($models as $n=>$rec): ?>
  <tr>
    <td>
    <?php echo CHtml::encode($rec->Field_one); ?>
    </td>
    <td>
    <?php echo CHtml::encode($rec->Field_two); ?>
    </td>
    <td>
    <?php echo CHtml::activeCheckBox($form, "checkRecord_$rec->id"); ?>
    </td>
  </tr>
  <?php endforeach; ?>
 
</table>
<?php echo CHtml::endForm(); ?>