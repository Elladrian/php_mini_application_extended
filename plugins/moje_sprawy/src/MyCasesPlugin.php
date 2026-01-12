<?php

namespace Plugins\MyCases;

class MyCasesPlugin
{
    public function register()
    {
        \Illuminate\Support\Facades\Log::info("Plugin Moje Sprawy został załadowany!");
    }
}