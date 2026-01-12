<?php

namespace App\Services\PluginSystem;
interface PluginInterface {
    public function register(): void;
    public function getMetadata(): array;
    public function getMenuEntry(): ?string;
}
