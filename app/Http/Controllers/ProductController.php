<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrdersProducts;
  
class ProductController extends Controller
{
    /**-=
     * __construct
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['adminIndex','store']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    
    /**
     * showComputers
     * Display a list of Computers from the products database
     * 
     * @return void
     */
    public function showComputers()
    {
        $products = Product::all()->where('category', '=', "computer");

        return view('products', compact('products'))
            ->with('title','Computers');
    }
    
    /**
     * showLaptops
     * Display a list of Laptops from the products database
     *
     * @return void
     */
    public function showLaptops()
    {
        $products = Product::all()->where('category', '=', "laptop");

        return view('products', compact('products'))
            ->with('title','Laptops');
    }
    
    /**
     * showMobiles
     * Display a list of Mobile Phones from the products database
     *
     * @return void
     */
    public function showMobiles()
    {
        $products = Product::all()->where('category', '=', "mobile");

        return view('products', compact('products'))
            ->with('title','Mobile Phones');
    }
    
    /**
     * showTelevisions
     * Show a list of Televisions from the products database
     *
     * @return void
     */
    public function showTelevisions()
    {
        $products = Product::all()->where('category', '=', "television");

        return view('products', compact('products'))
            ->with('title','Televisions');
    }
      
    /**
     * index
     * Show a list of Products to view, edit and remove
     *
     * @return void
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * create
     * Create a new Product
     *
     * @return void
     */
    public function create()
    {
        return view('products.create');
    }
    
    /**
     * store
     * Adds a new Product to the database
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
            'category' => 'required'
        ]);
    
        Product::create($request->all());
    
        return redirect()->route('products.index')
            ->with('success','Product created successfully.');
    }
    
    /**
     * show
     * Show a Product based from ID
     *
     * @param  mixed $product
     * @return void
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * showProduct
     *
     * @param  mixed $product
     * @param  mixed $id
     * @return void
     */
    public function showProduct(Product $product, $id)
    {
        $product = Product::findOrFail($id);

        // Product Category for Breadcrumbs
        switch($product['category'])
        {
            case "computer":
                $category = "Computers";
                break;
            case "laptop":
                $category = "Laptops";
                break;
            case "mobile":
                $category = "Mobile Phones";
                break;
            case "television":
                $category = "Televisions";
                break;
        }

        return view('showproduct',compact('product'))
            ->with('category', $category);
    }
    
    /**
     * edit
     * Change the details of a Product
     *
     * @param  mixed $product
     * @return void
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }
        
    /**
     * update
     * Change the details of a Product in the database
     *
     * @param  mixed $request
     * @param  mixed $product
     * @return void
     */
    public function update(Request $request, Product $product)
    {
         request()->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
            'category' => 'required'
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('products.index')
            ->with('success','Product updated successfully');
    }

    /**
     * destroy
     * Delete a Product
     *
     * @param  mixed $product
     * @return void
     */
    public function destroy(Product $product)
    {
        $product->delete();
    
        return redirect()->route('products.index')
            ->with('success','Product deleted successfully');
    }
    
    /**
     * cart
     * Show the Shopping Cart
     *
     * @return void
     */
    public function cart()
    {
        return view('cart');
    }
  
    /**
     * addToCart
     * Add a Product to the Cart
     *
     * @param  mixed $id
     * @return void
     */
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            // Increase the quantity by 1 if already in cart
            $cart[$id]['quantity']++;
        } else {
            // Else add to Cart 
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
          
        session()->put('cart', $cart);

        return redirect()->back()
            ->with('success', 'Product added to cart successfully!');
    }
  
    /**
     * updateCart
     * Change or delete the current item inside the Shopping Cart
     *
     * @param  mixed $request
     * @return void
     */
    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    
    /**
     * remove
     * Delete a Product from the database
     *
     * @param  mixed $request
     * @return void
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }

    /**
     * purchase
     * Purchase the Products inside the Shopping Cart
     *
     * @param  mixed $request
     * @return void
     */
    public function purchase(Request $request)
    {
        $cart = session('cart');
        $user = auth()->user();

        // Create new Order
        $order = new Order;
        $order->user_id = $user['id'];
        $order->status = "Processing";
        $order->save();

        // Add each Product to Order Items
        foreach($cart as $items)
        {
            $orderProduct = new OrdersProducts;
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $items['id'];
            $orderProduct->quantity = $items['quantity'];
            $orderProduct->price = $items['price'];
            $orderProduct->save();
        }

        // Empty the Cart by forgetting the Cart Cookie
        session()->forget('cart');

        return redirect()->route('ordercomplete');
    }
}