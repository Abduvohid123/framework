<div class="container">

    <?php  $form=  \app\core\form\Form::begin('/login','post') ?>

    <?php echo $form->field($model,'email') ?>
    <?php echo $form->field($model,'password')->passwordField() ?>

    <button type="submit" class="btn btn-primary">Submit</button>


    <?php  \app\core\form\Form::end(); ?>

</div>
