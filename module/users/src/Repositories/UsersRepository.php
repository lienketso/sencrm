<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/6/2017
 * Time: 10:45 PM
 */

namespace Users\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Users\Models\Users;

class UsersRepository extends BaseRepository
{
	public function model()
	{
		return Users::class;
	}

    /**
     * @param $data
     * @return bool
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
	public function registerUser($data)
    {
        $email = $data['email'];
        $check = $this->findWhere(['email' => $email]);
        if ($check->isNotEmpty()) {
            return false;
        }

        $user = $this->create($data);
        return $user;
    }


    /**
     * @return mixed
     */
    public function getActiveUserInMonth()
    {
        $month = intval(date("m"));
        return $this->scopeQuery(function ($q) use ($month) {
            return $q->where('status', 'active')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', intval(date("Y")));
        })->all(['id'])->count();
    }

    public function getTreeDataFromReg($setid){
        if(!empty($setid)){
            for($in=0;$in<5;$in++){
                if($setid[$in]>0){
                    $setarr = $this->find($setid[$in]);
                    $left_id = $setarr->_left;
                    $right_id = $setarr->_right;
                }else{
                    $left_id = 0;
                    $right_id = 0;
                }
                switch ($in)
                {
                    case 0: $setid[1] = $left_id;
                            $setid[2] = $right_id;
                            break;
                    case 1: $setid[3] = $left_id;
                            $setid[4] = $right_id;
                            break;
                    case 2: $setid[5] = $left_id;
                            $setid[6] = $right_id;
                            break;
                    case 3: $setid[7] = $left_id;
                            $setid[8] = $right_id;
                            break;
                    case 4: $setid[9] = $left_id;
                            $setid[10] = $right_id;

                }
            }
        }
        return $setid;
    }

    function printTreeView($parentid){
        $setid = array($parentid);
        $setarr = $this->getTreeDataFromReg($setid);
        return $setarr;
    }


}