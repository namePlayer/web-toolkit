<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="/">
            <b><?= $_ENV['SOFTWARE_TITLE'] ?></b>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php if($this->getAccountInformation() === FALSE): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/"><?= $this->e($this->translate('navigation-startpage')) ?></a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/overview"><?= $this->e($this->translate('navigation-dashboard')) ?></a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?= $this->e($this->translate('navigation-products')) ?></a>
                </li>
            </ul>

            <ul class="navbar-nav ms-start">
                <?php if($this->getAccountInformation() === FALSE): ?>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="/authentication/login"><?= $this->e($this->translate('navigation-login')) ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-light" href="/authentication/registration"><?= $this->e($this->translate('navigation-register')) ?></a>
                    </li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $this->e($this->translate('navigation-logged-in-as')) ?> <b><?= $this->getAccountInformation()['name'] ?></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><?= $this->e($this->translate('navigation-account-settings')) ?></a></li>
                            <li><a class="dropdown-item" href="#"><?= $this->e($this->translate('navigation-account-licenses')) ?></a></li>
                            <li><a class="dropdown-item" href="#"><?= $this->e($this->translate('navigation-account-support')) ?></a></li>
                            <hr>
                            <li><a class="dropdown-item" href="/authentication/logout"><?= $this->e($this->translate('navigation-account-logout')) ?></a></li>
                        </ul>
                    </li>
                    <a class="nav-link">
                        <span class="badge rounded-pill text-bg-<?= $this->getLevelBadge()['color'] ?>"><?= $this->translate($this->getLevelBadge()['label']) ?></span>
                    </a>
                    <?php if($this->getAccountInformation()['isAdmin'] === 1): ?>
                        <a class="nav-link text-danger" href="/admin/dashboard">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-gear" viewBox="0 0 16 16">
                                <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708L7.293 1.5Z"/>
                                <path d="M11.886 9.46c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.044c-.613-.181-.613-1.049 0-1.23l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>