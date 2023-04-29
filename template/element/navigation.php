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
                    <a class="nav-link" href="/products"><?= $this->e($this->translate('navigation-products')) ?></a>
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
                            <li><a class="dropdown-item" href="/account"><?= $this->e($this->translate('navigation-account-settings')) ?></a></li>
                            <li><a class="dropdown-item" href="/support"><?= $this->e($this->translate('navigation-account-support')) ?></a></li>
                            <?php if($this->getAccountInformation()['isSupport'] === 1 || $this->getAccountInformation()['isAdmin'] === 1): ?>
                                <hr>
                                <li><a class="dropdown-item" href="/admin/support"><?= $this->e($this->translate('navigation-support-dashboard')) ?></a></li>
                                <?php if($this->getAccountInformation()['isAdmin'] === 1): ?>
                                    <li><a class="dropdown-item link-danger" href="/admin/dashboard"><?= $this->e($this->translate('navigation-admin-dashboard')) ?></a></li>
                                <?php endif; ?>
                            <?php endif; ?>
                            <hr>
                            <li><a class="dropdown-item" href="/authentication/logout"><?= $this->e($this->translate('navigation-account-logout')) ?></a></li>
                        </ul>
                    </li>
                    <a class="nav-link">
                        <span class="badge rounded-pill text-bg-<?= $this->getLevelBadge()['color'] ?>"><?= $this->translate($this->getLevelBadge()['label']) ?></span>
                    </a>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>