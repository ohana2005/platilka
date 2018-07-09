<div class="container">

    <div class="row">
        <div class="alert alert-warning">
            <strong>Внимание!</strong> Это тестовый режим! Никакой оплаты взиматься не будет!
        </div>
        <table class="table">

            <tr>
                <th><?php echo __('Транзакция'); ?></th>
                <td>#<?php echo $Transaction->id; ?></td>
            </tr>

            <tr>
                <th><?php echo __('Мерчант'); ?></th>
                <td><?php echo $Transaction->Client; ?></td>
            </tr>

            <tr>
                <th><?php echo __('Сумма'); ?></th>
                <td><?php echo $Transaction->sum; ?></td>
            </tr>

            <tr>
                <th><?php echo __('Валюта'); ?></th>
                <td><?php echo $Transaction->currency; ?></td>
            </tr>

            <tr>
                <th><?php echo __('Продукт'); ?></th>
                <td><?php echo $Transaction->product; ?></td>
            </tr>

        </table>
        <a href="<?php echo url_for('@transaction_cancel?id=' . $Transaction->id . '&hash=' . $Transaction->hash); ?>" class="btn"><?php echo __('Отмена'); ?></a>
        <a href="<?php echo url_for('@transaction_pay?id=' . $Transaction->id . '&hash=' . $Transaction->hash); ?>" class="btn btn-success"><?php echo __('Оплатить'); ?></a>
    </div>
</div>