<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TranslationController extends Controller
{
  
    public function index($lang = 'en')
    {
        $path = resource_path("lang/{$lang}/messages.php");
        
        $translations = [];
        if (File::exists($path)) {
            $translations = include $path;
        }

        return view('admin.translations', compact('translations', 'lang'));
    }

 
    public function update(Request $request, $lang)
    {
        $path = resource_path("lang/{$lang}/messages.php");
        $translations = $request->input('translations', []);

        $content = "<?php\n\nreturn [\n";
        foreach ($translations as $key => $value) {
         
            $value = addslashes($value);
            $content .= "    '{$key}' => '{$value}',\n";
        }
        $content .= "];\n";

      
        File::put($path, $content);

        return back()->with('success', 'Translations updated successfully!');
    }
}