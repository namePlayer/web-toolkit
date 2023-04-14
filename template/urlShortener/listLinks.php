<?php $this->layout('tooltemplate', ['tool' => $tool]); ?>

<div class="container">

    <div class="row mb-4 mt-4">
        <div class="col-4 d-flex align-items-center">
            <h3><?= $this->e($this->translate('url-shortener-link-list-title')) ?></h3>
        </div>
        <div class="col-8 d-flex align-items-center">
            <?= $this->insert('urlShortener/navigation', ['tool' => $tool]) ?>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">
                        <?= $this->e($this->translate('url-shortener-link-list-table-uuid-title')) ?>
                    </th>
                    <th scope="col">
                        <?= $this->e($this->translate('url-shortener-link-list-table-domain-title')) ?>
                    </th>
                    <th scope="col">
                        <?= $this->e($this->translate('url-shortener-link-list-table-created-title')) ?>
                    </th>
                    <th scope="col">
                        <?= $this->e($this->translate('url-shortener-link-list-table-clicks-title')) ?>
                    </th>
                    <th scope="col">
                        <?= $this->e($this->translate('url-shortener-link-list-table-actions-title')) ?>
                    </th>
                </tr>
                </thead>
                <tbody>

                    <?php foreach($shortlinkList as $shortlink): ?>

                        <?php $this->insert('urlShortener/linkTableElement', array_merge($shortlink, ['tool' => $tool])) ?>

                    <?php endforeach;?>

                </tbody>
            </table>
            <!--<nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>-->
        </div>
    </div>

</div>
