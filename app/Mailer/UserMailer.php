<?php
/**
 * Created by PhpStorm.
 * User: Nibelung Qin
 * Date: 2018/3/14
 * Time: 16:22
 */

namespace App\Mailer;


class UserMailer extends Mailer
{
    public function welcome($user,$data)
    {
        $subject='labula App邮箱确认';
        $view='email.register';
        $this->sendTo($user,$subject,$view,$data);
    }
}