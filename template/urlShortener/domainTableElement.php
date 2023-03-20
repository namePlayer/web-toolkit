<tr>
    <th scope="col"><?= $domain['id'] ?></th>
    <td><?= $domain['address'] ?></td>
    <td><?= (new DateTime($domain['created']))->format('d.m.Y H:i') ?></td>
    <td>
        <?= $domain['verified'] === 1
            ? 'Verifiziert'
            : 'Verifizierung ausstehend'
        ?>
    </td>
    <td>
        <?= $domain['public'] === 1
            ? 'Öffentlich'
            : 'Privat'
        ?>
    </td>
    <th>
        <a href="#" class="text-decoration-none">Manage</a>
    </th>
</tr>