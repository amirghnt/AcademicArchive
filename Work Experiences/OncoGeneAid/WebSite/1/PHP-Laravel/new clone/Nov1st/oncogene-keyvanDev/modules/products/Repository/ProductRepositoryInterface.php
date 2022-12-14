<?php


namespace Modules\products\Repository;


use App\Repositories\BaseInterface;

interface ProductRepositoryInterface extends BaseInterface
{
    public function firstOrFail($id,$select,$relation=[]);

    public function findForPage($product_url);

    public function findWithWhere($where,$relation=[]);

    public function get($where,$whereIn,$select);

    public function first($where = [], $relation = []);

    public function update($id,$request,$product=null);
}
