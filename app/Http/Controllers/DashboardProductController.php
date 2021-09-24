<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Admin\ProductRequest;
use App\Product;
use App\ProductGallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardProductController extends Controller
{
    public function index(){
        $products = Product::with(['galleries', 'category'])->where('users_id', Auth::user()->id)->paginate(8);
        return view('pages.dashboard-products',[
            'products' => $products
        ]);
    }
    
    public function detail(Request $request, $id){
        $product = Product::with(['galleries', 'user', 'category'])->findOrFail($id);
        $categories = Category::all();
        return view('pages.dashboard-products-details',[
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function uploadGallery(Request $request){
        $data =  $request->all();

        $data['photo'] = $request->file('photo')->store('assets/product', 'public');
        
        ProductGallery::create($data);

        return redirect()->route('product-gallery.index', $request->products_id);
    }

    public function deleteGallery(Request $request, $id){
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('product-gallery.index', $item->products_id);
    }

    public function create(){
        $categories = Category::all();
        return view('pages.dashboard-products-create',[
            'categories' => $categories
        ]);
    }

    public function store(ProductRequest $request)
    {
        $data =  $request->all();

        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);

        $gallery = [
            'products_id' => $product->id,
            'photo' => $request->file('photo')->store('asset/product', 'public'),
        ];

        // $photos = $request->file('photo');
        // foreach ($photos as $photo) {
        //   $gallery = [
        //       'products_id' => $product->id,
        //       'photo' => $photo->store('asset/product', 'public')
        //   ];
        //   ProductGallery::create($gallery);
        // }
        
        return redirect()->route('dashboard-products');
    }

    public function update(ProductRequest $request, $id)
    {
        $data =  $request->all();

        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name); 

        $item->update($data);

        return redirect()->route('dashboard-product');
    }
}
