<?php
/**
 * Author: zhouyt
 * Date: 12-9-8
 * Time: 下午10:19
 * zhouyt.kai7@gmail.com
 */

class Test_Nana_Controller extends Base_Controller{

    public function action_fluent()
    {

        $arctype = DB::table('archives')->get(array('id'));
        foreach ($arctype as $user)
        {
            echo $user->id;
        }
    }

    public function action_eloquent()
    {
        $users = User::all();

        foreach ($users as $user)
        {
            echo $user->id;
        }
    }
}