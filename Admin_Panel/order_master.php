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

$sql = "SELECT * FROM `order_detail` ORDER BY `order_id` DESC";
$res = mysqli_query($con, $sql);
?>
<main class="mt-5 pt-2">
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col-md-12 fw-bold fs-3">Order Master</div>
        </div>
        <div class="row">
            <div class="col-12 my-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="serial">Action</th>
                            <th>Order Id</th>
                            <th>Order Date</th>
                            <th>Address</th>
                            <th>Payment Type</th>
                            <th>Payment Status</th>
                            <th>Transaction Id</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $res = mysqli_query($con,"SELECT `orders`.*, `order_status`.name as order_status_str FROM `orders`,`order_status` WHERE `order_status`.id=`orders`.order_status ");
                        while($row = mysqli_fetch_assoc($res))
                        {
                        ?>
                        <tr>
                            <td><a href="order_master_details.php?id=<?php echo $row['id']?>"><button type="button"
                                        class="btn btn-info" style="padding:5px;">See Details</button></a></td>
                            <td>
                                <?php echo $row['id']?>
                            </td>
                            <td>
                                <?php echo $row['added_on']?>
                            </td>
                            <td>
                                <?php echo $row['address']?></br>
                                <?php echo $row['city']?></br>
                                <?php echo $row['pincode']?>
                            </td>
                            <td>
                                <?php echo $row['payment_type']?>
                            </td>
                            <td>
                                <?php echo $row['payment_status']?>
                            </td>
                            <td>
                                <?php echo $row['txnid']?>
                            </td>
                            <td>
                                <?php echo $row['order_status_str']?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>