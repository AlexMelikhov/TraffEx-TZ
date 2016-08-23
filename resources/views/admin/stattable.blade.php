
<pre>
    <?
        print_r($stats);
    ?>
</pre>

<h3>
    Браузеры
</h3>

<table class="table table-bordered">
    <thead>

    <tr>
        <th>#</th>
        <th>Хиты</th>
        <th>Уники по IP</th>
        <th>Уники по Cookie</th>
    </tr>

    </thead>
    <tbody>
    <?php
        if (!empty($stats['browser'])){

            foreach ($stats['browser'] as $browser => $st) {
                ?>
                    <tr>
                        <td><?=$browser?></td>
                        <td><?=(isset($st['hit']))?$st['hit']:0?></td>
                        <td><?=(isset($st['host']))?$st['host']:0?></td>
                        <td><?=(isset($st['cookie']))?$st['cookie']:0?></td>
                    </tr>
                <?php
            }

        } else {
            ?>'<tr><td colspan="4">Данных нет</td></tr>'<?php
        }
    ?>
    </tbody>
</table>


<h3>
    ОС
</h3>

<table class="table table-bordered">
    <thead>

    <tr>
        <th>#</th>
        <th>Хиты</th>
        <th>Уники по IP</th>
        <th>Уники по Cookie</th>
    </tr>

    </thead>
    <tbody>
    <?php
        if (!empty($stats['os'])){

            foreach ($stats['os'] as $os => $st) {
                ?>
                    <tr>
                        <td><?=$os?></td>
                        <td><?=(isset($st['hit']))?$st['hit']:0?></td>
                        <td><?=(isset($st['host']))?$st['host']:0?></td>
                        <td><?=(isset($st['cookie']))?$st['cookie']:0?></td>
                    </tr>
                <?php
            }

        } else {
            ?>'<tr><td colspan="4">Данных нет</td></tr>'<?php
        }
    ?>
    </tbody>
</table>


<!--h3>
    Гео
</h3>

<table class="table table-bordered">
    <thead>

    <tr>
        <th>#</th>
        <th>Хиты</th>
        <th>Уники по IP</th>
        <th>Уники по Cookie</th>
    </tr>

    </thead>
    <tbody>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table-->

<h3>
    Рефы
</h3>

<table class="table table-bordered">
    <thead>

    <tr>
        <th>#</th>
        <th>Хиты</th>
        <th>Уники по IP</th>
        <th>Уники по Cookie</th>
    </tr>

    </thead>
    <tbody>
    <?php
        if (!empty($stats['ref'])){

            foreach ($stats['ref'] as $ref => $st) {
                ?>
                    <tr>
                        <td><?=$ref?></td>
                        <td><?=(isset($st['hit']))?$st['hit']:0?></td>
                        <td><?=(isset($st['host']))?$st['host']:0?></td>
                        <td><?=(isset($st['cookie']))?$st['cookie']:0?></td>
                    </tr>
                <?php
            }

        } else {
            ?>'<tr><td colspan="4">Данных нет</td></tr>'<?php
        }
    ?>
    </tbody>
</table>