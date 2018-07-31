<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests\AdminClientRequest;
use CodeDelivery\Http\Requests\CheckoutRequest;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class ClientCheckoutController extends Controller
{
    private $with = ['client','cupom','items'];
    /**
     * @var OrderRepository
     */
    private $repository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var OrderService
     */
    private $orderService;

    public function __construct(OrderRepository $repository, UserRepository  $userRepository, OrderService $orderService){
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->orderService = $orderService;
    }

    public function index(){
        $id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($id)->client->id;

        $orders = $this->repository
                ->with('items')
                ->scopeQuery(function ($query) use ($clientId){
                    return $query->where('client_id', '=', $clientId);
                })->paginate();
        return $orders;
    }
    public function store(CheckoutRequest $request){
        $data = $request->all();
        $id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($id)->client->id;
        $data['client_id'] = $clientId;
        $orderObj = $this->orderService->create($data);
        return $this->repository
                ->with($this->with)
                ->find($orderObj->id);

    }

    public function show($id){
        $a = $this->repository->skipPresenter(true)->with($this->with)->find($id);
        $id = Authorizer::getResourceOwnerId();
       // dd($a['client_id']);

        if($a['client_id'] == $id)
        {
            return $this->repository
                ->skipPresenter(false)
                ->with($this->with)
                ->find($id);
        }
        return abort(404,'Erro pedido não existe');
    }
}
