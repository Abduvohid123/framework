<div class="container">


    <form method="post" action="/register">
        <div class="form-group">
            <label for="exampleInputEmail1">Firstname</label>
            <input name="firstname" type="text" class="form-control <?php echo $model->hasErrors('firstname') ?' is-invalid':'' ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Firstname"
            value="<?php  echo $model->firstname??'' ?>"
            >
            <div class="invalid-feedback">

                <?php echo $model->getFirstError('firstname') ?>
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Lastname</label>
            <input name="lastname" type="text" class="form-control" id="exampleInputPassword1" placeholder="Lastname">
        </div>

        <div class="form-group">
            <label for="exampleInputemail">Email</label>
            <input name="email" type="email" class="form-control" id="exampleInputemail" placeholder="Email">
        </div>

        <div class="form-group">
            <label for="exampleInputpassword">Email</label>
            <input name="password" type="password" class="form-control" id="exampleInputpassword" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputpassword2">Email</label>
            <input name="confirm_password" type="password" class="form-control" id="exampleInputpassword2" placeholder="Confirm Password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
