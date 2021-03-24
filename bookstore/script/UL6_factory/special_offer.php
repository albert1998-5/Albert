<?php
/* 折價 */
class special_offer
{
    public $S_list = array();
    public $book_list = array();

    function __construct($link)
    {
        /* 獲取 今天有的特價活動  */
        $query = "SELECT * FROM `special_offer` WHERE `start_time` <= now() AND `end_time` >= now();";
        $result = mysqli_query($link, $query);
        while ($data = mysqli_fetch_array($result)) {
            $S_list[] = $data;
        }
    }


    function check()
    {
        foreach ($S_list as $S_data) {
            $sale_col = $S_data['sale_col'];
            if ($data[$sale_col] == $S_data['sale_value']) {
                $data['S_name'][] = $S_data['S_name'];
                $data['P_price'] *= $S_data['S_discount'];
            }
            $data['P_price'] = intval($data['P_price']);
        }
    }
}
