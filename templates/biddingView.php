<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licitações</title>
</head>
<body>
    <table>
        <th>
            <td>Título</td>
            <td>URL</td>
            <td>Status</td>
            <td>Descrição</td>
            <td>Data</td>
        </th>
        <? foreach($biddings as $bidding) { ?>
            <tr>
                <td><?= $bidding->title ?></td>
                <td><?= $bidding->url ?></td>
                <td><?= $bidding->status ?></td>
                <td><?= $bidding->description ?></td>
                <td><?= $bidding->date ?></td>
            </tr>
        <? } ?>
    </table>
</body>
</html>