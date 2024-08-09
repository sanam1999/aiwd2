<?php
include ('../isAuthenticate.php');
require ('function.php');
require ('../../model/orders.php');
require ('../../model/product.php');
include ('../include/header.php');
?>
<style>
    .cards {
        border: 1px solid #e3e3e3;
        border-radius: 5px;
        overflow: hidden;
        padding: 2rem 5rem;

    }

    .card-header {
        padding: 10px 15px;
        font-size: 1.25rem;
        font-weight: bold;
        text-align: center;
    }

    .card-body {
        padding: 15px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    .table th,
    .table td {
        padding: 12px 15px;
        border: 1px solid #e3e3e3;
        text-align: left;
    }

    .table th {
        background-color: #343a40;
        color: #ffffff;
        font-weight: bold;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tbody tr:hover {
        background-color: aquamarine;
    }

    .table tbody tr td:last-child {
        text-align: center;
    }

    button.btn-outline-secondary {
        background-color: transparent;
        color: #343a40;
        border: 2px solid #343a40;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    button.btn-outline-secondary:hover {
        background-color: #343a40;
        color: #ffffff;
    }

    .date {
        color: #888888;
        font-size: 0.9rem;
    }

    .des {
        width: auto;
    }
</style>


<div class="cards">
    <div class="card-header">
        Sales
    </div>
    <div class="card-body">
        <?php $orders = fetchMysales();
        if ($orders): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Total</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo $order['title']; ?></td>
                            <td><?php echo $order['total']; ?></td>
                            <td class="des"><?php echo $order['description']; ?></td>
                            <td><?php echo timeDifference($order['oder_date']); ?></td>
                            <td><?php echo $order['quntity']; ?></td>
                            <td><?php echo $order['status']; ?></td>
                            <td>
                                <?php if ($order['status'] == 'Pending'): ?>
                                    <form action="../../route.php?order_id=<?= $order['order_id'] ?>" method="post">
                                        <input type="hidden" name="action" value="confrmOders">
                                        <button class="btn btn-outline-secondary">Confirm</button>
                                    </form>
                                <?php else: ?>
                                    <p>Confirmed</p>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?php
include ('../include/footer.php');
?>