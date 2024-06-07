<div class="container mt-5 p-4 border rounded bg-white shadow-sm">
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Transaction</th>
                <th scope="col">User</th>
                <th scope="col">Total</th>
                <th scope="col">Date</th>
                <th scope="col">Item</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['transactions'] as $transaction) : ?>
                <tr>
                    <th scope="row"><?= $transaction['document_code']; ?>-<?= $transaction['document_number']; ?></th>
                    <td><?= $transaction['user']; ?></td>
                    <td><?= $transaction['total']; ?></td>
                    <td><?= $transaction['date']; ?></td>
                    <td>
                        <?php foreach ($transaction['detail'] as $detail) : ?>
                            <?= $detail['product_name']; ?> X <?= $detail['quantity']; ?> <br>
                        <?php endforeach; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>