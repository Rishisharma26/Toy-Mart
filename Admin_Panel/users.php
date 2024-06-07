<?php

require('topinc.php');

if(isset($_GET['type']) && $_GET['type']!='')
{
    if($_GET['type']=='delete')
    {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "DELETE FROM users WHERE id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "SELECT * FROM users ORDER BY id desc";
$res = mysqli_query($con, $sql);
?>
<main class="mt-5 pt-2">
    <div class="container-fluid">
        <div class="row my-3">
               <div class="col-md-12 fw-bold fs-3">Users</div>
        </div>
        <div class="row">
            <div class="col-12 my-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="serial">#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)) 
                        { ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['mobile'] ?></td>
                            <td><?php echo $row['added_on'] ?></td>
                            <td class="actions">
                                <?php
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