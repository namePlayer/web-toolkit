<?php $this->layout('basetemplate') ?>

<?php $this->insert('element/navigation') ?>

<div class="container mt-3 px-4 py-5">

    <div class="bg-dark text-secondary px-4 py-5 text-center">
        <div class="py-5">
            <h1 class="display-5 fw-bold text-white">Create Short URL</h1>
            <div class="col-lg-8 mx-auto">
                <input class="form-control form-control-lg mt-3 mb-2" type="text" placeholder="http://google.com" aria-label=".form-control-lg example">
                <p class="fs-5 mb-4">
                    A Short URL is easy to share, for example if you want to enter something on your SmartTV.
                    Create it easily with our Online Tool. For more features sign up!
                </p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <button type="button" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">Explore more Features</button>
                    <button type="button" class="btn btn-outline-light btn-lg px-4">Create Short URL</button>
                </div>
            </div>
        </div>
    </div>

</div>
