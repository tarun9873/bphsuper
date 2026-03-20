<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Site;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth')->except(['front', 'b2b', 'b2c']);
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

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required',
        ]);

        // ✅ ONLY SAVE IN DATABASE
        Contact::create([
            'name' => $request->name,
            'number' => $request->number,
            'website' => $request->website,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Form Submitted Successfully!');
    }


    public function contacts()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts', compact('contacts'));
    }



    /* ======================
    BLOG METHODS (FINAL)
======================*/

    // ✅ ADMIN: Blog List
    public function blogs()
    {
        $blogs = Blog::latest()->get();
        return view('admin.add-blog', compact('blogs'));
    }

    // ✅ ADMIN: Create Page
    public function createBlog()
    {
        $blogs = Blog::latest()->get();
        return view('admin.add-blog', compact('blogs'));
    }

    // ✅ ADMIN: Edit Blog
    public function editBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $blogs = Blog::latest()->get();
        return view('admin.add-blog', compact('blog', 'blogs'));
    }

    // ✅ STORE BLOG
    public function blogStore(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'meta_title' => 'nullable|max:160',
            'meta_description' => 'nullable|max:160',
            'meta_keywords' => 'nullable|max:255',
            'focus_keyphrase' => 'nullable|max:255'  // Add this if you have this field
        ]);

        // 🔥 SLUG GENERATE + DUPLICATE FIX
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;

        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // 🔥 IMAGE UPLOAD
        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/blogs'), $imageName);
        }

        Blog::create([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $imageName,
            'description' => $request->description,

            // SEO
            'meta_title' => $request->meta_title ?? $request->title,

            'meta_description' => $request->meta_description
                ?? Str::limit(strip_tags($request->description), 150),

            'meta_keywords' => $request->meta_keywords
                ?? $request->title,

            // ✅ ADD THIS
            'focus_keyphrase' => $request->focus_keyphrase,
        ]);

        return redirect()->route('admin.blogs')->with('success', 'Blog created successfully!');
    }

    // ✅ UPDATE BLOG
    public function updateBlog(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'focus_keyphrase' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120'
        ]);

        // 🔥 SLUG UPDATE
        $slug = Str::slug($request->title);

        if ($slug !== $blog->slug) {
            $originalSlug = $slug;
            $count = 1;

            while (Blog::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            $blog->slug = $slug;
        }

        // 🔥 IMAGE UPDATE
        if ($request->hasFile('image')) {

            // delete old
            if ($blog->image && file_exists(public_path('storage/blogs/' . $blog->image))) {
                unlink(public_path('storage/blogs/' . $blog->image));
            }

            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/blogs'), $imageName);

            $blog->image = $imageName;
        }

        $blog->title = $request->title;
        $blog->description = $request->description;

        // SEO
        $blog->meta_title = $request->meta_title ?? $request->title;

        $blog->meta_description = $request->meta_description
            ?? Str::limit(strip_tags($request->description), 150);
        $blog->focus_keyphrase = $request->focus_keyphrase;
        $blog->meta_keywords = $request->meta_keywords
            ?? $request->title;





        $blog->save();

        return redirect()->route('admin.blogs')->with('success', 'Blog updated successfully!');
    }

    // ✅ DELETE BLOG
    public function blogDelete($id)
    {
        $blog = Blog::findOrFail($id);

        // delete image
        if ($blog->image && file_exists(public_path('storage/blogs/' . $blog->image))) {
            unlink(public_path('storage/blogs/' . $blog->image));
        }

        $blog->delete();

        return back()->with('success', 'Blog deleted successfully!');
    }

    /* ======================
    FRONTEND BLOG
======================*/

    // ✅ BLOG LIST (with pagination)
    public function blogList()
    {
        $blogs = Blog::latest()->paginate(9);
        return view('blog.blog', compact('blogs'));
    }

    // ✅ BLOG DETAIL
    public function blogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        $relatedBlogs = Blog::where('id', '!=', $blog->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('blog.blog-detail', compact('blog', 'relatedBlogs'));
    }
}
