<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
    $valid = 1;
    if($_POST['adv_type'] == 'Image Advertisement') {
        $path = $_FILES['photo']['name'];
        $path_tmp = $_FILES['photo']['tmp_name'];
        if($path != '') {
            $ext = pathinfo( $path, PATHINFO_EXTENSION );
            $file_name = basename( $path, '.' . $ext );
            if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
                $valid = 0;
                $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
            }
        }
    } else {
        if(empty($_POST['adv_adsense_code'])) {
            $valid = 0;
            $error_message .= 'You must have to give an adsense code<br>';
        }
    }

    if($valid == 1) {
        if($_POST['adv_type'] == 'Adsense Code') {
            
            if(isset($_POST['previous_photo'])) {
                unlink('../assets/uploads/'.$_POST['previous_photo']);    
            }

            $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?,adv_photo=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
            $statement->execute(array($_POST['adv_type'],'','',$_POST['adv_adsense_code'],1));
        } else {
            if($path == '') {
                // updating into the database
                $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
                $statement->execute(array($_POST['adv_type'],$_POST['adv_url'],'',1));
            } else {
                if(isset($_POST['previous_photo'])) {
                    unlink('../assets/uploads/'.$_POST['previous_photo']);    
                }

                $final_name = 'ad-1.'.$ext;
                move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

                // updating into the database
                $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?, adv_photo=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
                $statement->execute(array($_POST['adv_type'],$final_name,$_POST['adv_url'],'',1));
            }
        }

        $success_message = 'Advertisement is updated successfully.';
    }
}

if(isset($_POST['form2'])) {
    $valid = 1;
    if($_POST['adv_type'] == 'Image Advertisement') {
        $path = $_FILES['photo']['name'];
        $path_tmp = $_FILES['photo']['tmp_name'];
        if($path != '') {
            $ext = pathinfo( $path, PATHINFO_EXTENSION );
            $file_name = basename( $path, '.' . $ext );
            if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
                $valid = 0;
                $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
            }
        }
    } else {
        if(empty($_POST['adv_adsense_code'])) {
            $valid = 0;
            $error_message .= 'You must have to give an adsense code<br>';
        }
    }

    if($valid == 1) {
        if($_POST['adv_type'] == 'Adsense Code') {
            
            if(isset($_POST['previous_photo'])) {
                unlink('../assets/uploads/'.$_POST['previous_photo']);    
            }

            $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?,adv_photo=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
            $statement->execute(array($_POST['adv_type'],'','',$_POST['adv_adsense_code'],2));
        } else {
            if($path == '') {
                // updating into the database
                $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
                $statement->execute(array($_POST['adv_type'],$_POST['adv_url'],'',2));
            } else {
                if(isset($_POST['previous_photo'])) {
                    unlink('../assets/uploads/'.$_POST['previous_photo']);    
                }

                $final_name = 'ad-2.'.$ext;
                move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

                // updating into the database
                $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?, adv_photo=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
                $statement->execute(array($_POST['adv_type'],$final_name,$_POST['adv_url'],'',2));
            }
        }

        $success_message = 'Advertisement is updated successfully.';
    }
}


if(isset($_POST['form3'])) {
    $valid = 1;
    if($_POST['adv_type'] == 'Image Advertisement') {
        $path = $_FILES['photo']['name'];
        $path_tmp = $_FILES['photo']['tmp_name'];
        if($path != '') {
            $ext = pathinfo( $path, PATHINFO_EXTENSION );
            $file_name = basename( $path, '.' . $ext );
            if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
                $valid = 0;
                $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
            }
        }
    } else {
        if(empty($_POST['adv_adsense_code'])) {
            $valid = 0;
            $error_message .= 'You must have to give an adsense code<br>';
        }
    }

    if($valid == 1) {
        if($_POST['adv_type'] == 'Adsense Code') {
            
            if(isset($_POST['previous_photo'])) {
                unlink('../assets/uploads/'.$_POST['previous_photo']);    
            }

            $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?,adv_photo=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
            $statement->execute(array($_POST['adv_type'],'','',$_POST['adv_adsense_code'],3));
        } else {
            if($path == '') {
                // updating into the database
                $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
                $statement->execute(array($_POST['adv_type'],$_POST['adv_url'],'',3));
            } else {
                if(isset($_POST['previous_photo'])) {
                    unlink('../assets/uploads/'.$_POST['previous_photo']);    
                }

                $final_name = 'ad-3.'.$ext;
                move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

                // updating into the database
                $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?, adv_photo=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
                $statement->execute(array($_POST['adv_type'],$final_name,$_POST['adv_url'],'',3));
            }
        }

        $success_message = 'Advertisement is updated successfully.';
    }
}


if(isset($_POST['form4'])) {
    $valid = 1;
    if($_POST['adv_type'] == 'Image Advertisement') {
        $path = $_FILES['photo']['name'];
        $path_tmp = $_FILES['photo']['tmp_name'];
        if($path != '') {
            $ext = pathinfo( $path, PATHINFO_EXTENSION );
            $file_name = basename( $path, '.' . $ext );
            if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
                $valid = 0;
                $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
            }
        }
    } else {
        if(empty($_POST['adv_adsense_code'])) {
            $valid = 0;
            $error_message .= 'You must have to give an adsense code<br>';
        }
    }

    if($valid == 1) {
        if($_POST['adv_type'] == 'Adsense Code') {
            
            if(isset($_POST['previous_photo'])) {
                unlink('../assets/uploads/'.$_POST['previous_photo']);    
            }

            $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?,adv_photo=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
            $statement->execute(array($_POST['adv_type'],'','',$_POST['adv_adsense_code'],4));
        } else {
            if($path == '') {
                // updating into the database
                $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
                $statement->execute(array($_POST['adv_type'],$_POST['adv_url'],'',4));
            } else {
                if(isset($_POST['previous_photo'])) {
                    unlink('../assets/uploads/'.$_POST['previous_photo']);    
                }

                $final_name = 'ad-4.'.$ext;
                move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

                // updating into the database
                $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?, adv_photo=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
                $statement->execute(array($_POST['adv_type'],$final_name,$_POST['adv_url'],'',4));
            }
        }

        $success_message = 'Advertisement is updated successfully.';
    }
}

if(isset($_POST['form5'])) {
    $valid = 1;
    if($_POST['adv_type'] == 'Image Advertisement') {
        $path = $_FILES['photo']['name'];
        $path_tmp = $_FILES['photo']['tmp_name'];
        if($path != '') {
            $ext = pathinfo( $path, PATHINFO_EXTENSION );
            $file_name = basename( $path, '.' . $ext );
            if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
                $valid = 0;
                $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
            }
        }
    } else {
        if(empty($_POST['adv_adsense_code'])) {
            $valid = 0;
            $error_message .= 'You must have to give an adsense code<br>';
        }
    }

    if($valid == 1) {
        if($_POST['adv_type'] == 'Adsense Code') {
            
            if(isset($_POST['previous_photo'])) {
                unlink('../assets/uploads/'.$_POST['previous_photo']);    
            }

            $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?,adv_photo=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
            $statement->execute(array($_POST['adv_type'],'','',$_POST['adv_adsense_code'],5));
        } else {
            if($path == '') {
                // updating into the database
                $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
                $statement->execute(array($_POST['adv_type'],$_POST['adv_url'],'',5));
            } else {
                if(isset($_POST['previous_photo'])) {
                    unlink('../assets/uploads/'.$_POST['previous_photo']);    
                }

                $final_name = 'ad-5.'.$ext;
                move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

                // updating into the database
                $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?, adv_photo=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
                $statement->execute(array($_POST['adv_type'],$final_name,$_POST['adv_url'],'',5));
            }
        }

        $success_message = 'Advertisement is updated successfully.';
    }
}

if(isset($_POST['form6'])) {
    $valid = 1;
    if($_POST['adv_type'] == 'Image Advertisement') {
        $path = $_FILES['photo']['name'];
        $path_tmp = $_FILES['photo']['tmp_name'];
        if($path != '') {
            $ext = pathinfo( $path, PATHINFO_EXTENSION );
            $file_name = basename( $path, '.' . $ext );
            if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
                $valid = 0;
                $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
            }
        }
    } else {
        if(empty($_POST['adv_adsense_code'])) {
            $valid = 0;
            $error_message .= 'You must have to give an adsense code<br>';
        }
    }

    if($valid == 1) {
        if($_POST['adv_type'] == 'Adsense Code') {
            
            if(isset($_POST['previous_photo'])) {
                unlink('../assets/uploads/'.$_POST['previous_photo']);    
            }

            $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?,adv_photo=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
            $statement->execute(array($_POST['adv_type'],'','',$_POST['adv_adsense_code'],6));
        } else {
            if($path == '') {
                // updating into the database
                $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
                $statement->execute(array($_POST['adv_type'],$_POST['adv_url'],'',6));
            } else {
                if(isset($_POST['previous_photo'])) {
                    unlink('../assets/uploads/'.$_POST['previous_photo']);    
                }

                $final_name = 'ad-6.'.$ext;
                move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

                // updating into the database
                $statement = $pdo->prepare("UPDATE tbl_advertisement SET adv_type=?, adv_photo=?, adv_url=?,adv_adsense_code=? WHERE adv_id=?");
                $statement->execute(array($_POST['adv_type'],$final_name,$_POST['adv_url'],'',6));
            }
        }

        $success_message = 'Advertisement is updated successfully.';
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Advertisement</h1>
    </div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_advertisement");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
foreach ($result as $row) {
    $adv_location[] = $row['adv_location'];
    $adv_type[] = $row['adv_type'];
    $adv_photo[] = $row['adv_photo'];
    $adv_url[] = $row['adv_url'];
    $adv_adsense_code[] = $row['adv_adsense_code'];
}
?>

<section class="content" style="min-height:auto;margin-bottom: -30px;">
    <div class="row">
        <div class="col-md-12">
            <?php if($error_message): ?>
            <div class="callout callout-danger">
            
            <p>
            <?php echo $error_message; ?>
            </p>
            </div>
            <?php endif; ?>

            <?php if($success_message): ?>
            <div class="callout callout-success">
            
            <p><?php echo $success_message; ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="content">

    <div class="row">
        <div class="col-md-12">
                            
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Above Welcome Section</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Above Featured Product</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Above Latest Product</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Above Popular Product</a></li>
                        <li><a href="#tab_5" data-toggle="tab">Above Testimonial Section</a></li>
                        <li><a href="#tab_6" data-toggle="tab">Category Page Sidebar</a></li>
                    </ul>
                    <div class="tab-content">


                        <div class="tab-pane active" id="tab_1">
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Type</label>
                                            <div class="col-sm-6" style="width:auto;">
                                                <select name="adv_type" class="form-control" onchange="funcTab1(this)">
                                                    <?php
                                                    if($adv_type[0] == 'Image Advertisement') {
                                                        ?>
                                                            <option value="Image Advertisement" selected>Image Advertisement</option>
                                                            <option value="Adsense Code">Adsense Code</option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <option value="Image Advertisement">Image Advertisement</option>
                                                            <option value="Adsense Code" selected>Adsense Code</option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if($adv_type[0] == 'Image Advertisement'): ?>
                                        <div class="form-group" id="tabField1">
                                            <label class="col-sm-3 control-label">Existing Photo</label>
                                            <div class="col-sm-5" style="padding-top:5px;">
                                                <img src="../assets/uploads/<?php echo $adv_photo[0]; ?>" style="width:400px;">
                                                <input type="hidden" name="previous_photo" value="<?php echo $adv_photo[0]; ?>">
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="form-group" id="tabField2">
                                            <label class="col-sm-3 control-label">New Photo<br><span style="font-size:12px;font-weight:normal;">(Recommended Width: 1170 pixels and Height: any size)</span></label>
                                            <div class="col-sm-5" style="padding-top:5px;">
                                                <input type="file" name="photo">
                                            </div>
                                        </div>
                                        <div class="form-group" id="tabField3">
                                            <label class="col-sm-3 control-label">URL</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="adv_url" class="form-control" value="<?php echo $adv_url[0]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" id="tabField4">
                                            <label class="col-sm-3 control-label">Adsense Code</label>
                                            <div class="col-sm-8">
                                                <textarea name="adv_adsense_code" class="form-control" cols="30" rows="10" style="height:280px;"><?php echo $adv_adsense_code[0]; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label"></label>
                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-success pull-left" name="form1">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="tab_2">
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Type</label>
                                            <div class="col-sm-6" style="width:auto;">
                                                <select name="adv_type" class="form-control"onchange="funcTab2(this)">
                                                    <?php
                                                    if($adv_type[1] == 'Image Advertisement') {
                                                        ?>
                                                            <option value="Image Advertisement" selected>Image Advertisement</option>
                                                            <option value="Adsense Code">Adsense Code</option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <option value="Image Advertisement">Image Advertisement</option>
                                                            <option value="Adsense Code" selected>Adsense Code</option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if($adv_type[1] == 'Image Advertisement'): ?>
                                        <div class="form-group" id="tabField5">
                                            <label class="col-sm-3 control-label">Existing Photo</label>
                                            <div class="col-sm-5" style="padding-top:5px;">
                                                <img src="../assets/uploads/<?php echo $adv_photo[1]; ?>" style="width:400px;">
                                                <input type="hidden" name="previous_photo" value="<?php echo $adv_photo[1]; ?>">
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="form-group" id="tabField6">
                                            <label class="col-sm-3 control-label">New Photo<br><span style="font-size:12px;font-weight:normal;">(Recommended Width: 1170 pixels and Height: any size)</span></label>
                                            <div class="col-sm-5" style="padding-top:5px;">
                                                <input type="file" name="photo">
                                            </div>
                                        </div>
                                        <div class="form-group" id="tabField7">
                                            <label class="col-sm-3 control-label">URL</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="adv_url" class="form-control" value="<?php echo $adv_url[1]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" id="tabField8">
                                            <label class="col-sm-3 control-label">Adsense Code</label>
                                            <div class="col-sm-8">
                                                <textarea name="adv_adsense_code" class="form-control" cols="30" rows="10" style="height:280px;"><?php echo $adv_adsense_code[1]; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label"></label>
                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-success pull-left" name="form2">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="tab-pane" id="tab_3">
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Type</label>
                                            <div class="col-sm-6" style="width:auto;">
                                                <select name="adv_type" class="form-control"onchange="funcTab3(this)">
                                                    <?php
                                                    if($adv_type[2] == 'Image Advertisement') {
                                                        ?>
                                                            <option value="Image Advertisement" selected>Image Advertisement</option>
                                                            <option value="Adsense Code">Adsense Code</option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <option value="Image Advertisement">Image Advertisement</option>
                                                            <option value="Adsense Code" selected>Adsense Code</option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if($adv_type[2] == 'Image Advertisement'): ?>
                                        <div class="form-group" id="tabField9">
                                            <label class="col-sm-3 control-label">Existing Photo</label>
                                            <div class="col-sm-5" style="padding-top:5px;">
                                                <img src="../assets/uploads/<?php echo $adv_photo[2]; ?>" style="width:400px;">
                                                <input type="hidden" name="previous_photo" value="<?php echo $adv_photo[2]; ?>">
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="form-group" id="tabField10">
                                            <label class="col-sm-3 control-label">New Photo<br><span style="font-size:12px;font-weight:normal;">(Recommended Width: 1170 pixels and Height: any size)</span></label>
                                            <div class="col-sm-5" style="padding-top:5px;">
                                                <input type="file" name="photo">
                                            </div>
                                        </div>
                                        <div class="form-group" id="tabField11">
                                            <label class="col-sm-3 control-label">URL</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="adv_url" class="form-control" value="<?php echo $adv_url[2]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" id="tabField12">
                                            <label class="col-sm-3 control-label">Adsense Code</label>
                                            <div class="col-sm-8">
                                                <textarea name="adv_adsense_code" class="form-control" cols="30" rows="10" style="height:280px;"><?php echo $adv_adsense_code[2]; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label"></label>
                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-success pull-left" name="form3">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>



                        <div class="tab-pane" id="tab_4">
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Type</label>
                                            <div class="col-sm-6" style="width:auto;">
                                                <select name="adv_type" class="form-control"onchange="funcTab4(this)">
                                                    <?php
                                                    if($adv_type[3] == 'Image Advertisement') {
                                                        ?>
                                                            <option value="Image Advertisement" selected>Image Advertisement</option>
                                                            <option value="Adsense Code">Adsense Code</option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <option value="Image Advertisement">Image Advertisement</option>
                                                            <option value="Adsense Code" selected>Adsense Code</option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if($adv_type[3] == 'Image Advertisement'): ?>
                                        <div class="form-group" id="tabField13">
                                            <label class="col-sm-3 control-label">Existing Photo</label>
                                            <div class="col-sm-5" style="padding-top:5px;">
                                                <img src="../assets/uploads/<?php echo $adv_photo[3]; ?>" style="width:400px;">
                                                <input type="hidden" name="previous_photo" value="<?php echo $adv_photo[3]; ?>">
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="form-group" id="tabField14">
                                            <label class="col-sm-3 control-label">New Photo<br><span style="font-size:12px;font-weight:normal;">(Recommended Width: 1170 pixels and Height: any size)</span></label>
                                            <div class="col-sm-5" style="padding-top:5px;">
                                                <input type="file" name="photo">
                                            </div>
                                        </div>
                                        <div class="form-group" id="tabField15">
                                            <label class="col-sm-3 control-label">URL</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="adv_url" class="form-control" value="<?php echo $adv_url[3]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" id="tabField16">
                                            <label class="col-sm-3 control-label">Adsense Code</label>
                                            <div class="col-sm-8">
                                                <textarea name="adv_adsense_code" class="form-control" cols="30" rows="10" style="height:280px;"><?php echo $adv_adsense_code[3]; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label"></label>
                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-success pull-left" name="form4">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>



                        <div class="tab-pane" id="tab_5">
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Type</label>
                                            <div class="col-sm-6" style="width:auto;">
                                                <select name="adv_type" class="form-control"onchange="funcTab5(this)">
                                                    <?php
                                                    if($adv_type[4] == 'Image Advertisement') {
                                                        ?>
                                                            <option value="Image Advertisement" selected>Image Advertisement</option>
                                                            <option value="Adsense Code">Adsense Code</option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <option value="Image Advertisement">Image Advertisement</option>
                                                            <option value="Adsense Code" selected>Adsense Code</option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if($adv_type[4] == 'Image Advertisement'): ?>
                                        <div class="form-group" id="tabField17">
                                            <label class="col-sm-3 control-label">Existing Photo</label>
                                            <div class="col-sm-5" style="padding-top:5px;">
                                                <img src="../assets/uploads/<?php echo $adv_photo[4]; ?>" style="width:400px;">
                                                <input type="hidden" name="previous_photo" value="<?php echo $adv_photo[4]; ?>">
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="form-group" id="tabField18">
                                            <label class="col-sm-3 control-label">New Photo<br><span style="font-size:12px;font-weight:normal;">(Recommended Width: 1170 pixels and Height: any size)</span></label>
                                            <div class="col-sm-5" style="padding-top:5px;">
                                                <input type="file" name="photo">
                                            </div>
                                        </div>
                                        <div class="form-group" id="tabField19">
                                            <label class="col-sm-3 control-label">URL</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="adv_url" class="form-control" value="<?php echo $adv_url[4]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" id="tabField20">
                                            <label class="col-sm-3 control-label">Adsense Code</label>
                                            <div class="col-sm-8">
                                                <textarea name="adv_adsense_code" class="form-control" cols="30" rows="10" style="height:280px;"><?php echo $adv_adsense_code[4]; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label"></label>
                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-success pull-left" name="form5">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="tab-pane" id="tab_6">
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Type</label>
                                            <div class="col-sm-6" style="width:auto;">
                                                <select name="adv_type" class="form-control"onchange="funcTab6(this)">
                                                    <?php
                                                    if($adv_type[5] == 'Image Advertisement') {
                                                        ?>
                                                            <option value="Image Advertisement" selected>Image Advertisement</option>
                                                            <option value="Adsense Code">Adsense Code</option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <option value="Image Advertisement">Image Advertisement</option>
                                                            <option value="Adsense Code" selected>Adsense Code</option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if($adv_type[5] == 'Image Advertisement'): ?>
                                        <div class="form-group" id="tabField21">
                                            <label class="col-sm-3 control-label">Existing Photo</label>
                                            <div class="col-sm-5" style="padding-top:5px;">
                                                <img src="../assets/uploads/<?php echo $adv_photo[5]; ?>" style="width:200px;">
                                                <input type="hidden" name="previous_photo" value="<?php echo $adv_photo[5]; ?>">
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="form-group" id="tabField22">
                                            <label class="col-sm-3 control-label">New Photo<br><span style="font-size:12px;font-weight:normal;">(Recommended Width: 260 pixels and Height: any size)</span></label>
                                            <div class="col-sm-5" style="padding-top:5px;">
                                                <input type="file" name="photo">
                                            </div>
                                        </div>
                                        <div class="form-group" id="tabField23">
                                            <label class="col-sm-3 control-label">URL</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="adv_url" class="form-control" value="<?php echo $adv_url[5]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" id="tabField24">
                                            <label class="col-sm-3 control-label">Adsense Code</label>
                                            <div class="col-sm-8">
                                                <textarea name="adv_adsense_code" class="form-control" cols="30" rows="10" style="height:280px;"><?php echo $adv_adsense_code[5]; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label"></label>
                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-success pull-left" name="form6">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                                          


                    </div>
                </div>

                

            </form>
        </div>
    </div>

</section>

<?php require_once('footer.php'); ?>