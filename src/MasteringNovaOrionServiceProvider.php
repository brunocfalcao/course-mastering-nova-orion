<?php

namespace MasteringNovaOrion;

use Eduka\Abstracts\Classes\EdukaServiceProvider;

class MasteringNovaOrionServiceProvider extends EdukaServiceProvider
{
    public function boot()
    {
        /**
         * The only mandatory line to be passed on the
         * course service provider.
         */
        $this->dir = __DIR__;

        parent::boot();
    }
}
