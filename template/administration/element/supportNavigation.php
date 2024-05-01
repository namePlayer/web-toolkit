<ul class="nav nav-underline justify-content-center">
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard">
            &laquo; <?= $this->e($this->translate('back-button')) ?>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled"><?= $this->e($this->translate('admin-navigation-general-tab-support-interface-title')) ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $currentPage === 'myTickets' ? 'active' : '' ?>"
            <?= $currentPage === 'myTickets' ? 'aria-current="page"' : '' ?> href="/admin/support/myTickets">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill me-1" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg>
            <?= $this->e($this->translate('admin-support-management-myTickets-Tab-Title')) ?>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $currentPage === 'allTickets' ? 'active' : '' ?>"
            <?= $currentPage === 'allTickets' ? 'aria-current="page"' : '' ?> href="/admin/support">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ticket-detailed me-1" viewBox="0 0 16 16">
                <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2z"/>
                <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z"/>
            </svg>
            <?= $this->e($this->translate('admin-support-management-allTickets-Tab-Title')) ?> (<?= $openTickets ?>)
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $currentPage === 'search' ? 'active' : '' ?>"
            <?= $currentPage === 'search' ? 'aria-current="page"' : '' ?> href="/admin/support/search">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search me-1 " viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
            <?= $this->e($this->translate('admin-support-management-searchTicket-Tab-Title')) ?>
        </a>
    </li>
</ul>