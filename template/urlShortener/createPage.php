<?php $this->layout('tooltemplate', ['tool' => $tool]); ?>

<div class="container">

    <div class="row">
        <div class="col">
            <form method="post">
                <div class="row mb-3 mt-3">
                    <div class="col-4">
                        <h3 class="mb-4"><?= $this->e($this->translate('url-shortener-creation-pane-title')) ?></h3>
                    </div>
                    <div class="col-8">
                        <?= $this->insert('urlShortener/navigation', ['tool' => $tool]) ?>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-3">
                        <h6 class="text-muted"><label for="urlShortenerLinkAddress" class="form-label">Adresse</label></h6>
                        <select class="form-select" id="urlShortenerLinkAddress" name="urlShortenerLinkAddress">
                            <option value="" selected></option>
                            <?php foreach($domains as $domain): ?>
                                <option value="<?= $domain['uuid'] ?>"><?= $domain['address'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-7 mb-3">
                        <h6 class="text-muted"><label for="urlShortenerLink" class="form-label"><?= $this->e($this->translate('url-shortener-long-format-link-title')) ?></label></h6>
                        <input type="text" class="form-control" id="urlShortenerLink" name="urlShortenerLink">
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button type="submit" class="btn btn-primary w-100 h-75">
                            <?= $this->e($this->translate('url-shortener-shorten-button')) ?>
                        </button>
                    </div>
                </div>

                <div class="accordion" id="urlShortenerCustomization">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-urlShortenerCustomizationPaneBasicHeader">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-urlShortenerCustomizationPaneBasic" aria-expanded="false" aria-controls="flush-urlShortenerCustomizationPaneBasic">
                                <?= $this->e($this->translate('url-shortener-customization-pane-title')) ?>
                            </button>
                        </h2>
                        <div id="flush-urlShortenerCustomizationPaneBasic" class="accordion-collapse collapse" aria-labelledby="flush-urlShortenerCustomizationPaneBasicHeader">
                            <div class="accordion-body row">

                                <div class="mb-3 col-md-6">

                                    <label for="urlShortenerCustomShortcode" class="form-label"><?= $this->e($this->translate('url-shortener-customization-pane-custom-shortcode')) ?></label>
                                    <input type="text" id="urlShortenerCustomShortcode" name="urlShortenerCustomShortcode" class="form-control">

                                </div>

                                <div class="mb-3 col-md-6">

                                    <label for="urlShortenerExpiryDate" class="form-label"><?= $this->e($this->translate('url-shortener-customization-pane-expiry-date')) ?></label>
                                    <input type="datetime-local" id="urlShortenerExpiryDate" name="urlShortenerExpiryDate" class="form-control">

                                </div>

                                <div class="mb-3 col-md-6">

                                    <label for="urlShortenerPassword" class="form-label"><?= $this->e($this->translate('url-shortener-customization-pane-password')) ?></label>
                                    <input type="password" id="urlShortenerPassword" name="urlShortenerPassword" class="form-control">

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-urlShortenerCustomizationPaneTrackingHeader">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-urlShortenerCustomizationPaneTracking" aria-expanded="false" aria-controls="flush-urlShortenerCustomizationPaneTracking">
                                <?= $this->e($this->translate('url-shortener-tracking-pane-title')) ?>
                            </button>
                        </h2>
                        <div id="flush-urlShortenerCustomizationPaneTracking" class="accordion-collapse collapse" aria-labelledby="flush-urlShortenerCustomizationPaneTrackingHeader">
                            <div class="accordion-body">

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="urlShortenerEnableTracking" name="urlShortenerEnableTracking">
                                    <label class="form-check-label" for="urlShortenerEnableTracking">
                                        <?= $this->e($this->translate('url-shortener-tracking-pane-enable-tracking')) ?>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>