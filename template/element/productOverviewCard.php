<div class="col-md-4 mb-3">
    <div class="list-group">
        <a href="<?= $tool['path'] ?>" class="list-group-item list-group-item-action p-3    ">
            <div class="w-100">
                <div class="row mb-1">
                    <div class="col-9">
                        <h5 class="mb-1"><?= $this->e($this->translate($tool['title'])) ?></h5>
                    </div>
                    <div class="col-3">
                        <?php if($tool['level'] === 1): ?>
                            <span class="badge text-bg-secondary float-end">
                                <?= $this->e($this->translate('products-user-license-status-inclusive')) ?>
                            </span>
                                <?php else: ?>
                                    <span class="badge text-bg-success float-end">
                                <?= $this->e($this->translate('products-user-license-status-licensed')) ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <p class="mb-1"><?= $this->e($this->translate($tool['description'])) ?></p>
            <!--<small></small> -->
        </a>
    </div>
</div>

