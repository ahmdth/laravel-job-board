<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Tag;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class ListingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listings = Listing::with('tags')->where('is_active', true)->latest()->filter(request(['s']))->get();
        $tags = Tag::orderBy('name')->get();
        if($tag = $request->get('tag')){
            $listings = $listings->filter(function($listing) use ($tag) {
                return $listing->tags->contains('slug', $tag);
            });
        }
        return view('listings.index', [
            'listings' => $listings,
            'tags' => $tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'company' => 'required',
            'logo' => 'file|image|max:2048',
            'apply_link' => 'required|url',
            'location' => 'required',
            'content' => 'required',
            'payment_method_id' => 'required'
        ];
        if (!Auth::check()) {
            $rules = array_merge($rules, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);
        }
        $request->validate($rules);
        $user = Auth::user();
        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->createAsStripeCustomer();
            event(new Registered($user));
            Auth::login($user);
        }
        try {
            $amount = 9900;
            if ($request->filled('is_highlighted')) {
                $amount += 1900;
            }
            $user->charge($amount, $request->payment_method_id);
            $md = new \ParsedownExtra();
            $listing = $user->listings()->create([
                'title' => $request->title,
                'slug' => Str::slug($request->title . '-' . rand(1111, 9999)),
                'content' => $md->text($request->content),
                'company' => $request->company,
                'logo' => basename($request->file('logo')->store('public')),
                'location' => $request->location,
                'apply_link' => $request->apply_link,
                'is_highlighted' => $request->filled('is_highlighted'),
            ]);
            foreach (explode(',', $request->tags) as $requestTag) {
                $tag = Tag::firstorCreate([
                    'slug' => Str::slug(trim($requestTag))
                ], [
                    'name' => ucwords(trim($requestTag))
                ]);
                $tag->listings()->attach($listing->id);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }

    /**
     * apply to job.
     */
    public function apply(Listing $listing, Request $request)
    {
        $listing->clicks()->create([
            'user_agent' => $request->userAgent(),
            'ip' => $request->ip()
        ]);
        return redirect()->to($listing->apply_link);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
