<?php

namespace App\Http\Controllers;

use App\Models\Plugin;
use App\Services\PluginSystem\PluginManager;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PluginController extends Controller
{
    protected PluginManager $pluginManager;

    // Wstrzykujemy PluginManager przez konstruktor
    public function __construct(PluginManager $pluginManager)
    {
        $this->pluginManager = $pluginManager;
    }

    /**
     * Wyświetla listę pluginów.
     */
    public function index(): View
    {
        // Pobieramy wszystkie pluginy z bazy danych
        $plugins = Plugin::all();

        return view('plugins.index', compact('plugins'));
    }

    public function show(string $name)
    {
        $plugin = \App\Models\Plugin::where('name', $name)
            ->where('is_active', true)
            ->firstOrFail();

        $viewName = $name . '::index';

        if (view()->exists($viewName)) {
            return view($viewName);
        }

        abort(404, "Plugin nie posiada widoku startowego.");
    }

    /**
     * Usuwa plugin.
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->pluginManager->uninstall($id);
            return redirect()->route('plugins.index')->with('success', 'Plugin został odinstalowany.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Błąd podczas usuwania: ' . $e->getMessage());
        }
    }

    /**
     * Obsługuje przesyłanie i instalację pluginu.
     */
    public function store(Request $request): RedirectResponse
    {
        // Walidacja: plik jest wymagany i musi być typu ZIP
        $request->validate([
            'plugin_file' => 'required|file|mimes:zip|max:10240', // max 10MB
        ]);

        try {
            // Używamy Managera do instalacji
            $this->pluginManager->install($request->file('plugin_file'));

            return redirect()->route('plugins.index')
                ->with('success', 'Plugin został zainstalowany pomyślnie.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['plugin_file' => 'Błąd instalacji: ' . $e->getMessage()]);
        }
    }

    /**
     * Zmienia status aktywności pluginu (Włącz/Wyłącz).
     */
    public function toggle(int $id): RedirectResponse
    {
        try {
            $plugin = Plugin::findOrFail($id);

            if ($plugin->is_active) {
                $this->pluginManager->disable($id);
                $message = 'Plugin został wyłączony.';
            } else {
                $this->pluginManager->enable($id);
                $message = 'Plugin został włączony.';
            }

            return redirect()->route('plugins.index')->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Wystąpił błąd: ' . $e->getMessage());
        }
    }
}
