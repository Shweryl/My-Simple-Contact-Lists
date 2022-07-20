<?php
    include "template/header.php";
?>
<div class="container">
    <div class="row vh-100 justify-content-center align-items-center ">
        <div class="col-12 col-md-4" class="shadow-lg">
            <div class="bg-white py-3 px-4 rounded ">
                <h4 class="text-info fw-bold text-center mb-2">Create new contact</h4>
                <?php
                    if(isset($_POST['submit'])){
                        register();
                    }
                ?>
                <form action="" method="post" enctype="multipart/form-data" >
                    <div class="form-group mb-2">
                        <label for="name" class="text-info fw-bold ">
                            <i class="feather-user me-1 fw-bold"></i>Name
                        </label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo old('name'); ?>">
                        <?php if(getError('name')){ ?>
                            <small class="text-danger fw-bold"><em><?php echo getError('name'); ?></em></small>
                        <?php } ?>

                    </div>
                    <div class="form-group mb-2">
                        <label for="email" class="text-info fw-bold d-flex align-items-center">
                            <i class="feather-mail me-1 fw-bold"></i>Email
                        </label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo old('email'); ?>">
                        <?php if(getError('email')){ ?>
                            <small class="text-danger fw-bold"><em><?php echo getError('email'); ?></em></small>
                        <?php } ?>
                    </div>
                    <div class="form-group mb-2">
                        <label for="phone" class="text-info fw-bold d-flex align-items-center">
                            <i class="feather-phone me-1 fw-bold"></i>Phone
                        </label>
                        <input type="phone" name="phone" id="phone" class="form-control" value="<?php echo old('phone'); ?>">
                        <?php if(getError('phone')){ ?>
                            <small class="text-danger fw-bold"><em><?php echo getError('phone'); ?></em></small>
                        <?php } ?>
                    </div>
                    <div class="form-group mb-2">
                        <label for="upload" class="text-info fw-bold ">
                            Upload Photo<i class="feather-arrow-up fw-bold "></i>
                        </label>
                        <input type="file" name="upload" id="upload" class="form-control">
                        <?php if(getError('upload')){ ?>
                            <small class="text-danger fw-bold"><em><?php echo getError('upload'); ?></em></small>
                        <?php } ?>
                    </div>

                    <div class="mt-3 text-end">
                        <button name="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<?php clearError(); ?>

<?php include "template/footer.php"?>
