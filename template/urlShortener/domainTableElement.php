<tr>
    <th scope="col"><?= $domain['id'] ?></th>
    <td><?= $this->e($domain['address']) ?></td>
    <td><?= (new DateTime($domain['created']))->format('d.m.Y H:i') ?></td>
    <td>
        <?= $domain['verified'] === 1
            ? $this->translate('url-shortener-domains-table-element-status-verified-title')
            : $this->translate('url-shortener-domains-table-element-status-verification-outstanding-title')
        ?>
    </td>
    <td>
        <?= $domain['public'] === 1
            ? $this->translate('url-shortener-domains-table-element-privacy-public-title')
            : $this->translate('url-shortener-domains-table-element-privacy-private-title')
        ?>
    </td>
    <th>
        <a href="#" class="text-decoration-none">
        <?= $this->translate('url-shortener-domains-table-element-manage-button-title') ?>
        </a>
    </th>
</tr>