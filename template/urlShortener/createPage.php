<?php $this->layout('tooltemplate', ['toolInformation' => $toolInformation]); ?>

<div class="container">

    <div class="row">

        <?php if($shortenedLink !== NULL): ?>

        <?php $this->insert('urlShortener/linkPane', ['link' => $shortenedLink]) ?>

        <?php endif; ?>

        <div class="col">
            <form method="post">
                <div class="card mb-3">
                    <div class="card-header">
                        <?= $this->e($this->translate('url-shortener-creation-pane-title')) ?>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-9 mb-3">
                                <label for="urlShortenerLink" class="form-label"><?= $this->e($this->translate('url-shortener-long-format-link-title')) ?></label>
                                <input type="text" class="form-control" id="urlShortenerLink" name="urlShortenerLink">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100 h-100">
                                    <?= $this->e($this->translate('url-shortener-shorten-button')) ?>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <?= $this->e($this->translate('url-shortener-customization-pane-title')) ?>
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body row">

                                <div class="mb-3 col-md-6">

                                    <label for="urlShortenerCustomShortcode" class="form-label"><?= $this->e($this->translate('url-shortener-customization-pane-custom-shortcode')) ?></label>
                                    <input type="text" id="urlShortenerCustomShortcode" name="urlShortenerCustomShortcode" class="form-control">

                                </div>

                                <div class="mb-3 col-md-6">

                                    <label for="urlShortenerExpiryDate" class="form-label"><?= $this->e($this->translate('url-shortener-customization-pane-expiry-date')) ?></label>
                                    <input type="datetime-local" id="urlShortenerExpiryDate" name="urlShortenerExpiryDate" class="form-control">

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                <?= $this->e($this->translate('url-shortener-tracking-pane-title')) ?>
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>