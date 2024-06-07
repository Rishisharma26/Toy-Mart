<?php

require('topinc.php');

if(isset($_GET['type']) && $_GET['type']!='')
{
    $type = get_safe_value($con, $_GET['type']);
    if($_GET['type']=='status')
    {
        $operation = get_safe_value($con, $_GET['operation']);
        $id = get_safe_value($con, $_GET['id']);
        if($operation=='active')
        {
            $status= '1';
        }
        else
        {
            $status= '0';
        }
        $update_status_sql = "UPDATE `characters` SET status='$status' WHERE id='$id'";
        mysqli_query($con, $update_status_sql);
    }
    if($_GET['type']=='delete')
    {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "DELETE FROM `characters` WHERE id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "SELECT * FROM `characters` ORDER BY id";
$res = mysqli_query($con, $sql);
?>
<main class="mt-5 pt-2">
    <div class="container-fluid">
        <div class="row my-3">
               <div class="col-md-12 fw-bold fs-3">Character</div>
               <div class="col-md-12 fw-bold fs-5 addcat mt-3"><a href="manage_character.php">Add Character <img src="icons/plus-circle-solid.svg" alt=""></a></div>
        </div>
        <div class="row">
            <div class="col-12 my-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="serial">#</th>
                            <th>Heading</th>
                            <th>By Name</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)) 
                        { ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $row['heading'] ?></td>
                            <td><?php echo $row['byname'] ?></td>
                            <td><img class="img_product_size" src="<?php echo BANNER_IMAGE_SITE_PATH.$row['image']?>"/></td> 
                            <td class="actions">
                                <?php if($row['status']==1){
                                    echo "<span class='btn_active'><a href='?type=status&operation=deactive&id=".$row['id']."' >Active</a></span>&nbsp";
                                }
                                else{
                                    echo "<span class='btn_deactive'><a href='?type=status&operation=active&id=".$row['id']."' >Deactive</a></span>&nbsp";
                                }
                                echo "<span class='btn_edit'><a href='manage_character.php?id=".$row['id']."' >Edit</a></span>&nbsp";
                                echo "<span class='btn_delete'><a href='?type=delete&id=".$row['id']."' >Delete</a></span>";
                                
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>