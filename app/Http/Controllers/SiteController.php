<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function __construct()
{
    $this->middleware('admin.auth')->except(['front','b2b','b2c']);
}

    /* ======================
        FRONT PAGE with categories
    ======================*/
    public function front()
    {
        $sites = Site::orderBy('position')->get();
        $categories = Site::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        // Calculate counts for each category
        $siteTypesWithCount = [];

        // Add "All Site" option
        $siteTypesWithCount[] = [
            'name' => 'All Site',
            'count' => $sites->count(),
            'icon' => 'fas fa-globe'
        ];

        // Add other categories with counts
        foreach ($categories as $category) {
            $count = Site::where('category', $category)->count();
            $siteTypesWithCount[] = [
                'name' => $category,
                'count' => $count,
                'icon' => $this->getCategoryIcon($category)
            ];
        }

        return view('front', compact('sites', 'categories', 'siteTypesWithCount'));
    }

    // Helper function to get category icon
    private function getCategoryIcon($categoryName)
    {
        $iconMap = [
            'All Site' => 'fas fa-globe',
            '9wicket Type' => 'fas fa-star',
            'AB Exch Type' => 'fas fa-exchange-alt',
            'Asia Type' => 'fas fa-flag',
            'D247 Type' => 'fas fa-bolt',
            'Diamond Type' => 'fas fa-gem',
            'Dream 555 Type' => 'fas fa-cloud',
            'Exch247 Type' => 'fas fa-chart-line'
        ];

        // Default icon
        $defaultIcon = 'fas fa-globe';

        // Check if category exists in map, otherwise return default
        foreach ($iconMap as $key => $icon) {
            if (str_contains($categoryName, str_replace(' Type', '', $key)) || $categoryName === $key) {
                return $icon;
            }
        }

        return $defaultIcon;
    }

    /* ======================
        ADMIN DASHBOARD
    ======================*/
    public function admin()
    {
        $sites = Site::orderBy('position')->get();
        $categories = Site::select('category')->distinct()->orderBy('category')->pluck('category');
        return view('admin.admin', compact('sites', 'categories'));
    }

    /* ======================
        EDIT SITE
    ======================*/
    public function edit($id)
    {
        $site = Site::findOrFail($id);
        $categories = Site::select('category')->distinct()->orderBy('category')->pluck('category');
        return view('edit', compact('site', 'categories'));
    }

    /* ======================
        STORE NEW SITE
    ======================*/
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'url' => 'required|url',
            'market_percentage' => 'required|numeric|min:0|max:100',
            'category' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle new category input
        if ($request->filled('new_category')) {
            $category = $request->new_category;
        } else {
            $category = $request->category;
        }

        if (!$request->hasFile('logo')) {
            return back()->with('error', 'Upload Logo');
        }

        $file = $request->file('logo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('storage/logos'), $filename);

        Site::create([
            'name' => $request->name,
            'logo' => $filename,
            'url' => $request->url,
            'market_percentage' => $request->market_percentage ?? 0,
            'min_percentage' => $request->min_percentage ?? 0,
            'category' => $category,
            'position' => Site::max('position') + 1
        ]);



        return back()->with('success', 'Site added successfully!');
    }

    /* ======================
        UPDATE SITE
    ======================*/
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'url' => 'required|url',
            'min_percentage' => 'nullable|numeric|min:0|max:100',
            'market_percentage' => 'nullable|numeric|min:0|max:100',
            'category' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);


        $site = Site::findOrFail($id);

        // Handle new category input
        if ($request->filled('new_category')) {
            $category = $request->new_category;
        } else {
            $category = $request->category;
        }

        // Handle logo update
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/logos'), $filename);
            $site->logo = $filename;
        }

        // Update all fields
        $site->fill([
            'name' => $request->name,
            'url' => $request->url,
            'market_percentage' => $request->market_percentage ?? 0,
            'min_percentage' => $request->min_percentage ?? 0,
            'category' => $category
        ])->save();



        return redirect('/admin')->with('success', 'Site updated successfully!');
    }

    /* ======================
        DELETE SITE
    ======================*/
    public function delete($id)
    {
        Site::findOrFail($id)->delete();
        return back()->with('success', 'Site deleted successfully!');
    }

    /* ======================
        CATEGORY MANAGEMENT
    ======================*/
    public function categories()
    {
        $categories = Site::select('category')->distinct()->orderBy('category')->pluck('category');
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        // Already exists check
        $exists = Site::where('category', $request->name)->exists();

        if ($exists) {
            return back()->with('error', 'Category already exists!');
        }

        // Insert dummy site so category appears
        Site::create([
            'name' => 'temp-site',
            'logo' => 'default.png',
            'url' => 'https://example.com',
            'market_percentage' => 0,
            'category' => $request->name
        ]);

        return back()->with('success', 'Category added successfully!');
    }


    public function updateCategory(Request $request)
    {
        $request->validate([
            'old_category' => 'required|exists:sites,category',
            'new_category' => 'required|max:255|different:old_category'
        ]);

        // Update all sites with old category to new category
        Site::where('category', $request->old_category)
            ->update(['category' => $request->new_category]);

        return back()->with('success', 'Category updated successfully!');
    }

    public function deleteCategory(Request $request)
    {
        $request->validate([
            'category' => 'required|exists:sites,category'
        ]);

        // Check if category has any sites
        $siteCount = Site::where('category', $request->category)->count();

        if ($siteCount > 0) {
            return back()->with('error', 'Cannot delete category with existing sites!');
        }

        return back()->with('success', 'Category removed!');
    }


    public function reorder(Request $request)
    {
        foreach ($request->order as $item) {
            Site::where('id', $item['id'])
                ->update(['position' => $item['position']]);
        }

        return response()->json(['success' => true]);
    }



    public function bulkType(Request $request)
    {
        Site::whereIn('id', $request->ids)
            ->update(['type' => $request->type]);

        return response()->json(['success' => true]);
    }




    public function b2b()
    {
        $sites = Site::where('type', 'b2b')->get();
        return view('front-b2b', compact('sites'));
    }

    public function b2c()
    {
        $sites = Site::where('type', 'b2c')->get();
        return view('front-b2c', compact('sites'));
    }
}