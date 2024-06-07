<?php

require('topinc.php');

if(isset($_GET['type']) && $_GET['type']!='')
{
    $type = get_safe_value($con, $_GET['type']);
    if($_GET['type']=='delete')
    {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "DELETE FROM `coupon` WHERE id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "SELECT * FROM `coupon` ORDER BY id";
$res = mysqli_query($con, $sql);
?>
<main class="mt-5 pt-2">
    <div class="container-fluid">
        <div class="row my-3">
               <div class="col-md-12 fw-bold fs-3">Coupon Master</div>
               <div class="col-md-12 fw-bold fs-5 addcat mt-3"><a href="manage_coupon.php">Add Coupon code <img src="icons/plus-circle-solid.svg" alt=""></a></div>
        </div>
        <div class="row">
            <div class="col-12 my-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="serial">#</th>
                            <th>Coupon Name</th>
                            <th>Value</th>
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
                            <td><?php echo $row['cname'] ?></td>
                            <td><?php echo $row['value'] ?></td>
                            <td class="actions">
                                <?php
                                echo "<span class='btn_edit'><a href='manage_coupon.php?id=".$row['id']."' >Edit</a></span>&nbsp";
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