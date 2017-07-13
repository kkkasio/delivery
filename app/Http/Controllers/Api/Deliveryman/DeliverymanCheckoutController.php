<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Authorizer;

class ClientCheckoutController extends Controller
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
    private $orderService;

    public function __construct(OrderRepository $repository, UserRepository  $userRepository,ProductRepository $productRepository, OrderService $orderService)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        ////$id = Authorizer->getResourceOwnerId();
        $id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($id)->client->id;
        $orders = $this->repository->with('items')->scopeQuery(function ($query) use ($clientId)
        {
            return $query->where('client_id','=',$clientId);
        })->paginate();
        return $orders;
    }
    public function store(Request $request)
    {
        $data = $request->all();
        //$id = Authorizer->getResourceOwnerId();
        $id = Authorizer::getRessourceOwnerId();
        $clientId = $this->userRepository->find($id)->client->id;
        $data['client_id'] = $clientId;
        $orderObj = $this->orderService->create($data);
        $orderObj = $this->repository->with('items')->find($orderObj->id);
        return $orderObj;
    }

    public function show($id)
    {
        $order = $this->repository->with(['clients', 'items'])->find($id);
        $order->items->each(function ($item){
            $item->product;
        });
        return $order;
    }
}
