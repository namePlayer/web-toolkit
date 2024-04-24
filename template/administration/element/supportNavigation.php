<ul class="nav nav-underline justify-content-center">
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard">&laquo; Zurück</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled">Support Verwaltung</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $currentPage === 'myTickets' ? 'active' : '' ?>"
            <?= $currentPage === 'myTickets' ? 'aria-current="page"' : '' ?> href="/admin/support/myTickets">
            Meine Tickets
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $currentPage === 'allTickets' ? 'active' : '' ?>"
            <?= $currentPage === 'allTickets' ? 'aria-current="page"' : '' ?> href="/admin/support">
            Alle Tickets (<?= $openTickets ?>)
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $currentPage === 'search' ? 'active' : '' ?>"
            <?= $currentPage === 'search' ? 'aria-current="page"' : '' ?> href="/admin/support/search">
            Ticket Suche
        </a>
    </li>
</ul>