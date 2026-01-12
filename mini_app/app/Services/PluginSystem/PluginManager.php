<?php

namespace App\Services\PluginSystem;

use App\Models\Plugin;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Exception;
use Illuminate\Support\Facades\View;

class PluginManager
{
    /**
     * Instaluje nowy plugin z pliku ZIP.
     *
     * @param UploadedFile $zipFile
     * @return void
     * @throws Exception
     */
    public function install(UploadedFile $zipFile): void
    {
        $zip = new ZipArchive;
        if ($zip->open($zipFile->getPathname()) !== true) {
            throw new Exception("Nie można otworzyć pliku ZIP.");
        }

        $tempExtractPath = storage_path('app/plugins/temp_' . uniqid());
        $zip->extractTo($tempExtractPath);
        $zip->close();

        $metaPath = $tempExtractPath . '/meta.json';

        if (!file_exists($metaPath)) {
            $subFolders = File::directories($tempExtractPath);
            if (count($subFolders) === 1) {
                $tempExtractPath = $subFolders[0];
                $metaPath = $tempExtractPath . '/meta.json';
            }
        }

        if (!file_exists($metaPath)) {
            File::deleteDirectory(storage_path('app/plugins/temp_' . uniqid())); // Sprzątanie
            throw new Exception("Nie znaleziono pliku meta.json w archiwum.");
        }

        $metadata = json_decode(file_get_contents($metaPath), true);

        if (!isset($metadata['name']) || !isset($metadata['entry_class'])) {
            throw new Exception("Plik meta.json jest nieprawidłowy (brak 'name' lub 'entry_class').");
        }

        if (Plugin::where('name', $metadata['name'])->exists()) {
            throw new Exception("Plugin o nazwie '{$metadata['name']}' jest już zainstalowany.");
        }

        $finalPath = storage_path('app/plugins/' . $metadata['name']);

        if (File::exists($finalPath)) {
            File::deleteDirectory($finalPath);
        }

        File::moveDirectory($tempExtractPath, $finalPath);

        Plugin::create([
            'name' => $metadata['name'],
            'display_name' => $metadata['display_name'] ?? $metadata['name'],
            'version' => $metadata['version'] ?? '1.0.0',
            'is_active' => false, // Domyślnie wyłączony po instalacji
            'path' => $finalPath,
        ]);
    }

    /**
     * Usuwa plugin (pliki i wpis w bazie).
     */
    public function uninstall(int $id): void
    {
        $plugin = Plugin::findOrFail($id);

        if (File::exists($plugin->path)) {
            File::deleteDirectory($plugin->path);
        }

        $plugin->delete();
    }

    public function enable(int $id): void
    {
        $plugin = Plugin::findOrFail($id);
        $plugin->update(['is_active' => true]);
    }

    public function disable(int $id): void
    {
        $plugin = Plugin::findOrFail($id);
        $plugin->update(['is_active' => false]);
    }

    public function getActivePlugins()
    {
        return Plugin::where('is_active', true)->get();
    }

    /**
     * Uruchamia kod aktywnych pluginów i rejestruje ich widoki.
     */
    public function bootActivePlugins(): void
    {
        $plugins = $this->getActivePlugins();

        foreach ($plugins as $plugin) {
            $metaPath = $plugin->path . '/meta.json';

            if (file_exists($metaPath)) {
                $metadata = json_decode(file_get_contents($metaPath), true);

                $entryClass = $metadata['entry_class'] ?? null;

                $mainFile = $metadata['main_file'] ?? 'src/' . class_basename($entryClass) . '.php';
                $fullPathToMainFile = $plugin->path . '/' . $mainFile;

                if (file_exists($fullPathToMainFile)) {
                    require_once $fullPathToMainFile;

                    if ($entryClass && class_exists($entryClass)) {
                        $instance = new $entryClass();
                        if (method_exists($instance, 'register')) {
                            $instance->register();
                        }
                    }
                }

                $viewsPath = $plugin->path . '/views';

                if (file_exists($viewsPath)) {
                    \Illuminate\Support\Facades\View::addNamespace($plugin->name, $viewsPath);
                }
            }
        }
    }
}
