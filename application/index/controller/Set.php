<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/4/17
 * Time: 22:34
 */

namespace app\index\controller;


use think\Db;

class Set extends Base
{
    public function copyright()
    {
        if (request()->isPost()) {
            $copyright = input('post.copyright');
            Db::name('conf')->where('id', 1)->update([
                'copyright' => $copyright
            ]);
            return json(['code' => 200, 'msg' => '修改成功']);
        }
        $conf = Db::name('conf')->find(1);
        return $this->fetch('copyright', ['conf' => $conf]);
    }
}