<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
            </tr>
        </thead>
        <tbody>
            <?php
                for ($i = 1; $i <= 250; $i++) {
                    echo '
                        <tr>
                            <td>'.$i.'</td>
                        </tr>
                    ';
                }
            ?>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>