<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;
use Faker\Provider\Base;
use App\Controllers\BaseController;
use App\Helpers\ValidationHelper;
use App\Helpers\FileUploadService;
use CodeIgniter\Exceptions\RuntimeException;

class ProductController extends BaseController
{
    protected $format    = 'json';

    protected $productModel;
    protected $personModel;
    protected $uploadService;
    protected $validateRule;

    public function __construct()
    {
        $this->uploadService = new FileUploadService();
        $this->validateRule = new ValidationHelper();
        $this->productModel = new ProductModel();
        // $this->personModel = new PersonModel();
    }


    public function index()
    {

        $params = $this->getListParams();
        extract($params); 
        $query = $this->productModel->table('products')->orderBy('id', 'DESC');

        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('name', $search)
                ->orLike('price', $search)
                ->orLike('status', $search)
                ->groupEnd();
        }
        $productData = $query->orderBy($sortField, $sortDirection)->paginate($perPage);
        $data = [
            'products' => $productData,
            'pager' => $this->productModel->pager,
            'search' => $search,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection
        ];
        
        return view('products/index', $data);
    
    }

    public function show($id)
{
    $product = $this->productModel->find($id);
    if (!$product) {
        return redirect()->to('/products')->with('error', 'Order not found');
    }
    $db = \Config\Database::connect();
    $builder = $db->table('order_line');

    $relatedProducts = $builder->select('products.*, COUNT(order_line.product_id) as frequency')
        ->join('orders', 'orders.id = order_line.order_id')
        ->join('order_line as ol2', 'ol2.order_id = orders.id')
        ->join('products', 'products.id = ol2.product_id')
        ->where('order_line.product_id', $id)
        ->where('ol2.product_id !=', $id)
        ->groupBy('ol2.product_id')
        ->orderBy('frequency', 'DESC')
        ->limit(4)
        ->get()
        ->getResult();

    return view('products/show', [
        'product' => $product,
        'relatedProducts' => $relatedProducts
    ]);
}


    public function create()
    {
        return view('products/create');
    }

    public function store()
    {
        $rules = $this->validateRule->ValidationRules('', 'product');
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

     
        $image = $this->request->getFile('image');
        $imagePath = $this->uploadService->upload($image, 'images');
        $data = [
            'name' => $this->request->getPost('name'),
            'price'  => $this->request->getPost('price'),
            'description'     => $this->request->getPost('description'),
            'image'    => $imagePath,
            // 'stock'     => $this->request->getPost('stock'),
            'status'    => $this->request->getPost('status') ?? 'inactive',
        ];

        if (!$this->productModel->insert($data)) {
            if ($imagePath) {
                @unlink(FCPATH . $imagePath);
            }
            return redirect()->back()->with('errors', $this->productModel->errors())->withInput();
        }

        return redirect()->to('/products')
            ->with('success', "{$data['name']}   wurde erfolgreich erstellt");
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);
        return view('products/edit', ['product' => $product]);
    }

    public function update($id = null)
    {
        $rules = $this->validateRule->ValidationRules('', 'product');
        $product = $this->productModel->find($id);
        $oldImagePath = $product['image'] ?? null;
        $image = $this->request->getFile('image');
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }
        $imagePath = null;
        try {
            $imagePath = $this->uploadService->updateFile(
                $image,
                'images',
                $oldImagePath
            );
        } catch (RuntimeException $e) {
            return redirect()->back()
                ->with('errors', ['image' => $e->getMessage()])
                ->withInput();
        }
       
        $data = [
            'name' => $this->request->getPost('name'),
            'price'  => $this->request->getPost('price'),
            'description'     => $this->request->getPost('description'),
            // 'stock'     => $this->request->getPost('stock'),
            'status'    => $this->request->getPost('status') ?? 'inactive',
        ];
        if ($imagePath) {
            $data['image'] = $imagePath;
        }
    
        $db = \Config\Database::connect();
        $db->table('products')
            ->set($data)
            ->set('updated_at', date('Y-m-d H:i:s'))
            ->where('id', $id)
            ->update();

        return redirect()->to('/products')
            ->with('success', "{$data['name']}  wurde erfolgreich aktualisiert");
    }


    public function delete($id)
    {
        $product = $this->productModel->find($id);
        if (!empty($product['image'])) {
            $this->uploadService->deleteOldFile($product['image']);
        }
        $this->productModel->delete($id); 
        return redirect()->to('/products')->with('success', 'Product erfolgreich gelöscht');
    }
}
