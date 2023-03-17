<?php

namespace App\Service\UrlShortener;

use App\Model\UrlShortener\ShortlinkTracking;
use App\Table\UrlShortener\ShortlinkTrackingTable;

class ShortlinkTrackingService
{

    public function __construct(
        private readonly ShortlinkTrackingTable $shortlinkTrackingTable
    )
    {
    }

    public function track(ShortlinkTracking $tracking)
    {

        $this->shortlinkTrackingTable->create($tracking);

    }

}