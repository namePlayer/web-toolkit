<?php $this->layout('tooltemplate', ['toolInformation' => $toolInformation]); ?>

<div class="container">

    <div class="row">

        <?php if($shortenedLink !== NULL): ?>

        <?php $this->insert('urlShortener/linkPane', ['link' => $shortenedLink]) ?>

        <?php endif; ?>

        <div class="col">
            <form method="post">
                <div class="card">
                    <div class="card-header">
                        URL Verkürzen
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-9 mb-3">
                                <label for="urlShortenerLink" class="form-label">URL in Langform</label>
                                <input type="text" class="form-control" id="urlShortenerLink" name="urlShortenerLink">
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary w-100 h-100">
                                    URL kürzen
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>