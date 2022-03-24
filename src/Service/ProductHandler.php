<?php

namespace App\Service;

class ProductHandler
{
    private $products = [
        [
            'id' => 1,
            'name' => 'Coca-cola',
            'type' => 'Drinks',
            'price' => 10,
            'create_at' => '2021-04-20 10:00:00',
        ],
        [
            'id' => 2,
            'name' => 'Persi',
            'type' => 'Drinks',
            'price' => 5,
            'create_at' => '2021-04-21 09:00:00',
        ],
        [
            'id' => 3,
            'name' => 'Ham Sandwich',
            'type' => 'Sandwich',
            'price' => 45,
            'create_at' => '2021-04-20 19:00:00',
        ],
        [
            'id' => 4,
            'name' => 'Cup cake',
            'type' => 'Dessert',
            'price' => 35,
            'create_at' => '2021-04-18 08:45:00',
        ],
        [
            'id' => 5,
            'name' => 'New York Cheese Cake',
            'type' => 'Dessert',
            'price' => 40,
            'create_at' => '2021-04-19 14:38:00',
        ],
        [
            'id' => 6,
            'name' => 'Lemon Tea',
            'type' => 'Drinks',
            'price' => 8,
            'create_at' => '2021-04-04 19:23:00',
        ],
    ];

    /**
     * 计算商品总金额
     *
     * @author liming
     * @return float 商品总金额
     * @date   2022/2/24
     */
    public function testGetTotalPrice()
    {
        //初始化总金额
        $totalPrice = 0;
        //循环数据进行计算
        foreach ($this->products as $product) {
            //商品金额值进行强行转换
            $product['price'] = floatval($product['price']);
            //当商品金额非0时进行总金额计算
            if($product['price']){
                $totalPrice += $product['price'];
            }
        }

        //返回总金额
        return $totalPrice;
    }

    /**
     * 筛选产品，并按商品金额排序（方法一）
     *
     * @author liming
     * @param $product_type  string  要筛选的商品类型
     * @return array 按类型过滤后的的商品列表
     * @date   2022/2/24
     */
    public function filterProduct1($product_type='Dessert')
    {
        //定义过滤类型后的数组
        $new_procducts_lists = [];
        foreach ($this->products as $product) {
            if($product['type']==$product_type){
                $new_procducts_lists[]  = $product;
            }
        }

        //临时变量
        $temp = 0;
        //外层循环
        for ($i = 0; $i < count($new_procducts_lists) - 1; $i++) {
            //假设第$i个数就是最大的数，记录假设的最大价格
            $maxprice = $new_procducts_lists[$i]['price'];
            //记录假设的最大价格下标
            $maxIndex = $i;
            for ($j = $i + 1; $j < count($new_procducts_lists); $j++) {
                //如果假设的最小值，不是最小
                if ($maxprice < $new_procducts_lists[$j]['price']) {
                    $maxprice = $new_procducts_lists[$j]['price'];
                    $maxIndex = $j;
                }
            }
            //交换最大值与当前循环变量
            $temp                           = $new_procducts_lists[$i];
            $new_procducts_lists[$i]        = $new_procducts_lists[$maxIndex];
            $new_procducts_lists[$maxIndex] = $temp;
        }
        return $new_procducts_lists;
    }

    /**
     * 筛选产品，并按商品金额排序（方法二，推荐）
     *
     * @author liming
     * @param $product_type  string  要筛选的商品类型
     * @param $sort_by int  返回商品列表的按金额排序的方式 0升序 1降序
     * @return array 按类型过滤后的的商品列表
     * @date   2022/2/24
     */
    public function filterProduct2($product_type='Dessert', $sort_by=1)
    {
        //初始化返回列表
        $new_products_lists = [];

        //临时变量.存储以id为主键的价格数据，用于排序
        $pricce_lists  = [];

        //创建以商品id为主键，价格为值，临时变量。用于排序
        $temp_products  = [];

        //过滤商品
        foreach ($this->products as $product) {
            //获取
            if($product['type']==$product_type){
                //转换原数组为，以id为主键的数组
                $temp_products[$product['id']]  = $product;
                //转换原数组为，以id为主键的一维价格数组
                $pricce_lists[$product['id']]  = $product['price'];
            }
        }

        //商品排序
        if($sort_by){
            arsort($pricce_lists,1);
        }else{
            asort($pricce_lists,1);
        }

        //根据排序和过滤，组成新的数组
        foreach ($pricce_lists as $id => $price) {
            $new_products_lists[]   = $temp_products[$id];
        }

        return $new_products_lists;
    }


}