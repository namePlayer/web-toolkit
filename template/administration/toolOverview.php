<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3">
    <div class="row">

        <div class="col-12 mb-4">
            <?php $this->insert('administration/element/adminInfoHeader'); ?>
        </div>

        <?= $this->insert('element/adminNavigation') ?>

        <div class="col-md-9">
            <h4 class="mb-3">Tools</h4>

            <div class="row">

                <div class="col-12">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Beta-Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tools as $tool): ?>
                                <tr>
                                    <th scope="row"><?= $tool['id'] ?></th>
                                    <td><?= $this->translate($tool['title']) ?></td>
                                    <td><?= $this->translate($tool['description']) ?></td>
                                    <td><?= $tool['beta'] === 1
                                            ? $this->translate('active-string')
                                            : $this->translate('inactive-string') ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>

</div>
