<?php
/**
 * Created by PhpStorm.
 * User: Kásio
 * Date: 29/06/2017
 * Time: 09:35
 */

namespace CodeDelivery\Services;


use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\CupomRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var CupomRepository
     */
    private $cupomRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(OrderRepository $orderRepository, CupomRepository $cupomRepository, ProductRepository $productRepository)
    {

        $this->orderRepository = $orderRepository;
        $this->cupomRepository = $cupomRepository;
        $this->productRepository = $productRepository;
    }


    public function create(array $data)
    {

       dd($data['items']);
        /*
        \DB::beginTransaction();
        try{
            $data['status'] = 0;
            if(isset($data['cupom_code']))
            {
                $cupom = $this->cupomRepository->findByField('code', $data['cupom_code'])->first();
                $data['cupom'] = $cupom->id;
                $cupom->used = 1;
                $cupom->save;
                unset($data['cupom_code']);
            }

            $items = $data['items'];
            unset($data['items']);

            $order = $this->orderRepository->create($data);
            $total = 0;

            foreach ($items as $item)
            {
                $item['price'] = $this->productRepository->find($item['product_id'])->price;
                $order->items()->create($item);
                $total += $item['price'] * $item['qtd'];

            }
            $order->total = $total;
            $order->save();

        }catch (\Exception $e)
        {
            //\DB::roolback();
            throw $e;
        } */

    }

}