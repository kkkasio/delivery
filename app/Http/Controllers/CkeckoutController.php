<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use CodeDelivery\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Auth;

class CkeckoutController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $repository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var OrderService
     */
    private $service;

    public function __construct(OrderRepository $repository, UserRepository  $userRepository,ProductRepository $productRepository, OrderService $service)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->service = $service;
    }

    public function index()
    {
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        $orders = $this->repository->scopeQuery(function ($query) use ($clientId)
        {
            return $query->where('client_id', '=',$clientId);
        })->paginate();

        return view ('customer.order.index', compact('orders'));
    }

    public function create()
    {
        $products = $this->productRepository->listar();

        return view('customer.order.create',compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $client_id = $this->userRepository->find(Auth::user()->id)->client->id;

        $data['client_id'] = $client_id;
        $this->service->create($data);

        return redirect()->route('customer.order.index');

    }
}
