<?php $this->layout('tooltemplate', ['toolInformation' => $toolInformation]); ?>

<div class="container">

    <?= $this->insert('urlShortener/navigation', ['path' => $toolInformation['tool-path']]) ?>

    <h3 class="mt-4"><?= $this->e($this->translate('url-shortener-link-list-title')) ?></h3>

    <div class="card mt-4">
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">UUID</th>
                    <th scope="col">Domain</th>
                    <th scope="col">Created</th>
                    <th scope="col">Clicks</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>

                    <?php foreach($shortlinkList as $shortlink): ?>

                        <?php $this->insert('urlShortener/linkTableElement', array_merge($shortlink, ['path' => $toolInformation['tool-path']])) ?>

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
