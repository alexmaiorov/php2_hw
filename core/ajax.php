<?php
require_once ('../config/config.php');

$position = (int)$_POST['position'];
$addCount = (int)$_POST['addCount'];

$sql = "SELECT * FROM products LIMIT $addCount OFFSET $position";
$res = mysqli_query($connect,$sql);
while ($data = mysqli_fetch_assoc($res)){
    $dataProduct[] = $data;
};

if(empty($dataProduct)){
    echo json_encode(array(
        'result'    => 'finish'
    ));
} else {
    $html = "";
    foreach($dataProduct as $product){
        $html .= '
            <div class="main-products-item">
                <a class="products-item-link" href="#">
                    <img src="'. $product['small_img_url'] .'" alt="'. $product['name'] .'" title="'. $product['name'] .'" height="170">
                    <span class="item-name">'. $product['name'] .'</span>
                    <span class="item-price">'. $product['price'] .' &#8381;</span>
                </a>
            </div>
        ';
    }
    echo json_encode(array(
        'result'    => 'success',
        'html'      => $html
    ));
}