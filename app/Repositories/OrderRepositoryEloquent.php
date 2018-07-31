<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Presenters\OrderPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Models\Order;


/**
 * Class OrderRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getByIdAndDeliveryman($id,$idDeliveryman){
        $result = $this->with(['client','items','cupom'])->findWhere([
                'id' => $id,
                'user_deliveryman_id' => $idDeliveryman
            ]);

//        if ($result instanceof Collection){
//            $result = $result->first();
//            $result->items->each(function ($item){
//                $item->product;
//            });
//        }

        $result = $result->first();
        if($result){
            $result->items->each(function ($item){
                $item->product;
            });
        }
        return $result;

    }
    public function model(){
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot(){
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter(){
        return OrderPresenter::class;
    }


}
