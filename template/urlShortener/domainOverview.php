<?php $this->layout('tooltemplate', ['toolInformation' => $toolInformation]); ?>

<div class="container">


    <ul class="nav justify-content-center mb-3">
        <li class="nav-item">
            <a class="nav-link" href="<?= $toolInformation['tool-path'] ?>">Kurzlink erstellen</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= $toolInformation['tool-path'] ?>/list">Kurzlink Liste</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= $toolInformation['tool-path'] ?>/domains">Domains verwalten</a>
        </li>
    </ul>

    <h3 class="mt-4"><?= $this->e($this->translate('url-shortener-domain-list')) ?></h3>

    <div class="card mt-4">
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Domain</th>
                    <th scope="col">Created</th>
                    <th scope="col">Status</th>
                    <th scope="col">Private</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>



                </tbody>
            </table>
            <nav aria-label="Page navigation example">
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
            </nav>
        </div>
    </div>

</div>