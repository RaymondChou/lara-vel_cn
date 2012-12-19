<?php
/**
 * Author: zhouyt
 * Date: 12-9-8
 * Time: 下午10:19
 * zhouyt.kai7@gmail.com
 */

class Test_Nana_Controller extends Base_Controller{

    public function json()
    {

        return \Laravel\Response::json(array('name' => 'jiangyou','detail' => '酱油'),200);
    }

}